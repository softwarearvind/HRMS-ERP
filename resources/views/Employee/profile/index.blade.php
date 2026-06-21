<!DOCTYPE html>
<html lang="en">
@include('layout.csslink')
<body>

<div class="sidebar">
    <div class="logo">
       {{ Auth::user()->getRoleNames()->first()}}
    </div>

   @include('layout.sidebar')
</div>

<div class="main-content">

@include('layout.navber')

<div class="container mt-4">

    <div class="row">

        <!-- LEFT SIDE PROFILE CARD -->
     <div class="col-md-4">
    <div class="card shadow-lg border-0 text-center p-3">

        <img src="{{ $employee?->photo ? asset('storage/'.$employee->photo) : asset('images/default-user.png') }}"
             class="rounded-circle mx-auto d-block"
             width="120"
             height="120"
             style="object-fit: cover;">

        <h4 class="mt-3">{{ $employee?->name ?? 'N/A' }}</h4>

        <p class="text-muted mb-1">
            {{ $employee?->designation?->name ?? 'No Designation' }}
        </p>

        <span class="badge bg-success">
            {{ $employee?->status ?? 'Inactive' }}
        </span>

        <hr>

        <p class="mb-1">
            <i class="fa fa-envelope text-primary"></i>
            {{ $employee?->email ?? '' }}
        </p>

        <p class="mb-1">
            <i class="fa fa-phone text-success"></i>
            {{ $employee?->phone ?? '' }}
        </p>

        <p class="mb-1">
            <i class="fa fa-building text-warning"></i>
            {{ $employee?->department?->department_name ?? 'No Department' }}
        </p>

    </div>
</div>

        <!-- RIGHT SIDE DETAILS -->
        <div class="col-md-8">

            <div class="card shadow-lg border-0 p-4">

                <h5 class="mb-3">Employee Information</h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Employee ID</label>
                        <input type="text" class="form-control"
                               value="{{ $employee->employee_id ?? '' }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Joining Date</label>
                        <input type="text" class="form-control"
                               value="{{ $employee->joining_date ?? ''  }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Salary</label>
                        <input type="text" class="form-control"
                               value="{{ $employee->salary ?? '' }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Designation</label>
                        <input type="text" class="form-control"
                               value="{{ $employee->designation->name ?? '' }}" readonly>
                    </div>


                    <div class="col-md-6 mb-3">
    <label class="fw-bold text-primary">Team Leader</label>
    <input type="text"
           class="form-control bg-warning-subtle border-warning fw-bold"
           value="{{ $employee?->department?->head_name ?? 'No Department' }}"
           readonly>
</div>

                </div>

               <hr>

<h5 class="mb-3">Quick Actions</h5>

<div class="row">

    <div class="col-md-6 mb-2">
        <a href="#" class="btn btn-primary w-100">
            <i class="fa fa-edit"></i> Edit Profile
        </a>
    </div>

    <div class="col-md-6 mb-2">
        <a href="#" class="btn btn-danger w-100">
            <i class="fa fa-trash"></i> Delete
        </a>
    </div>

</div>

            </div>

        </div>

    </div>
</div>

</div>

@include('layout.footer');

</body>
</html>
