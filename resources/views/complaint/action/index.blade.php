@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('complaints.actions.store', ['complaint' => $complaint]) }}" method="POST" class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <h4 class="card-title fw-bold m-0">Actions</h4>
                                <p class="text-muted">Manage complaint action status</p>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        <h4 class="card-title fw-bold m-0"></h4>
                        <p class="text-muted"></p>
                        @csrf
                        <div class="mb-3">
                            <label for="action_status" class="form-label">Status</label>
                            @foreach ($action_statuses as $action_status)
                                <div class="form-check">
                                    <input id="action-status-{{ $action_status->id }}" class="form-check-input" type="radio" name="action_status_id" value="{{ $action_status->id }}">
                                    <label class="form-check-label" for="action-status-{{ $action_status->id }}">
                                        <span class="badge {{ $action_status->color }}">
                                            {{ $action_status->name }}
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                        </div>
                        <hr class="my-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Date created</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($actions as $action)
                                    <tr @class(['table-primary' => $loop->first])>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $action->description }}</td>
                                        <td>
                                            <span class="badge {{ $action->action_status->color }}">
                                                {{ $action->action_status->name }}
                                            </span>
                                        </td>
                                        <td>{{ $action->created_at->format('d/m/Y H:i:s a') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
