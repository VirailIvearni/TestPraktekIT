<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $table = 'lembaga';
    protected $fillable = ['nama_lembaga'];
    public $timestamps = false;

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'lembaga_id', 'id');
    }

}
