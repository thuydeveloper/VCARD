<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AffiliateUserController extends Controller
{
    public function index(): View
    {
        return view('sadmin.affiliateUsers.index');
    }
}
