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
            <div class="row">
                @foreach($flyer->photos as $photo)
                    <div class="col-6">
                        <img src="{{ asset($photo->path) }}" class="img-thumbnail">
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <form id="addPhotosForm" action="{{ route('photo.upload', $flyer->id) }}" method="POST" class="dropzone">
        @csrf
    </form>

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