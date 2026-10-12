<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'pesertas';

    protected $fillable = [
        'user_id','nik', 'nama', 'email', 'no_hp', 'alamat', 'skema_id', 'tanggal_daftar'
    ];

    public function skema()
    {
        return $this->belongsTo(Skema::class, 'skema_id');
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

}
