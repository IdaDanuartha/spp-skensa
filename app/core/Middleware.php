<?php

class Middleware {
    public static function onlyLoggedIn()
    {
        if(empty($_SESSION['user'])) redirect('auth');
    }

    public static function onlyNotLoggedIn()
    {
        if(isset($_SESSION['user'])) redirect('dashboard');
    }

    public static function onlyAdmin()
    {
        Middleware::onlyLoggedIn();
        if($_SESSION['user']['role'] !== 'admin') redirect('dashboard');
    }

    public static function onlyPetugas()
    {
        Middleware::onlyLoggedIn();
        if($_SESSION['user']['role'] !== 'petugas') redirect('dashboard');
    }

    public static function onlySiswa()
    {
        Middleware::onlyLoggedIn();
        if($_SESSION['user']['role'] !== 'siswa') redirect('dashboard');
    }
}