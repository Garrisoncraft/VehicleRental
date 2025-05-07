@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow" style="border-color: forestgreen;">
        <div class="card-header" style="background-color: forestgreen; color: white;">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Vehicle Details</h3>
                <a href="{{ route('vehicles.index') }}" class="btn btn-light" style="color: brown;">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if($vehicle->image_url)
                    <div class="mb-4 text-center">
                        <img src="{{ asset('vehicle_images/' . $vehicle->image_url) }}" 
                             alt="{{ $vehicle->name }}" 
                             class="img-fluid rounded"
                             style="max-height: 400px; border: 2px solid forestgreen;">
                    </div>
                    @endif
                </div>
                
                <div class="col-md-6">
                    <div class="details-box p-3" style="background-color: #f8f9fa; border-left: 3px solid brown;">
                        <h2 style="color: forestgreen;">{{ $vehicle->name }}</h2>
                        <hr style="border-color: brown;">
                        
                        <div class="detail-item mb-3">
                            <h5 style="color: brown;"><i class="fas fa-car mr-2"></i> Model</h5>
                            <p class="pl-4">{{ $vehicle->model }}</p>
                        </div>
                        
                        <div class="detail-item mb-3">
                            <h5 style="color: brown;"><i class="fas fa-tag mr-2"></i> Price</h5>
                            <p class="pl-4">${{ number_format($vehicle->price, 2) }}</p>
                        </div>

                        <div class="detail-item mb-3">
                            <h5 style="color: brown;"><i class="fas fa-exchange-alt mr-2"></i> Type</h5>
                            <p class="pl-4">{{ ucfirst($vehicle->type) }}</p>
                        </div>

                        <div class="detail-item mb-3">
                            <h5 style="color: brown;"><i class="fas fa-info-circle mr-2"></i> Description</h5>
                            <p class="pl-4">{{ $vehicle->description }}</p>
                        </div>
                        
                        <div class="detail-item">
                            <h5 style="color: brown;"><i class="fas fa-calendar-alt mr-2"></i> Added On</h5>
                            <p class="pl-4">{{ $vehicle->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    
                    @if(auth()->user() && auth()->user()->isAdmin())
                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" 
                           class="btn btn-primary" 
                           style="background-color: forestgreen; border-color: forestgreen;">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        
                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this vehicle?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .detail-item {
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }
    .detail-item:last-child {
        border-bottom: none;
    }
</style>
@endsection
