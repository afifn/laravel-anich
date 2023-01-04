<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Item;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('admin.video.item', compact('items'));
    }

    public function singleItems()
    {
    }
    public function episodeItems()
    {
    }

    public function itemCreate()
    {
        $categories = Category::with([
            'subcategories' => function ($subcategory) {
                $subcategory->where('status', 1);
            },
        ])->where('status', 1)->get();

        $genres = Genre::all();

        return view('admin.video.item_create', compact('categories', 'genres'));
    }

    public function itemUpdate()
    {
        return view('admin.video.item_update');
    }

    public function store()
    {
        return redirect()->route('admin.item')->with('success', 'Item created');
    }
    public function update(Request $request, $id)
    {
        return redirect()->route('admin.item')->with('success', 'Item updated');
    }
    public function destroy($id)
    {
    }

    public function ajax(Request $request, $id)
    {
        $sub = SubCategory::where('category_id', $id)->get();
        return response()->json($sub);
    }
}
