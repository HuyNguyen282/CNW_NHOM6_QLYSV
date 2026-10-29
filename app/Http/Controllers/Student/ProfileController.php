<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return 'ho so <form method="POST" action="' . route('logout') . '">' . csrf_field() . '<button>Đăng xuất</button></form>';
    }
}
