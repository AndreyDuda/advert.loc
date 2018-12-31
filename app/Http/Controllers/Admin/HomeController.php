<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 30.12.18
 * Time: 5:35
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index()
    {
        return view('admin.home');
    }
}
