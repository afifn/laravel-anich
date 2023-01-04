<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::orderBy('name', 'ASC')->get();
        return view('admin.video.genre', compact('genres'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $request->validate([
            'name' => 'required'
        ]);
        $data['slug'] = Str::slug($request->name);
        $genreExists = Genre::where('name', $request->name)->exists();
        if ($genreExists) {
            return back()->withErrors([
                'genre' => 'This genre already exists'
            ])->withInput();
        }

        Genre::create($data);

        return redirect()->route('admin.genre')->with('success', 'genre created');
    }

    public function updates(Request $request, $id)
    {
        $data = $request->except('_token');
        $request->validate([
            'name' => 'required'
        ]);
        $genre = Genre::find($id);
        $data['slug'] = Str::slug($request->name);

        $genreExists = Genre::where('name', $request->name)->exists();
        if ($genreExists) {
            return back()->withErrors([
                'genre' => 'This genre already exists'
            ])->withInput();
        }

        $genre->update($data);

        return redirect()->route('admin.genre')->with('success', 'genre updated');
    }

    public function destroy($id)
    {
        Genre::find($id)->delete();
        return redirect()->route('admin.genre')->with('success', 'genre deleted');
    }
}
