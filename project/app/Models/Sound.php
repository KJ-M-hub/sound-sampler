<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Sound; // 追加
use Illuminate\Support\Facades\Storage; // 追加

class Sound extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'title',
        'description',
        'playlist_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function playlist() {
        return $this->belongsTo(Playlist::class);
    }
}
