@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 800px; margin-top: 30px;">
    <div class="card" style="border-color: forestgreen;">
        <div class="card-header" style="background-color: forestgreen; color: white;">
            <h4>Add New Vehicle</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="name" class="text-brown">Vehicle Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="model" class="text-brown">Model</label>
                    <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}" required>
                </div>

                <div class="form-group">
                    <label for="price" class="text-brown">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                </div>

                <div class="form-group">
                    <label for="type" class="text-brown">Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="sale" {{ old('type') == 'sale' ? 'selected' : '' }}>Sale</option>
                        <option value="rent" {{ old('type') == 'rent' ? 'selected' : '' }}>Rent</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description" class="text-brown">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image_url" class="text-brown">Vehicle Image</label>
                    <input type="file" class="form-control-file" id="image_url" name="image_url">
                </div>

                <button type="submit" class="btn btn-success" style="background-color: forestgreen; border-color: forestgreen;">Add Vehicle</button>
                <a href="{{ route('vehicles.index') }}" class="btn btn-secondary text-brown">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
