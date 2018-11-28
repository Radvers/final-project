@extends('layouts.app')

@section('content')
    @foreach($notes as $note)
    <div class="card">
        <div class="card-header">
            {{$note->title}}
        </div>
        <div class="card-body">
            <p class="card-text">{{$note->body}}</p>
            <a href="{{route('notes.delete', ['id '=> $note->id])}}" class="btn btn-danger">Delete</a>
        </div>
    </div>
    <hr>
    @endforeach
@endsection