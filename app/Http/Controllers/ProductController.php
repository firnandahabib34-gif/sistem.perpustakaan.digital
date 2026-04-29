<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = [
            ['id' => 1, 'nama' => 'Beras', 'harga' => 15000],
            ['id' => 2, 'nama' => 'Minyak', 'harga' => 14000],
        ];

        return view('pages.product', compact('products'));
    }
}