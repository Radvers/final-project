@extends('layouts.app')

@section('content')
    @if($note)
        <div class="container justify-content-center align-items-center">
            <div class="card {{ $note->color->class }} mb-3">
                <div class="card-header">{{ $note->title }}</div>
                <div class="card-body">
                    <p class="card-text">{{ $note->body }}</p>
                </div>
                <div class="card-footer">
                    <p class="card-text">Created at {{ $note->created_at }} by {{ $note->user->name }}</p>
                </div>
            </div>
        </div>
    @else
        <p class="alert alert-warning">This note isn't available.</p>
    @endif
@endsection