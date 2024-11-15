<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Complaint;
use App\Models\ActionStatus;
use Illuminate\Http\Request;
use App\Http\Requests\StoreComplaintRequest;
use App\Http\Requests\UpdateComplaintRequest;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(auth()->user()->can(['COMPLAINT:LIST']), 403);

        $complaints = Complaint::query()
            ->filters()
            ->when(auth()->user()->hasRole(['investigator']), function ($q) {
                $q->where('user_id', auth()->user()->id);
            })
            ->with('latest_action', 'user')
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        $users = User::select(['id', 'name'])->get();
        
        $actionStatuses = ActionStatus::select(['id', 'name'])->get();

        return view('complaint.index', [
            'complaints' => $complaints,
            'users' => $users,
            'actionStatuses' => $actionStatuses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(auth()->user()->can(['COMPLAINT:CREATE']), 403);

        $users = User::select(['id', 'name'])->get();

        return view('complaint.edit', [
            'complaint' => new Complaint,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComplaintRequest $request)
    {
        abort_unless(auth()->user()->can(['COMPLAINT:CREATE']), 403);

        $request->validate([
            'title' => ['required', 'max:100'],
            'description' => ['required', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $complaint = Complaint::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => $request->input('user_id'),
        ]);

        $complaint->actions()->create([
            'description' => 'New complaint issued',
            'action_status_id' => 3,
        ]);

        return to_route('complaints.index')->with('success', 'Record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        abort_unless(auth()->user()->can(['COMPLAINT:VIEW']), 403);

        $actionStatuses = ActionStatus::whereIn('id', [1, 2])->get();

        return view('complaint.show', [
            'complaint' => $complaint,
            'action_statuses' => $actionStatuses,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        abort_unless(auth()->user()->can(['COMPLAINT:EDIT']), 403);

        $users = User::select(['id', 'name'])->get();

        return view('complaint.edit', [
            'complaint' => $complaint,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComplaintRequest $request, Complaint $complaint)
    {
        abort_unless(auth()->user()->can(['COMPLAINT:EDIT']), 403);

        $request->validate([
            'title' => ['required', 'max:100'],
            'description' => ['required', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $complaint->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => $request->input('user_id'),
        ]);

        return to_route('complaints.index')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        abort_unless(auth()->user()->can(['COMPLAINT:DELETE']), 403);

        $complaint->actions()->delete();

        $complaint->delete();

        return to_route('complaints.index')->with('success', 'Record deleted successfully.');
    }
}
