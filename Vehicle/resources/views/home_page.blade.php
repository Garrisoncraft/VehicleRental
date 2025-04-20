@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<style>
    .hero-background {
        position: relative;
        background-image: url('{{ asset("vehicle_images/vehicle1.jpeg") }}');
        background-size: cover;
        background-position: center;
        filter: blur(5px);
        -webkit-filter: blur(5px);
        height: 300px;
        width: 100%;
    }
    .hero-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-align: center;
        z-index: 2;
    }
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 300px;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }
</style>
<div class="position-relative">
    <div class="hero-background"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="display-4">Welcome to CraftyConnect</h1>
        <p class="lead">Your trusted platform for buying, selling, and renting vehicles</p>
        <a href="{{ route('vehicles.index') }}" class="btn btn-light btn-lg mt-3">Browse Vehicles</a>
    </div>
</div>

<!-- Featured Vehicles Section -->
<div class="container my-5">
    <h2 class="text-center mb-4" style="color: forestgreen;">Featured Vehicles</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('vehicle_images/vehicle5.jpg') }}" alt="Luxury Sedan" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Luxury Sedan</h5>
                    <p class="card-text">Experience premium comfort and performance.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('vehicle_images/vehicle6.jpg') }}" alt="SUV Adventure" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">SUV Adventure</h5>
                    <p class="card-text">Built for all your outdoor adventures.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('vehicle_images/vehicle1.jpeg') }}" alt="Compact City Car" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Compact City Car</h5>
                    <p class="card-text">Perfect for urban commuting.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Us Section -->
<div class="container my-5">
    <h2 class="text-center mb-4" style="color: forestgreen;">About CraftyConnect</h2>
    <p class="text-center lead">
        CraftyConnect is your trusted platform for buying, selling, and renting vehicles with ease and confidence.
        <a href="{{ route('about') }}" class="btn btn-outline-success btn-sm ml-2">Learn More</a>
    </p>
</div>

<!-- Contact Form Section -->
<div class="container my-5">
    <h2 class="text-center mb-4" style="color: forestgreen;">Contact Us</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="text-brown">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="text-brown">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="message" class="text-brown">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-success" style="background-color: forestgreen; border-color: forestgreen;">Send Message</button>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <p>&copy; {{ date('Y') }} CraftyConnect. All rights reserved.</p>
        <a href="{{ route('about') }}" class="text-white mx-2">About Us</a>
        <a href="{{ route('home_page') }}" class="text-white mx-2">Home</a>
    </div>
</footer>
@endsection
