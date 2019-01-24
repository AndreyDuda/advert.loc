<?php

namespace App\Http\Controllers;

use App\Entity\Adverts\Category;
use App\Entity\Region;

class HomeController extends Controller
{
    public function index()
    {
        //$regions = Region::roots()->orderBy('name')->getModels();
        $regions = Region::where('parent_id', null)->orderBy('name')->getModels();
        $categories = Category::whereIsRoot()->defaultOrder()->getModels();
        return view('home', compact('regions', 'categories'));
    }

}
