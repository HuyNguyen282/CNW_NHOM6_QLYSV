<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return 'Dashboard admin <form method="POST" action="' . route('logout') . '">' . csrf_field() . '<button>Đăng xuất</button></form>';
    }
}
