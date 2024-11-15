@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <h4 class="card-title fw-bold m-0">{{ $complaint->title }}</h4>
                                <p class="text-muted">Complaint information</p>
                            </div>
                            <div class="d-flex align-items-center">
                                @can('COMPLAINT:EDIT')
                                    <a href="{{ route('complaints.edit', $complaint) }}" type="submit" class="btn btn-primary me-2">Edit</a>
                                @endcan
                                @can('COMPLAINT:DELETE')
                                    <form action="{{ route('complaints.destroy', $complaint) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Betul ke nak delete ni?')">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                        <form action="{{ route('complaints.update', $complaint) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <div>{{ $complaint->title }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <div>{{ $complaint->description }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Investigator</label>
                                <div>{{ $complaint->user->name }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Status</label>
                                <div>
                                    <span class="badge {{ $complaint->latest_action->action_status->color }}">
                                        {{ $complaint->latest_action->action_status->name }}
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
