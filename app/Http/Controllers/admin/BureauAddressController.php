<?php

namespace App\Http\Controllers\admin;

use App\enum\BureauAddressNameEnum;
use App\Http\Controllers\Controller;
use App\Models\BureauAddress;
use Illuminate\Http\Request;

class BureauAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.bureauaddress.index', [
            'bureauaddress' => BureauAddress::orderByDesc('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bureauaddress.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => 'required|in:' . implode(',', BureauAddressNameEnum::values()),
            "address" => 'required|string|max:300',
            "city" => 'required|string|max:300',
            "state" => 'required|string|max:300',
            "zipcode" => 'required|string|max:300',
            "phone" => 'required|string|max:20',
            "fax" => 'required|string|max:20',
        ]);
        $store = BureauAddress::create($data);
        if ($store instanceof BureauAddress) {
            return response()->json([
                'status' => 'success',
                'toUrl' => route('bureau-address.index'),
                'msg' => 'New Address Added Successfully under '.$request?->name.'..!',
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
        return view('admin.bureauaddress.edit', [
            'bureauaddress' => BureauAddress::where('slug', $slug)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $data = $request->validate([
            "name" => 'required|in:' . implode(',', BureauAddressNameEnum::values()),
            "address" => 'required|string|max:300',
            "city" => 'required|string|max:300',
            "state" => 'required|string|max:300',
            "zipcode" => 'required|string|max:300',
            "phone" => 'required|string|max:20',
            "fax" => 'required|string|max:20',
        ]);
        $update = BureauAddress::where('slug', $slug)->update($data);
        if ($update) {
            return response()->json([
                'status' => 'success',
                'toUrl' => route('bureau-address.index'),
                'msg' => $request?->first_name . 'Address Updated Successfully..!',
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
        BureauAddress::where('slug', $slug)->delete();
        return back()->with('msg', 'The Address has been deleted successsfully..');
    }
}
