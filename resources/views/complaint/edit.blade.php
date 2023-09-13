@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md 12">
            <div class="card">
                <div class="card-header">
                    Edit Complaint - {{ $complaint->title }}
                </div>
                <div class="card-body">
                    <form action="{{ route('complaint.update', $complaint) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $complaint->title) }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="5" class="form-control">{{ old('description', $complaint->description) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection