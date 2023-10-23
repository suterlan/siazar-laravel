<?php

namespace App\Http\Controllers\dashboard_siswa;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardSiswaController extends Controller
{
    public function index() : View {
        return view('dashboard-siswa.index', [
            'title'     => 'Dashboard '. config('app.name'),
        ]);
    }
}
