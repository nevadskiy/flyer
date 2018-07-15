@extends('layouts.index')

@section('content')
    <div class="jumbotron bg-transparent">
        <h1 class="display-4">Project flyer</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        @auth
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="{{ route('flyers.create') }}" role="button">Create a flyer</a>
        </p>
        @else
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Sign up</a>
        </p>
        @endauth

    </div>
@endsection