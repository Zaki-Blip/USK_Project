<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Peserta;

class PesertaSeeder extends Seeder
{
    public function run(): void
    {
        Peserta::insert([
            ['nik'=>'3201234567890001','nama'=>'Budi Santoso','email'=>'budi@example.com',
             'no_hp'=>'081234567890','alamat'=>'Jl. Merdeka No. 10, Jakarta',
             'skema_id'=>1,'tanggal_daftar'=>'2025-01-15','created_at'=>now(),'updated_at'=>now()],
            ['nik'=>'3201234567890002','nama'=>'Siti Nurhaliza','email'=>'siti@example.com',
             'no_hp'=>'081234567891','alamat'=>'Jl. Sudirman No. 5, Bandung',
             'skema_id'=>1,'tanggal_daftar'=>'2025-02-10','created_at'=>now(),'updated_at'=>now()],
            ['nik'=>'3201234567890003','nama'=>'Ahmad Wijaya','email'=>'ahmad@example.com',
             'no_hp'=>'081234567892','alamat'=>'Jl. Diponegoro No. 22, Surabaya',
             'skema_id'=>2,'tanggal_daftar'=>'2025-03-05','created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}