<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Import model
use App\Mahasiswa;
use App\Dosen;
use App\Hobi;

Route::get('/', function () {
    return view('welcome');
});

//Route One to One
Route::get('relasi-1', function ()
{
    //Memilih data mahasiswa yang memiliki nim '25112002'
    $mhs = Mahasiswa::where('nim','=','25112002')->first();

    //Menampilkan data wali dari mahasiswa yang dipilih
    return $mhs->wali->nama;
});

Route::get('relasi-2', function ()
{
    //Memilih data mahasiswa yang memiliki nim '87759949'
    $mhs = Mahasiswa::where('nim','=','87759949')->first();

    //Menampilkan data dosen dari mahasiswa yang dipilih
    return $mhs->dosen->nama;
});

//One to Many
Route::get('relasi-3', function ()
{
    //Mencari dosen dengan yang bernama Rosmayani
    $dosen = Dosen::where('nama','=','Rosmayani')->first();

    //Menampilkan seluruh data mahasiswa didikannya
    foreach ($dosen->mahasiswa as $temp)
            echo '<li> Nama : ' . $temp->nama .
                 '<strong>' . $temp->nim . '</strong>
                  </li>';
});

Route::get('relasi-4', function ()
{
    //Mencari mahasiswa yang bernama Ilham
    $ilham = Mahasiswa::where('nama','=','Ilham Ramdani')->first();

    //Menampilkan seluruh hobi dari Ilham
    foreach ($ilham->hobi as $temp)
            echo '<li>' . $temp->hobi . '</li>';
});

Route::get('relasi-5', function ()
{
    //Mencari mahasiswa yang bernama Ilham
    $eat = Hobi::where('hobi','=','Makan Seblak')->first();

    //Menampilkan semua mahasiswa yang mempunyai hobi mancing lele
    foreach ($eat->mahasiswa as $temp)
            echo '<li> Nama : ' . $temp->nama . '<strong>' .
                    $temp->nim . '</strong></li>';
});

Route::get('relasi-join', function ()
{
    //Join laravel
    //$sql = Mahasiswa::with('wali')->get();
    $sql = DB::table('mahasiswas')
    ->select('mahasiswas.nama','mahasiswas.nim','walis.nama as nama_wali')
    ->join('walis','walis.id_mahasiswa','=','mahasiswas.id')
    ->get();
    dd($sql);
});

Route::get('eloquent', function ()
{
    //Mencari mahasiswa yang bernama Ilham
    $mahasiswa = Mahasiswa::with('wali','dosen','hobi')->get();
    return view ('eloquent',compact('mahasiswa'));
});

Route::get('eloquent2',function(){
    $mahasiswa = Mahasiswa::where('nama','=','Ilham Ramdani')->get();
    return view('eloquent2',compact('mahasiswa'));
});
