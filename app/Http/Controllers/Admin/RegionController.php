<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 05.01.19
 * Time: 16:06
 */

namespace App\Http\Controllers\Admin;

use App\Entity\Region;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::orderBy('name')->paginate(30);

        return view('admin.regions.index', [
            'regions' => $regions
        ]);
    }

    public function create(Request $request)
    {
        $parent = null;

        if ($request->get('parent')) {
            $parent = Region::findOrFail($request)->get('parent');
        }

        return view('admin.regions.create', [
            'parent' => $parent
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required|string|max:255|unique,name,NULL,id,parent_id,' . ($request['parent'] ?: 'NULL'),
            'slug'   => 'required|string|max:255|unique,name,NULL,id,parent_id,' . ($request['parent'] ?: 'NULL'),
            'parent' => 'optional|exists:region,id'
        ]);

        $region = Region::create([
            'name'   => $request['name'],
            'slug'   => $request['slug'],
            'parent' => $request['parent']
        ]);

        return redirect()->route('admin.regions.show', $region);
    }

    public function show(Region $region)
    {
        $regions = Region::where('parent_id', $region->id)->orderBy('name')->get();

        return view('admin.regions.show', [
            'region'  => $region,
            'regions' => $regions
        ]);
    }

    public function edit(Region $region)
    {
        return view('admin.regions.edit', [
            'region' => $region
        ]);
    }

    public function update(Request $request, Region $region)
    {
        $this->validate($request, [
            'name'   => 'required|string|max:255|unique,name,NULL,id,parent_id,' . ($request['parent'] ?: 'NULL'),
            'slug'   => 'required|string|max:255|unique,name,NULL,id,parent_id,' . ($request['parent'] ?: 'NULL'),
        ]);

        $region->update([
            'name' => $request['name'],
            'slug' => $request['slug']
        ]);

        return redirect()->route('admin.reqions.show', $region);
    }

    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('admin.regions.index');
    }


}
