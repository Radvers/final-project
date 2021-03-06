@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <form action="{{ route('notes.fullEdit') }}"  method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <div class="form-group">
                <label for="tags">{{ __('Tags') }}</label>
                <select multiple class="form-control" id="tags" name="tags[]">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}"
                                @foreach ($note->tags as $itemTag)
                                    @if($tag->id == $itemTag->id)
                                        selected
                                    @endif
                                @endforeach
                        >
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
                        <option value="{{ $color->id }}" {{ $note->color_id == $color->id ? 'selected' : '' }}>
                            {{ $color->name }}
                        </option>
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
                <input class="form-check-input"
                       type="radio"
                       name="days_to_delete"
                       id="daysToDelete1"
                       value="1"
                       {{ $note->days_to_delete == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="daysToDelete1">
                    Delete after 1 day
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="days_to_delete"
                       id="daysToDelete2"
                       value="15"
                       {{ $note->days_to_delete == 15 ? 'checked' : '' }}>
                <label class="form-check-label" for="daysToDelete2">
                    Delete after 15 days
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="days_to_delete"
                       id="daysToDelete3"
                       value="30"
                       {{ $note->days_to_delete == 30 ? 'checked' : '' }}>
                <label class="form-check-label" for="daysToDelete3">
                    Delete after 30 days
                </label>
            </div>
            @if ($note->file)
                <a type="button"
                   class="btn btn-primary"
                   href="{{ route('file.delete', ['src' => $note->file->src, 'id' => $note->file->id]) }}">
                    Delete file
                </a>
            @else
                <div class="form-group">
                    <label for="file">file input</label>
                    <input type="file" name="file" class="form-control-file" id="file">
                </div>
            @endif
            <div class="form-check">
                <input class="form-check-input-inline"
                       type="checkbox"
                       id="share"
                       name="share"
                       value="0"
                       {{ $note->share == 1 ? ' checked' : '' }}>
                <label class="form-check-label" for="share">Share this note with other</label>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sharedLink" style="margin-left:1rem;">
                    Show link
                </button>
            </div>
            <input type="hidden" name="id" id="id" value="{{ $note->id }}">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>

    <!-- Modal Link -->
    <div class="modal fade" id="sharedLink" tabindex="-1" role="dialog" aria-labelledby="sharedLink" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sharedLink">Link to shared note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $note->formattedShare }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

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