<?php

namespace App\Http\Controllers;

use App\Models\DigitalProduct;

class ShopController extends Controller
{
    public function index()
    {
        $products = DigitalProduct::with(['shop.user', 'campaign'])->get();

        return view('dashboard-user.kindlyshop', compact('products'));
    }
}
