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

    public static function checkRole($role)
    {
        Middleware::onlyLoggedIn();
        return $_SESSION['user']['role'] === $role;
    }
}