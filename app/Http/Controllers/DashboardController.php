<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /** possible to call the listings() function because it is in the user model **/
        $listings =
        $request->user()->role !== 'suspended' ?
        $request->user()->listings()->latest()->paginate(6) :
        null;

        return Inertia::render('Dashboard', [
            'listings' => $listings,
            'status' => session('status'),
        ]);
    }
}
