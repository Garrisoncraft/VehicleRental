@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-4">
        <div class="col-md-6">
            <h1 style="color: forestgreen;">Vehicle Inventory</h1>
        </div>
        <div class="col-md-6 text-right">
            @if(auth()->user()->isAdmin())
            <a href="{{ route('vehicles.create') }}" class="btn btn-success" style="background-color: forestgreen; border-color: forestgreen;">
                Add New Vehicle
            </a>
            @endif
        </div>
    </div>

    <div class="card" style="border-color: forestgreen;">
        <div class="card-header" style="background-color: forestgreen; color: white;">
            <div class="row">
                <div class="col-md-6">
                    <h4>All Vehicles</h4>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('vehicles.search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by name or model" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-light" type="submit" style="background-color: brown;">Search</button>
                                @if(request('search'))
                                    <a href="{{ route('vehicles.index') }}" class="btn btn-outline-light" style="background-color: brown;">Clear</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-striped">
                <thead style="background-color: forestgreen; color: white;">
                    <tr>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->name }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>${{ number_format($vehicle->price, 2) }}</td>
                        <td>{{ ucfirst($vehicle->type) }}</td>
                        <td>{{ Str::limit($vehicle->description, 50) }}</td>
                        <td>
                            @if($vehicle->image_url)
                                <img src="{{ asset('vehicle_images/' . $vehicle->image_url) }}" alt="{{ $vehicle->name }}" style="max-height: 50px;">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-info btn-sm">View</a>
                            @if(auth()->user()->isAdmin() || auth()->id() === $vehicle->owner_id)
                            <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $vehicles->links() }}
        </div>
    </div>
</div>
@endsection
