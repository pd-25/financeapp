<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ReportSource;
use Illuminate\Http\Request;

class ReportSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.reportsources.index', [
            'reportsources' => ReportSource::orderByDesc('id')->paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required|string',
            "login_url" => 'required|string|max:200'
        ]);
        $data = $request->only("name", "login_url");
        $store = ReportSource::create($data);
        if ($store instanceof ReportSource) {
            return response()->json([
                'status' => 'success',
                'toUrl' => route('report-sources.index'),
                'msg' => $request?->first_name . 'Report Source Added Successfully..!',
            ]);
        } else {
            return back()->with('msg', 'Some error occur..');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $reportSource = ReportSource::where('slug', $slug)->first();
        if ($reportSource) {
            return response()->json([
                'status' => 'success',
                'reportSource' => $reportSource,
            ]);
        }
    
        return response()->json(['status' => 'error', 'msg' => 'Report Source not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $request->validate([
            "name" => 'required|string',
            "login_url" => 'required|string|max:200',
        ]);
    
        $reportSource = ReportSource::where('slug', $slug)->first();
        if ($reportSource) {
            $reportSource->update($request->only('name', 'login_url'));
    
            return response()->json([
                'status' => 'success',
                'toUrl' => route('report-sources.index'),
                'msg' => 'Report Source updated successfully!',
            ]);
        }
    
        return response()->json(['status' => 'error', 'msg' => 'Failed to update Report Source'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        ReportSource::where('slug', $slug)->delete();
        return back()->with('msg', 'The report source has been deleted successsfully..');
    }
}
