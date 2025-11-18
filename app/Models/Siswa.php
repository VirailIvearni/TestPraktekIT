<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['lembaga_id', 'nis', 'nama', 'email', 'image'];

    public function lembaga() {
        return $this->belongsTo(Lembaga::class);
    }
}
