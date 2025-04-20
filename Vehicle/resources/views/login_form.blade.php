@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 500px; margin-top: 50px;">
    <div class="card" style="border-color: forestgreen;">
        <div class="card-header" style="background-color: forestgreen; color: white;">
            <h4>Login</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="email" style="color: brown;">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="password" style="color: brown;">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-success" style="background-color: forestgreen; border-color: forestgreen;">Login</button>
                <a href="{{ route('signup') }}" class="btn btn-link" style="color: brown;">Don't have an account? Sign Up</a>
            </form>
        </div>
    </div>
</div>
@endsection
