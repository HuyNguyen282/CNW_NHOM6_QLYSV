<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\StatisticService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $statisticService;

    public function __construct(StatisticService $statisticService)
    {
        $this->statisticService = $statisticService;
    }

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $stats = $this->statisticService->getDashboardStats($keyword);
        
        return view('admin.dashboard', compact('stats', 'keyword'));
    }
}