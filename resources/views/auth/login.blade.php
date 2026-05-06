<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - XVolty Trade</title>
    <link rel="stylesheet" href="{{ asset('assets/My Dashboard â€” XVolty Trade_files/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/My Dashboard â€” XVolty Trade_files/theme.css') }}">
</head>
<body style="background: #0b1220; display: flex; align-items: center; justify-content: center; height: 100vh;">
    <div class="card border-themed" style="width: 100%; max-width: 400px; background: #1a222d;">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <h4 class="text-white">Welcome Back</h4>
                <p class="text-muted small">Login to access your dashboard</p>
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

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-white">Email Address</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-white">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign In</button>
            </form>

            <div class="mt-3 text-center small">
                <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-primary">Register</a></p>
                <div class="mt-2 text-warning" style="font-size: 0.8rem;">
                    Admin Login: admin@xvoltytrade.com / password<br>
                    User Login: user@xvoltytrade.com / password
                </div>
            </div>
        </div>
    </div>
</body>
</html>
