<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'sound_id' => 'required|integer|exists:sounds,id',
            'button_id' => 'required|integer',
            'sound_title' => 'required|string',
        ]);

        $playlist = Playlist::create([
            'sound_id' => $request->sound_id,
            'button_id' => $request->button_id,
            'sound_title' => $request->sound_title,
            'user_id' => auth()->id(), // ユーザーIDを保存
        ]);

        return response()->json(['message' => 'Sound added to playlist successfully!', 'playlist' => $playlist]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sound_id' => 'required|integer|exists:sounds,id',
            'button_id' => 'required|integer',
            'sound_title' => 'required|string',
        ]);

        $playlist = Playlist::findOrFail($id);
        $playlist->update([
            'sound_id' => $request->sound_id,
            'button_id' => $request->button_id,
            'sound_title' => $request->sound_title,
            'user_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Sound updated in playlist successfully!', 'playlist' => $playlist]);
    }

    public function index()
    {
        try {
            $playlists = Playlist::where('user_id', auth()->id())->get();
            return response()->json($playlists);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}