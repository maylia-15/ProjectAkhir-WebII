<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        $totalLaporanSelesai = Report::status('selesai')->count();

        return view('landing', [
            'totalLaporanSelesai' => $totalLaporanSelesai,
        ]);
    }
}