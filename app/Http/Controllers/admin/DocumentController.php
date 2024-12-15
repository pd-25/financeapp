<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($client_id)
    {
        return view('admin.client.pages.clientdocuments', [
            'clientdocuments' => Document::where('client_id', $client_id)->orderByDesc('id')->paginate(10),
            'client' => Client::where('id', $client_id)->first(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function uploadImage($document)
    {
        $db_image = time() . rand(0000, 9999) . '.' . $document->getClientOriginalExtension();
        $document->storeAs("ClientDoc", $db_image, 'public');
        return '/ClientDoc/' . $db_image;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $client_slug)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'doc' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:10240',
        ]);
        // dd($data);
        $findClient = Client::where('slug', $client_slug)->first();
        if ($findClient) {
            $data['doc'] = $this->uploadImage($data['doc']);
            $data['client_id'] = $findClient->id;
            $store = Document::create($data);
            if ($store instanceof Document) {
                return response()->json([
                    'status' => 'success',
                    'toUrl' => route('client-documents.index', $client_slug),
                    'msg' => $request?->first_name . 'Document Added Successfully..!',
                ]);
            } else {
                return back()->with('msg', 'Some error occur..');
            }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
     Document::where('slug', $slug)->delete();
     return back()->with('msg', 'Document has been deleted successsfully..');
    }
}
