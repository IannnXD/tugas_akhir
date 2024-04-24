<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
   protected $table = 'fotos';
   protected $primaryKey = 'id';

  protected  $fillable = [
    'judulFoto',
    'deskripsi',
    'lokasifile',
    'user_id',
    'album_id'
   ];

   public function user()
   {
    return $this->belongsTo(User::class, 'user_id');
   }

   public function like()
   {
    return $this->hasMany(Like::class,'id');
   }

   public function komentar()
   {
    return $this->hasMany(Komentar::class,'foto_id');
   }

   public function album()
   {
    return $this->belongsTo(Album::class, 'album_id');
   }
}
