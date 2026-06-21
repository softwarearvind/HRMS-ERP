<!DOCTYPE html>
<html lang="en">
@include('websitelink')
<body>

<!-- Navbar -->
@include('websitenav')

<!-- Hero -->
<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">

    <div class="col-md-5">

        <div class="card p-4">

            <h3 class="text-center mb-3">Forgot Password</h3>

            <p class="text-muted text-center">
                Enter your email and we will send you a password reset link.
            </p>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100 btn-custom">
                    Send Reset Link
                </button>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">Back to Login</a>
                </div>

            </form>

        </div>

    </div>

</div>

<!-- CTA -->
@include('websitefooter');

</body>
</html>
```
