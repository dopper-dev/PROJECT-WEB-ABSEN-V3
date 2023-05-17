<?php
// Konfigurasi koneksi database
$host = 'localhost'; // Isi dengan host database Anda
$user = 'root'; // Isi dengan username database Anda
$password = ''; // Isi dengan password database Anda
$dbname = 'db_absensi'; // Isi dengan nama database Anda

// Membuat koneksi ke database
$conn = mysqli_connect($host, $user, $password, $dbname);

// Memeriksa apakah koneksi berhasil
if (!$conn) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

// Memeriksa apakah pengguna sudah memiliki session
session_start();
if (!isset($_SESSION['username'])) {
    // Jika pengguna belum memiliki session, redirect ke halaman login
    header("Location: /");
    exit();
}

// Menutup koneksi database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('views/layouts/head.php'); ?>
</head>
<body class="bg-gray-900 selection:bg-green-300 selection:text-black">
    <div class="form-row p-3">
        <div class="main form-group col-md-6">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="font">Pilih Font</label>
                    <select class="form-control shadow-md shadow-sky-300/100 rounded-md text-slate-300 focus:text-slate-300 focus:bg-gray-600" id="font" onchange="localStorage.setItem('fontIndex', this.value);setup()"></select>
                </div>
                <div class="form-group col-md-6">
                    <label for="book">Pilih Kertas</label>
                    <select class="form-control shadow-md shadow-sky-300/100 rounded-md text-slate-300 focus:text-slate-300 focus:bg-gray-600" id="book" onchange="localStorage.setItem('bookIndex', this.value);setup()"></select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="warna">Warna Tinta</label>
                    <select class="form-control shadow-md shadow-sky-300/100 rounded-md text-slate-300 focus:text-slate-300 focus:bg-gray-600" id="warna">
                        <option value="nothing" selected="selected">Hitam</option>
                    </select>
                </div>
                <div class="form-group col-md-6" id="detpiker">
                    <label for="date">Tanggal</label>
                    <div class="">
                        <div class="input-group">
                            <input placeholder="Masukan tanggal" type="text" class="form-control shadow-md shadow-sky-300/100 rounded-md text-slate-300 focus:text-slate-300 focus:bg-gray-600" id="date">
                            <div class="input-group-append shadow-md shadow-sky-300/100">
                                <span class="input-group-text text-md">📆 </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control shadow-md shadow-sky-300/100 rounded-md text-slate-300 focus:text-slate-300 focus:bg-gray-600" id="name" oninput="txtName=this.value" placeholder="CONTOH Nama : Agus">
                </div>
                <div class="form-group col-md-6">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control shadow-md shadow-sky-300/100 rounded-md text-slate-300 focus:text-slate-300 focus:bg-gray-600" id="kelas" oninput="txtKelas=this.value" placeholder="CONTOH Kelas : 10C">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="fakultas">Mata Pelajaran</label>
                    <input type="text" class="form-control shadow-md shadow-sky-300/100 rounded-md text-slate-300 focus:text-slate-300 focus:bg-gray-600" id="fakultas" oninput="txtFakultas=this.value" placeholder="CONTOH Mapel : IT"></div></div>
                    <div class="form-group pb-1"><label for="content">Teks :</label>
                        <textarea class="form-control shadow-md shadow-sky-300/100 rounded-md text-slate-300 focus:text-slate-300 focus:bg-gray-600" id="content" rows="10" oninput="txtContent=this.value" placeholder="Masukan teks"></textarea></div>
                        <div class="form-group">
    <a href="./" class="shadow-md font-bold shadow-sky-300/100 bg-blue-500 px-2 py-1 text-white rounded-lg font-sans mr-2">Kembali ke Halaman Awal</a>
    <button class="shadow-md font-bold shadow-sky-300/100 bg-green-500 px-2 py-1 text-white rounded-lg font-sans mr-2" onclick="downloadCanvas(document.getElementById('defaultCanvas0'), 'awas-ketauan-akalin-biar-ga-ketauan.png')">Unduh Hasil</button>
    <button class="shadow-md font-bold shadow-sky-300/100 bg-red-500 px-2 py-1 text-white rounded-lg font-sans float-center" type="button" onclick="javascript:eraseText();">Hapus Semua</button>
</div>
</div><div class="form-group col-md-6">
                                <main class="paper-container scale-50 -mt-52 -mb-80 mr-64 md:scale-100 md:mt-0 md:mb-0 md:mr-0"></main></div></div>
                                <?php  include('views/layouts/script.js'); ?></body></html>