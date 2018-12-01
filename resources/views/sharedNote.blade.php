@extends('layouts.app')

@section('content')
    @if($note)
        <div class="container justify-content-center align-items-center">
            <div class="card {{ $note->color->class }} mb-3">
                <div class="card-header">
                    {{ $note->title }}
                    <div class="row">
                        <div>
                            @foreach($note->tags as $tag)
                                <a class="btn btn-secondary btn-sm"
                                   href="{{ route('file.download', ['src' => $tag->name]) }}">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $note->body }}</p>
                </div>
                <div class="card-footer">
                    @if($note->file)
                        <a class="btn btn-secondary"
                           href="{{ route('file.download', ['src' => $note->file->src]) }}">
                            Download file
                        </a>
                    @endif
                    <p class="card-text">Created at {{ $note->created_at }} by {{ $note->user->name }}</p>
                </div>
            </div>
        </div>
    @else
        <p class="alert alert-warning">This note isn't available.</p>
    @endif
@endsection