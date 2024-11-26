<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'audioData' => 'required|file|mimes:wav,mp3', // 音声ファイルの形式を指定
        ]);

        // 音声ファイルをストレージに保存
        $filePath = $request->file('audioData')->store('sounds'); // soundsディレクトリに保存

        // 音声の長さを取得
        $duration = $this->getAudioDuration(storage_path('app/' . $filePath));

        // データベースに保存
        Sound::create([
            'title' => $request->clipName,
            'file_path' => $filePath,
            'duration' => $duration,
            'mime_type' => $request->file('audioData')->getClientMimeType(),
        ]);

        return response()->json(['message' => 'Sound saved successfully!']);
    }

    // 音声の長さを取得するメソッド
    private function getAudioDuration($filePath)
    {
        // ffmpegを使用して音声の長さを取得する
        $ffprobe = \FFMpeg\FFProbe::create();
        return $ffprobe->format($filePath)->get('duration');
    }

}
