<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DisputeLetters;
use Illuminate\Http\Request;

class DisputeLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.disputeletters.index', [
            'disputeletters' => DisputeLetters::orderByDesc('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.disputeletters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required|string',
            "description" => 'required|string|max:500',
            "body" => 'required|string',
        ]);
        $data = $request->only("name", "description", "body");
        $store = DisputeLetters::create($data);
        if ($store instanceof DisputeLetters) {
            return response()->json([
                'status' => 'success',
                'toUrl' => route('dispute-letters.index'),
                'msg' => $request?->first_name . 'Template Added Successfully..!',
            ]);
        } else {
            return back()->with('msg', 'Some error occur..');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        return view('admin.disputeletters.edit', [
            'disputeletter' => DisputeLetters::where('slug', $slug)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $request->validate([
            "name" => 'required|string',
            "description" => 'required|string|max:500',
            "body" => 'required|string|max:4000',
        ]);
        // dd($request->all());
        $data = $request->only("name", "description", "body");
        $update = DisputeLetters::where('slug', $slug)->update($data);
        if ($update) {
            return response()->json([
                'status' => 'success',
                'toUrl' => route('dispute-letters.index'),
                'msg' => $request?->first_name . 'Template Updated Successfully..!',
            ]);
        } else {
            return back()->with('msg', 'Some error occur..');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        DisputeLetters::where('slug', $slug)->delete();
        return back()->with('msg', 'The template has been deleted successsfully..');
    }
}
