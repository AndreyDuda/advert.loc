<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 26.12.18
 * Time: 15:23
 */

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cabinet.home');
    }



}
