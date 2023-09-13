<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComplaintRequest;
use App\Http\Requests\UpdateComplaintRequest;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = Complaint::paginate(15);

        return view('complaint.index', [
            'complaints' => $complaints
        ]);

        // return view('complaint.index', compact('complaints'));
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
    public function store(StoreComplaintRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        return view('complaint.edit', [
            'complaint' => $complaint
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComplaintRequest $request, Complaint $complaint)
    {
        // dd($request->all());

        // 1. Validate form data
        $request->validate([
            'title' => ['required', 'max:10'],
            'description' => ['required']
        ]);

        // 2. Update the data
        $complaint->update([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);

        // 3. Redirect user to another page
        return back()->with('success', 'Record updated successfully.');
        // return to_route('complaint.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        //
    }
}
