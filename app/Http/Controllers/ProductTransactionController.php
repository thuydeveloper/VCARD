<?php

namespace App\Http\Controllers;

use App\Models\ProductTransaction;
use Illuminate\Http\Request;

class ProductTransactionController extends Controller
{
    public function index()
    {
        return view('product_transactions.index');
    }

    public function show($id)
    {
        $productTransaction = ProductTransaction::whereId($id)->first();

        return view('product_transactions.show', compact('productTransaction'));
    }
}
