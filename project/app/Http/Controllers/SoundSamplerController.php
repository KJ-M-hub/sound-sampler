<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sound;
use FFMpeg\FFProbe;

class SoundSamplerController extends Controller
{
    public function main(){
        return view('main');
    }

    public function recording(){
        return view('recording');
    }

    public function saveSound(Request $request){
        
        $request->validate([
            'clipName' => 'required|string|max:255',
            'audioData' => 'required|file|mimes:wav,mp3,webm', // 音声ファイルの形式を指定
            'user_id' => 'required|exists:users,id', // user_idのバリデーションを追加
        ]);
        \Log::info('Received user_id: ' . $request->user_id); // 追加: user_idをログに記録
        try{
            // 音声ファイルをストレージに保存
            $filePath = $request->file('audioData')->store('sounds', 'public'); 
            \Log::info('File saved at: ' . $filePath); // 保存されたファイルのパスをログに記録

            // 音声データを取得
            $audioData = file_get_contents(storage_path('app/public/' . $filePath));
            
            // ffmpegを使用して音声の長さを取得する
            $ffmpegCommand = "ffmpeg -i " . escapeshellarg(storage_path('app/public/' . $filePath)) . " 2>&1"; // 'public/'を含めて正しいパスを取得
            $output = shell_exec($ffmpegCommand);
            
            // 出力からtimeを抽出
            preg_match('/time=(\d+:\d+:\d+\.\d+)/', $output, $matches);
            $duration = isset($matches[1]) ? $matches[1] : null;

            // 音声データをbase64エンコードして保存
            $audioDataEncoded = base64_encode($audioData);
            // データベースに保存
            Sound::create([
                'title' => $request->clipName,
                'file_path' => $filePath,
                'duration' => $duration,
                'mime_type' => $request->file('audioData')->getClientMimeType(),
                'audio_data' => $audioDataEncoded,
                'user_id' => $request->user_id,
            ]);

            return response()->json(['message' => 'Sound saved successfully!']);
        } catch (\Exception $e) {
            \Log::error('Error probing audio file: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to probe audio file: ' . $e->getMessage()], 500);
        }
    }

    public function index(){
        $sounds = Sound::all();
        return view('index', compact('sounds'));
    }

    public function deleteSound($id) {
        try {
            $sound = Sound::findOrFail($id); // IDで音声を取得
    
            // 拡張子が.mp3の場合はファイルを削除しない
            if (pathinfo($sound->file_path, PATHINFO_EXTENSION) !== 'mp3') {
                $filePath = storage_path('app/public/' . $sound->file_path); // ストレージのパスを取得
    
                // ストレージからファイルを削除
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
    
            // データベースから音声を削除
            $sound->delete();
    
            return response()->json(['message' => 'Sound deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete sound: ' . $e->getMessage()], 500);
        }
    }

    public function getSound($id) {
        try {
            $sound = Sound::findOrFail($id);
            return response()->json($sound);
        } catch (\Exception $e) {
            \Log::error('Error retrieving sound: ' . $e->getMessage());
            return response()->json(['error' => 'Sound not found'], 404);
        }
    }
    
    public function saveSoundMp3(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'file_path' => 'required|string',
            'user_id' => 'required|exists:users,id', // user_idのバリデーションを追加
        ]);

        try {
            $filePath = $request->input('file_path');
            $title = $request->input('title');
            $userId = $request->input('user_id');

            // 同じタイトルとファイルパスのデータが既に存在するか確認
            $existingSound = Sound::where('title', $title)
            ->where('file_path', $filePath)
            ->where('user_id', $userId)
            ->first();

            if ($existingSound) {
                return response()->json(['message' => 'Sound already exists for this user!']);
            }

            $audioData = file_get_contents(storage_path('app/public/' . $filePath));
            $audioDataEncoded = base64_encode($audioData);

            Sound::create([
                'title' => $title,
                'file_path' => $filePath,
                'mime_type' => 'audio/mpeg',
                'audio_data' => $audioDataEncoded,
                'user_id' => $userId,
            ]);

            return response()->json(['message' => 'Sound saved successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to save sound: ' . $e->getMessage()], 500);
        }
    }

    public function userSounds()
    {
        $userId = auth()->id();
        $sounds = Sound::where('user_id', $userId)->get();
        return view('index', compact('sounds'));
    }

}
