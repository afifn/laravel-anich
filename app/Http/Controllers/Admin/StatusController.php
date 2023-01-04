<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StatusController extends Controller
{
    public function index()
    {
        $status = Status::all();
        return view('admin.video.status', compact('status'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');
        $request->validate([
            'status' => 'required'
        ]);
        $data['slug'] = Str::slug($request->status);

        $statusExists = Status::where('status', $request->status)->exists();
        if ($statusExists) {
            return back()->withErrors([
                'status' => 'This status already exists'
            ])->withInput();
        }
        Status::create($data);
        return redirect()->route('admin.status')->with('success', 'Status created');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $request->validate([
            'status' => 'required'
        ]);
        $status = Status::find($id);
        $data['slug'] = Str::slug($request->status);
        //validate unique status
        $statusExists = Status::where('status', $request->status)->exists();
        if ($statusExists) {
            return back()->withErrors([
                'status' => 'This status already exists'
            ])->withInput();
        }
        $status->update($data);
        return redirect()->route('admin.status')->with('success', 'Status updated');
    }

    public function destroy($id)
    {
        Status::find($id)->delete();
        return redirect()->route('admin.status')->with('success', 'Status deleted');
    }
}
