<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 30.12.18
 * Time: 5:35
 */

namespace App\Http\Controllers\Admin;

use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $regions = Region::roots()->orderBy('name')->getModels();
        $categories = Category::whereIsRoot()->defaultOrder()->getModels();
        return view('home', compact('regions', 'categories'));
    }

}
