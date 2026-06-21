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

            <h3 class="text-center mb-4">HRMS ERP Login</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <!-- Remember -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember">
                    <label class="form-check-label">Remember Me</label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-primary w-100 btn-custom">
                    Login
                </button>

                <!-- Forgot Password -->
                <div class="text-end mt-2">
                    <a href="{{ route('password.request') }}">
                        Forgot Password?
                    </a>
                </div>

                <p class="text-center mt-3">
                    Don't have an account?
                    <a href="{{ route('register') }}">Register</a>
                </p>

            </form>

        </div>

    </div>

</div>

<!-- CTA -->
@include('websitefooter');

</body>
</html>
```
