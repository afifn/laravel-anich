<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        $category = Category::all()->sortBy('id');
        $relations = [
            'categories'
        ];
        $subcategory = SubCategory::with($relations)
            ->orderBy('category_id', 'ASC')
            ->orderBy('name', 'ASC')
            ->get();

        return view('admin.subcategory', [
            'categories' => $category,
            'subcategories' => $subcategory,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required'
        ]);
        $slug = $request->name;
        $data['status'] = 1;
        $data['slug'] = Str::slug($slug);

        SubCategory::create($data);

        return redirect()->route('admin.subcategory')->with('success', 'subcategory created');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required',
            'status' => 'required',
        ]);
        $subcategory = SubCategory::find($id);
        if ($request->name) {
            $subcategory->update($data);
            return redirect()->route('admin.subcategory')->with('success', 'subcategory updated');
        }
    }

    public function destroy($id)
    {
        SubCategory::find($id)->delete();
        return redirect()->route('admin.subcategory')->with('success', 'subcategory deleted');
    }
}
