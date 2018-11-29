@extends('layouts.app')

@section('content')
    <form action="{{ route('notes.fullEdit') }}"  method="post">
        @csrf
        <div class="col-md-6">
            <div class="form-group">
                <label for="color_id">{{ __('Color') }}</label>
                <select class="form-control" name="color_id" id="color_id">
                    @foreach($colors as $color)
                        <option value="{{ $color->id }}" {{ $note->color_id == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $note->title }}">
            </div>
            <div class="form-group">
                <label for="body">{{ __('Body') }}</label>
                <textarea class="form-control" id="body" name="body" rows="4">{{ $note->body }}</textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="days_to_delete" id="daysToDelete1" value="1" {{ $note->days_to_delete == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="daysToDelete1">
                    Delete after 1 day
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="days_to_delete" id="daysToDelete2" value="15" {{ $note->days_to_delete == 15 ? 'checked' : '' }}>
                <label class="form-check-label" for="daysToDelete2">
                    Delete after 15 days
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="days_to_delete" id="daysToDelete3" value="30" {{ $note->days_to_delete == 30 ? 'checked' : '' }}>
                <label class="form-check-label" for="daysToDelete3">
                    Delete after 30 days
                </label>
            </div>
            <div class="form-group">
                <label for="file">file input</label>
                <input type="file" class="form-control-file" id="file">
            </div>
            <input type="hidden" name="id" id="id" value="{{ $note->id }}">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
@endsection