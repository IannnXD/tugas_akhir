<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentars';
    protected $primaryKey = 'id';
    protected $fillable = [
        'foto_id',
        'user_id',
        'NamaKomentar',
        'komentar',
        'tanggalKomentar',
    ];

    public function foto()
    {
        return $this->belongsTo(Foto::class,'foto_id');
    }
}
