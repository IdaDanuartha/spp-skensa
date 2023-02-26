<?php

// Fungsi dd atau dump and die adalah fungsi untuk melakukan debugging
function dd($data, $arrays = []) {
    var_dump($data, $arrays); die;
}

// Fungsi redirect adalah fungsi untuk melakukan redirecting ke halaman tertentu
function redirect($path) {
    header('Location: ' . BASE_URL . "/$path"); exit;
}

// Fungsi route adalah fungsi untuk melakukan request pada route tertentu
function route($path) {
    return BASE_URL . "/$path";
}

// Fungsi activeURL adalah fungsi untuk melakukan pengecekan apakah url saat ini sama dengan url yang diakses user
function activeURL($url) {
    return CURRENT_URL === BASE_URL . $url ? 'active' : '';
}

// Fungsi view adalah fungsi untuk memanggil sebuah view
function view($view, $data = []) {
    require_once "../app/views/$view.php";
}

// Fungsi component adalah fungsi untuk memanggil sebuah component
function component($component, $data = []) {
    require_once "../app/views/components/$component.php";
}

// Fungsi asset adalah fungsi untuk memanggil file-file asset di public
function asset($asset) {
    return BASE_URL . "/assets/$asset";
}

// Fungsi rupiah adalah fungsi untuk melakukan format angka ke format rupiah
function rupiah($num) {
    return 'Rp. ' . number_format($num, 0, ',', '.');
}