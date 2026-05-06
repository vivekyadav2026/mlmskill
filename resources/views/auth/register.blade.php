<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - XVolty Trade</title>
    <link rel="stylesheet" href="{{ asset('assets/My Dashboard â€” XVolty Trade_files/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/My Dashboard â€” XVolty Trade_files/theme.css') }}">
</head>
<body style="background: #0b1220; display: flex; align-items: center; justify-content: center; height: 100vh;">
    <div class="card border-themed" style="width: 100%; max-width: 400px; background: #1a222d;">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <h4 class="text-white">Create Account</h4>
                <p class="text-muted small">Join XVolty Trade today</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger small">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-white">Full Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Email Address</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>

            <div class="mt-3 text-center small">
                <p class="text-muted">Already have an account? <a href="{{ route('login') }}" class="text-primary">Sign In</a></p>
            </div>
        </div>
    </div>
</body>
</html>
