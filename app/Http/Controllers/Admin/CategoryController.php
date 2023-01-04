<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin.category', ['categories' => $category]);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['status'] = 1;
        $request->validate([
            'name' => 'required|string'
        ]);
        Category::create($data);

        return redirect()->route('admin.category')->with('success', 'category created');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $request->validate([
            'name' => 'required|string',
            'status' => 'required'
        ]);
        $category = Category::find($id);
        if ($request->name) {
            $category->update($data);
            return redirect()->route('admin.category')->with('success', 'category updated');
        }
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('admin.category')->with('success', 'category deleted');
    }
}
