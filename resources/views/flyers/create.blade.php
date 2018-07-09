@extends('layouts.index')

@section('content')
    <h1>Selling your home?</h1>

    <div class="row">
        <form class="col-6" action="{{ route('flyers.store') }}" method="POST" enctype="multipart/form-data">

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @csrf
            <fieldset>
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}">
                </div>

                <div class="form-group">
                    <label for="street">City:</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
                </div>

                <div class="form-group">
                    <label for="street">Zip/Postal Code:</label>
                    <input type="text" name="zip" id="zip" class="form-control" value="{{ old('zip') }}">
                </div>

                <div class="form-group">
                    <label for="street">Country:</label>
                    <select name="country" id="country" class="form-control">
                        @foreach($countries as $name => $code)
                            <option value="{{ $code }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="street">State:</label>
                    <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}">
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="street">Sale price:</label>
                    <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
                </div>

                <div class="form-group">
                    <label for="street">Description:</label>
                    <textarea type="text" name="description" id="description" class="form-control" rows="8">
                    {{ old('description') }}
                </textarea>
                </div>
            </fieldset>

            <div class="form-group">
                <button class="btn btn-primary">Create Flyer</button>
            </div>
        </form>
    </div>
@endsection