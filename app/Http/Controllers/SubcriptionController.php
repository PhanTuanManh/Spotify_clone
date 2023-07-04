<?php

namespace App\Http\Controllers;

use App\Models\Subcription;

class SubcriptionController extends Controller
{
    public function index()
    {
        $subcriptions = Subcription::all();
        return view('admin.dashboard', ['subcriptions' => $subcriptions]);
    }
}
