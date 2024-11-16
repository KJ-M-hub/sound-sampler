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

        // データベースに保存
        Sound::create([
            'title' => $request->clipName,
            'file_path' => $filePath,
        ]);

        return response()->json(['message' => 'Sound saved successfully!']);
    }
}
