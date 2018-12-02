@extends('layouts.app')

@section('content')
    <form action="{{ route('notes.store') }}"  method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <div class="form-group">
                <label for="tags">{{ __('Tags') }}</label>
                <select multiple class="form-control" id="tags" name="tags[]">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTag">
                    Add new tag
                </button>
            </div>
            <div class="form-group">
                <label for="color_id">{{ __('Color') }}</label>
                <select class="form-control" name="color_id" id="color_id">
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="form-group">
                <label for="body">{{ __('Body') }}</label>
                <textarea class="form-control" id="body" name="body" rows="4"></textarea>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="days_to_delete" id="daysToDelete1" value="1" checked>
                <label class="form-check-label" for="daysToDelete1">
                    Delete after 1 day
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="days_to_delete" id="daysToDelete2" value="15">
                <label class="form-check-label" for="daysToDelete2">
                    Delete after 15 days
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="days_to_delete" id="daysToDelete3" value="30">
                <label class="form-check-label" for="daysToDelete3">
                    Delete after 30 days
                </label>
            </div>
            <div class="form-group">
                <label for="file">file input</label>
                <input type="file" name="file" class="form-control-file" id="file">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="share" name="share" value="0">
                <label class="form-check-label" for="share">Share this note with other</label>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>

    <!-- Modal Add tag -->
    <div class="modal fade" id="addTag" tabindex="-1" role="dialog" aria-labelledby="sharedLink" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sharedLink">Create New Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('tag.store') }}"  method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="tagName">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" id="tagName">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection