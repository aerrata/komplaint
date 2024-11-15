@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <h4 class="card-title fw-bold m-0">Complaints</h4>
                                <p class="text-muted">List all issued complaints</p>
                            </div>
                            @can('COMPLAINT:CREATE')
                            <a href="{{ route('complaints.create') }}" class="btn btn-primary">Add</a>
                            @endcan
                        </div>
                        @can('COMPLAINT:FILTER')
                            <form action="{{ route('complaints.index') }}" class="d-flex align-items-center mb-3">
                                <div class="form-floating me-3">
                                    <input id="title" class="form-control" name="filters[title]" value="{{ request('filters.title') }}">
                                    <label for="title">Title</label>
                                </div>
                                <div class="form-floating me-3">
                                    <select id="user_id" class="form-select" name="filters[user_id]">
                                        <option></option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @selected($user->id == request('filters.user_id'))>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="user_id">Assigned investigator</label>
                                </div>
                                <div class="form-floating me-3">
                                    <select id="action_status_id" class="form-select" name="filters[action_status_id]">
                                        <option></option>
                                        @foreach ($actionStatuses as $actionStatus)
                                            <option value="{{ $actionStatus->id }}" @selected($actionStatus->id == request('filters.action_status_id'))>{{ $actionStatus->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="action_status_id">Status</label>
                                </div>
                                <button type="submit" class="btn btn-primary me-3">Search</button>
                                <a href="{{ url()->current() }}" class="btn btn-danger">Reset</a>
                            </form>
                        @endcan
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Assigned investigator</th>
                                    <th>Status</th>
                                    <th>Date created</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($complaints as $complaint)
                                    <tr>
                                        <td>{{ $complaints->firstItem() + $loop->index }}</td>
                                        <th>{{ $complaint->id }}</th>
                                        <td>{{ $complaint->title }}</td>
                                        <td>{{ $complaint->user ? $complaint->user->name : '-' }}</td>
                                        <td>
                                            <span class="badge {{ $complaint->latest_action?->action_status->color }}">
                                                {{ $complaint->latest_action?->action_status->name }}
                                            </span>
                                        </td>
                                        <td>{{ $complaint->created_at->format('d/m/Y H:i:s a') }}</td>
                                        <td>
                                            @can('COMPLAINT:VIEW')
                                                <a href="{{ route('complaints.show', $complaint) }}" class="me-3">View</a>
                                            @endcan
                                            @can('COMPLAINT:EDIT')
                                                <a href="{{ route('complaints.edit', $complaint) }}" class="me-3">Edit</a>
                                            @endcan
                                            @can('COMPLAINT_ACTION:EDIT')
                                                <a href="{{ route('complaints.actions.index', $complaint) }}" class="me-3">Change status</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    No records.
                                @endforelse
                            </tbody>
                        </table>

                        {{ $complaints->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
