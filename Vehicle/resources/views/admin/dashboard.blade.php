@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-center" style="color: forestgreen;">Admin Dashboard</h1>
    <p class="text-center mb-4">Welcome to the admin dashboard. Manage vehicles and users here.</p>

    <div class="row">
        <div class="col-md-6">
            <div class="card border-success mb-4">
                <div class="card-header bg-success text-white">Vehicles Management</div>
                <div class="card-body">
                    <p>View, add, edit, or delete vehicles.</p>
                    <a href="{{ route('vehicles.index') }}" class="btn btn-success">Manage Vehicles</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-primary mb-4">
                <div class="card-header bg-primary text-white">Users Management</div>
                <div class="card-body">
                    <p>Manage user accounts and roles.</p>
                    <a href="#" class="btn btn-primary disabled">Manage Users (Coming Soon)</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
