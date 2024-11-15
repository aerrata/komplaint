<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\ActionStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActionRequest;
use App\Http\Requests\UpdateActionRequest;
use App\Models\Complaint;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Complaint $complaint)
    {
        abort_unless(auth()->user()->can(['COMPLAINT_ACTION:EDIT']), 403);

        $actionStatuses = ActionStatus::whereIn('id', [1, 2])->get();

        return view('complaint.action.index', [
            'complaint' => $complaint,
            'actions' => $complaint->actions()->orderBy('created_at', 'desc')->get(),
            'action_statuses' => $actionStatuses,
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
    public function store(StoreActionRequest $request, Complaint $complaint)
    {
        abort_unless(auth()->user()->can(['COMPLAINT_ACTION:EDIT']), 403);

        $request->validate([
            'action_status_id' => ['required'],
            'description' => ['required'],
        ]);

        $complaint->actions()->create([
            'complaint_id' => $complaint->id,
            'description' => $request->input('description'),
            'action_status_id' => $request->input('action_status_id'),
        ]);

        $complaint->touch();

        return to_route('complaints.index')->with('success', 'Status updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Action $action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Action $action)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActionRequest $request, Action $action)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Action $action)
    {
        //
    }
}
