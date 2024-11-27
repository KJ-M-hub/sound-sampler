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
        ]);

        try{
            // 音声ファイルをストレージに保存
            $filePath = $request->file('audioData')->store('sounds'); // soundsディレクトリに保存
            \Log::info('File saved at: ' . $filePath); // 保存されたファイルのパスをログに記録
            // 音声データを取得
            $audioData = file_get_contents($request->file('audioData')->getRealPath());

            // ffmpegを使用して音声の長さを取得する
            $ffprobe = \FFMpeg\FFProbe::create();
            $duration = $ffprobe->format(storage_path('app/' . $filePath))->get('duration');

            // データベースに保存
            Sound::create([
                'title' => $request->clipName,
                'file_path' => $filePath,
                'duration' => $duration,
                'mime_type' => $request->file('audioData')->getClientMimeType(),
                'audio_data' => $audioData,
            ]);

            return response()->json(['message' => 'Sound saved successfully!']);
        } catch (\Exception $e) {
            \Log::error('Error probing audio file: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to probe audio file: ' . $e->getMessage()], 500);
        }
    }

}
