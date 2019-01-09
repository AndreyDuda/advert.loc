<?php

namespace App\Http\Controllers\Admin\Adverts;

use App\Entity\Adverts\Attribute;
use App\Entity\Adverts\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Nullable;

class AttributeController extends Controller
{
    public function create(Category $category)
    {
        $type = Attribute::typesList();

        return view('admin.adverts.categories.attributes.create', [
            'category' => $category,
            'types'    => $type
        ]);
    }

    public function store(Request $request, Category $category)
    {
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'type'     => ['required', 'string', 'max:255', Rule::in(array_keys(Attribute::typeList()))],
            'required' => 'nullable|string|max:255',
            'variants' => 'nullable|string',
            'sort'     => 'required|integer',
        ]);

        $attribute = $category->attributes()->create([
            'name'     => $request['name'],
            'type'     => $request['type'],
            'required' => (bool)$request['required'],
            'variants' => array_map('trim', preg_split('#[\r\n]+#', $request['variants'])),
            'sort'     => $request['sort'],
        ]);

        return redirect()->route('admin.adverts.categories.show', [$category, $attribute]);
    }

    public function show(Category $category, Attribute $attribute)
    {
        return view('admin.adverts.categories.attributes.show', [
            'category'  => $category,
            'attribute' => $attribute
        ]);
    }

    public function edit(Category $category, Attribute $attribute)
    {
       $types = Attribute::typesList();

       return view('admin.adverts.categories.attributes.edit', [
           'category'  => $category,
           'attribute' => $attribute,
           'types'     => $types
       ]);
    }

    public function update(Request $request, Category $category, Attribute $attribute)
    {
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'type'     => ['required', 'string', 'max:255', Rule::in(array_keys(Attribute::typeList()))],
            'required' => 'nullable|string|max:255',
            'variants' => 'nullable|string',
            'sort'     => 'required|integer',
        ]);

        $category->attributes()->findOrFail($attribute->id)->update([
            'name'     => $request['name'],
            'type'     => $request['type'],
            'required' => (bool)$request['required'],
            'variants' => array_map('trim', preg_split('#[\r\n]+#', $request['variants'])),
            'sort'     => $request['sort'],
        ]);

        return redirect()->route('admin.adverts.categories.show', $category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.adverts.categories.show', $category);
    }
}
