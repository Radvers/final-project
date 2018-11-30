@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    @if($notes->count())
        <div class="card-group">
            @foreach($notes as $note)
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="card {{ $note->color->class }} mb-6" style="max-width: 22rem; margin-bottom: 1rem;">
                        <div class="card-header">{{ $note->title }}</div>
                        <div class="card-body">
                            {{--<h5 class="card-title">Tags</h5>--}}
                            <p class="card-text">{{ $note->body }}</p>
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   more
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{  route('notes.delete', ['id '=> $note->id]) }}" class="dropdown-item btn">{{ __('Delete') }}</a>
                                    <button type="button"
                                           class="dropdown-item update-note"
                                           data-toggle="modal"
                                           data-target="#updateNote"
                                           data-id="{{ $note->id }}"
                                           data-color="{{ $note->color_id }}"
                                           data-title="{{ $note->title }}"
                                           data-body="{{ $note->body }}"
                                           data-share="{{ $note->share }}">{{ __('Quick Edit') }}</button>
                                    <a href="{{  route('notes.update', ['id' => $note->id]) }}" class="dropdown-item btn">{{ __('Full edit') }}</a>
                                    @if($note->file)
                                        <a href="{{
                                            route('file.delete', ['src' => $note->file->src, 'id' => $note->file->id])
                                        }}" class="dropdown-item btn">{{ __('Delete file') }}</a>
                                        <a href="{{
                                            route('file.download', ['src' => $note->file->src])
                                        }}" class="dropdown-item btn">{{ __('Download file') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                   </div>
               </div>
            @endforeach
        </div>
    @else
        <p class="alert alert-warning">No notes yet.</p>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="modal fade" id="updateNote" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Update Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('notes.quickEdit') }}"  method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title:</label>
                            <input type="text" name="title" class="form-control" id="title" value="">
                        </div>
                        <div class="form-group">
                            <label for="color">Example select</label>
                            <select class="form-control" id="color" name="color_id">
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="body" class="col-form-label">Body:</label>
                            <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="share" name="share" value="0">
                            <label class="form-check-label" for="share">Share this note with other</label>
                        </div>
                        <input type="hidden" name="id" id="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.update-note').click(function () {
                $("#title").val($(this).attr('data-title'));
                $("#body").val($(this).attr('data-body'));
                $("#id").val($(this).attr('data-id'));
                $("[name=color_id]").val($(this).attr('data-color'));

                if ($(this).attr('data-share') == 1) {
                    $("#share").prop('checked',true);
                } else {
                    $("#share").prop('checked',false);
                };
            });
        });
    </script>
@endsection