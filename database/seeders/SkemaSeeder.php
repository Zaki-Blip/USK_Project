<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Skema;

class SkemaSeeder extends Seeder
{
    public function run(): void
    {
        Skema::insert([
            ['kode_skema'=>'JWD-01','nama_skema'=>'Junior Web Developer',
             'deskripsi'=>'Skema untuk web developer pemula','created_at'=>now(),'updated_at'=>now()],
            ['kode_skema'=>'DGN-01','nama_skema'=>'Desainer Grafis Muda',
             'deskripsi'=>'Skema desain grafis tingkat dasar','created_at'=>now(),'updated_at'=>now()],
            ['kode_skema'=>'AKN-01','nama_skema'=>'Akuntan Junior',
             'deskripsi'=>'Skema akuntansi dasar','created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}