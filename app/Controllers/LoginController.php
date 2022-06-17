<?php

namespace App\Controllers;

class LoginController {
    public function index()
    {
        return view("login");
    }

    public function login()
    {
    }

    public function logout()
    {
        unset($_SESSION["logged"]);
        return redirect("/login");
    }
}