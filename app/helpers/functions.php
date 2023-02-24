<?php

// Fungsi dd atau dump and die adalah fungsi untuk melakukan debugging
function dd($data, $arrays = []) {
    var_dump($data, $arrays); die;
}

// Fungsi redirect adalah fungsi untuk melakukan redirecting ke halaman tertentu
function redirect($path) {
    header('Location: ' . BASE_URL . "/$path"); exit;
}

// Fungsi view adalah fungsi untuk memanggil sebuah view
function view($view, $data = []) {
    require_once "../app/views/$view.php";
}

// Fungsi component adalah fungsi untuk memanggil sebuah component
function component($component, $data = []) {
    require_once "../app/views/components/$component.php";
}

// Fungsi rupiah adalah fungsi untuk melakukan format angka ke format rupiah
function rupiah($num) {
    return number_format($num, 0, ',', '.');
}