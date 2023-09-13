@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title">{{ __('Complaint Lists') }}</div>
                    <div>
                        <a href="{{ route('complaint.create') }}" class="btn btn-primary">Create</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($complaints as $complaint)
                            <tr>
                                <td>{{ $complaints->firstItem() + $loop->index }}</td>
                                <th>{{ $complaint->id }}</th>
                                <td>{{ $complaint->title }}</td>
                                <td>{{ $complaint->description }}</td>
                                <td>
                                    <a href="{{ route('complaint.edit', $complaint) }}">Edit</a>
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