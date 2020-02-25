<?php

use Illuminate\Database\Seeder;
use App\Dosen;
use App\Mahasiswa;
use App\Wali;
use App\Hobi;

class RelassiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //menghapus semua sample data
        DB::table('dosens')->delete();
        DB::table('mahasiswas')->delete();
        DB::table('walis')->delete();
        DB::table('hobis')->delete();
        DB::table('mahasiswa_hobi')->delete();

        //membuat data dosen
        $dosen = Dosen::create([
            'nama' => 'Rosmayani',
            'nipd' => '1604060520'
        ]);
        $this->command->info('Data Dosen Berhasil dibuat');
        //membuat data mahasiswa
        $ilham = Mahasiswa::create([
            'nama' => 'Ilham Ramdani',
            'nim' => '25112002',
            'id_dosen' => $dosen->id
        ]);

        $aseu = Mahasiswa::create([
            'nama' => 'Rizky Hermawan',
            'nim' => '87759949',
            'id_dosen' => $dosen->id
        ]);

        $zyan = Mahasiswa::create([
            'nama' => 'Zyan Ahmad Arsalan',
            'nim' => '25122019',
            'id_dosen' => $dosen->id
        ]);
        $this->command->info('Data Dosen Berhasil dibuat');

        //membuat data wali
        $gharra = wali::create([
            'nama' => 'Gharra Pradipta Kusuma',
            'id_mahasiswa' => $ilham->id
        ]);

        $rizky = wali::create([
            'nama' => 'Rizky Romdoni',
            'id_mahasiswa' => $aseu->id
        ]);

        $novi = wali::create([
            'nama' => 'Novi Novianti',
            'id_mahasiswa' => $zyan->id
        ]);
        $this->command->info('Data Wali Berhasil dibuat');

        //membuat data hobi

        $mancing = Hobi::create([
            'hobi' => 'Mancing Lele'
        ]);

        $karatee = Hobi::create([
            'hobi' => 'Karate'
        ]);

        $eat = Hobi::create([
            'hobi' => 'Makan Seblak'
        ]);

        //menampilkan hobi ke mahasiswa

        $ilham->hobi()->attach($mancing->id);
        $ilham->hobi()->attach($eat->id);
        $aseu->hobi()->attach($karatee->id);
        $zyan->hobi()->attach($eat->id);
        $this->command->info('Data Hobi Mahasiswa Berhasil dibuat');
    }
}
