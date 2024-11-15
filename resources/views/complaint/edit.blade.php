@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ $complaint->exists ? route('complaints.update', $complaint) : route('complaints.store') }}" method="POST" class="card">
                    @csrf
                    @method($complaint->exists ? 'PUT' : 'POST')
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <h4 class="card-title fw-bold m-0">{{ $complaint->exists ? $complaint->title : 'Add complaint' }}</h4>
                                <p class="text-muted">Complaint information</p>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $complaint->title) }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" rows="3" class="form-control">{{ old('description', $complaint->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Investigator</label>
                            <select id="user_id" name="user_id" class="form-select">
                                <option></option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @selected($user->id === $complaint->user_id)>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($complaint->latest_action)
                            <div class="mb-3">
                                <label for="description" class="form-label">Status</label>
                                <div>
                                    <span class="badge {{ $complaint->latest_action->action_status->color }}">
                                        {{ $complaint->latest_action->action_status->name }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
