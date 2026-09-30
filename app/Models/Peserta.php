<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $fillable = ['nik','nama','email','no_hp','alamat','skema_id','tanggal_daftar'];

    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }
}
