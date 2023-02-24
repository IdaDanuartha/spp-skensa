<?php

class Controller {
    public function view($view, $data = [])
    {
        view($view, $data);
    }

    public function model($model)
    {
        require_once "../app/models/$model.php";
        return new $model;
    }

    public function request($request)
    {
        require_once "../app/requests/$request.php";
        return new $request;
    }
}