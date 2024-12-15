<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\MonotoringInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitoringInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'report_source_id' => 'required|exists:report_sources,id',
            'username' => 'required|string',
            'password' => 'required|string',
            'client_id' => 'required|exists:clients,slug',
            'security_word' => 'nullable|string'
        ]);
        $data['client_id'] = Client::where('slug', $request->client_id)->value('id');
        DB::transaction(function () use ($data, &$message) {
            $checkMonitoringInfo = MonotoringInfo::where('client_id', $data['client_id'])->first();
            if ($checkMonitoringInfo) {
                $checkMonitoringInfo->update($data);
                $message = 'Monitoring information updated successfully!';
            } else {
                MonotoringInfo::create($data);
                $message = 'Monitoring information created successfully!';
            }
        });
    
        return response()->json([
            'status' => 'success',
            'msg' => $message,
        ]);
        // $checkMonitoringInfo = MonotoringInfo::where('client_id', $data['client_id'])->first();
        // if($checkMonitoringInfo){
        //     $checkMonitoringInfo->update($data);
        // }else{
        //     MonotoringInfo::create($data);
        // }
        // // check if update or create successs then return the response
        // return response()->json([
        //     'status' => 'success',
        //     'msg' => 'Monitoring information updated successfully!',
        // ]);
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
    public function destroy(string $id)
    {
        //
    }
}
