<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Instruction;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.instructions.index', [
            'instructions' => Instruction::orderByDesc('id')->paginate(10),
        ]);
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
        $request->validate([
            "name" => 'required|string',
            "instruction" => 'required|string|max:2000'
        ]);
        $data = $request->only("name", "instruction");
        $store = Instruction::create($data);
        if ($store instanceof Instruction) {
            return response()->json([
                'status' => 'success',
                'toUrl' => route('instructions.index'),
                'msg' => $request?->first_name . 'Instruction Added Successfully..!',
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
        $reportSource = Instruction::where('slug', $slug)->first();
        if ($reportSource) {
            return response()->json([
                'status' => 'success',
                'reportSource' => $reportSource,
            ]);
        }
    
        return response()->json(['status' => 'error', 'msg' => 'Instruction not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $request->validate([
            "name" => 'required|string',
            "instruction" => 'required|string|max:2000',
        ]);
    
        $reportSource = Instruction::where('slug', $slug)->first();
        if ($reportSource) {
            $reportSource->update($request->only('name', 'instruction'));
    
            return response()->json([
                'status' => 'success',
                'toUrl' => route('instructions.index'),
                'msg' => 'Instruction updated successfully!',
            ]);
        }
    
        return response()->json(['status' => 'error', 'msg' => 'Failed to update Instruction'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        Instruction::where('slug', $slug)->delete();
        return back()->with('msg', 'The instruction has been deleted successsfully..');
    }
}
