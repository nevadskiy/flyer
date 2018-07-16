@extends('layouts.index')

@section('styles')
    @parent
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.css">
@endsection

@section('content')
    <div class="row py-2">
        <div class="col-6">
            <h1>{{ $flyer->street }}</h1>
            <h2>{{ $flyer->price }}</h2>

            <hr>

            <div class="description">{{ nl2br($flyer->description) }}</div>
        </div>
        <div class="col-6">
            @foreach($flyer->photos->chunk(4) as $set)
            <div class="row">
                @foreach($set as $photo)
                    <div class="col-6">
                        <a href="{{ asset($photo->path) }}" data-lity>
                            <img src="{{ asset($photo->thumbnail_path) }}" class="img-thumbnail">
                        </a>

                        <form action="{{ route('photo.remove', $photo->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>

    @if(auth()->check() && auth()->user()->owns($flyer))
    <form id="addPhotosForm" action="{{ route('photo.upload', $flyer->id) }}" method="POST" class="dropzone">
        @csrf
    </form>
    @endif

@endsection

@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
    <script>
      Dropzone.options.addPhotosForm = {
        paramName: 'photo',
        maxFilesize: 3,
        acceptedFiles: '.jpeg,.jpg,.png,.bmp,.gif,.svg'
      }
    </script>
@endsection