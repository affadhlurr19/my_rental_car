<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() :View 
    {
        $data = Cars::all();

        return view('welcome', compact('data'));
    }

    public function detailCars($id) :View
    {
        $data = Cars::find($id);

        return view('detail_cars', compact('data'));
    }
}
