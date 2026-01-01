<?php

namespace App\Http\Controllers;

use App\Models\Sneaker;
use Illuminate\Http\Request;

class SneakerController extends Controller
{
    /**
     * Display a listing of the sneakers.
     */
    public function index()
    {
        $sneakers = Sneaker::all();
        return view('sneakers.index', compact('sneakers'));
    }

    /**
     * Display the specified sneaker.
     */
    public function show(Sneaker $sneaker)
    {
        return view('sneakers.show', compact('sneaker'));
    }
}
