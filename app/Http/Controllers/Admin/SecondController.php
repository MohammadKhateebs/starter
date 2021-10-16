<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SecondController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth')->except('getName');
    }

    public function getName(){
        return "name1";
    }
}
