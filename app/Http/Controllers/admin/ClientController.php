<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.client.index', [
            'clients' => Client::orderByDesc('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:250',
            'last_name' => 'required|string|max:250',
            'email' => 'required|email',
        ]);
        $data = $request->only('first_name', 'middle_name', 'last_name', 'email', 'is_notify_email', 'dob', 'ssn', 'phone', 'phone_home', 'phone_work', 'current_address', 'city', 'state', 'zipcode', 'billing_address', 'billing_city', 'billing_state', 'billing_zipcode', 'occupation', 'anual_income');
        $store = Client::create($data);
        if ($store instanceof Client) {
            return response()->json([
                'status' => 'success',
                'toUrl' => route('clients.index'),
                'msg' => $request?->first_name . 'Client Added Successfully..!',
            ]);
        } else {
            return back()->with('msg', 'Some error occur..');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return view('admin.client.show', [
            'client' => Client::where('slug', $slug)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        return view('admin.client.pages.clientedit', [
            'client' => Client::where('slug', $slug)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $request->validate([
            'first_name' => 'required|string|max:250',
            'last_name' => 'required|string|max:250',
            'email' => 'required|email',
        ]);
        $data = $request->only('first_name', 'middle_name', 'last_name', 'email', 'is_notify_email', 'dob', 'ssn', 'phone', 'phone_home', 'phone_work', 'current_address', 'city', 'state', 'zipcode', 'billing_address', 'billing_city', 'billing_state', 'billing_zipcode', 'occupation', 'anual_income');
        $update = Client::where('slug', $slug)->update($data);
        if ($update) {
            return response()->json([
                'status' => 'success',
                'toUrl' => route('clients.index'),
                'msg' => $request?->first_name . 'Client Updated Successfully..!',
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
        Client::where('slug', $slug)->delete();
        return back()->with('msg', 'The client has been deleted successsfully..');
    }
}