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

            <h3 class="text-center mb-4">Create Account</h3>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

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

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <!-- Role Selection -->
                <div class="mb-3">
                    <label>Select Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Select Role --</option>
                         @foreach($roles as $role)
                    <option value="{{ $role->name }}">
                        {{ $role->name }}
                    </option>
                @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-custom">
                    Register
                </button>

                <p class="text-center mt-3">
                    Already have an account?
                    <a href="{{ route('login') }}">Login</a>
                </p>

            </form>

        </div>

    </div>

</div>

<!-- Stats -->


<!-- CTA -->
@include('websitefooter');

</body>
</html>
```
