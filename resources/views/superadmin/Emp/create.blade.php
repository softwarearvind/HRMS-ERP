<!DOCTYPE html>
<html lang="en">
@include('layout.csslink')
<body>

<div class="sidebar">
    <div class="logo">
        HRMS Admin
    </div>

   @include('layout.sidebar')
</div>

<div class="main-content">

@include('layout.navber');

<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between">
        <h4>Add Employee</h4>

        <a href="{{ route('employee.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    <div class="card-body">

        <form action="{{ route('employees.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Employee ID</label>
                    <input type="text"
                           name="employee_id"
                           class="form-control"
                           placeholder="EMP001">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Employee Name</label>
                    <input type="text"
                           name="name"
                           class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text"
                           name="phone"
                           class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Department</label>
                    <select name="department_id" class="form-select">
                        <option value="">Select Department</option>

                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">
                                {{ $department->department_name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Designation</label>
                    <select name="designation_id" class="form-control">
    @foreach($designations as $designation)
        <option value="{{ $designation->id }}">
            {{ $designation->name }}
        </option>
    @endforeach
</select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Salary</label>
                    <input type="number"
                           name="salary"
                           class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Joining Date</label>
                    <input type="date"
                           name="joining_date"
                           class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Photo</label>
                    <input type="file"
                           name="photo"
                           class="form-control">
                </div>

                 <div class="col-md-6 mb-3">
                    <label>Set Password</label>
                    <input type="password" name="password"class="form-control"  autocomplete="new-password">
                </div>

                <div class="col-md-12">
                    <button class="btn btn-primary">
                        Save Employee
                    </button>
                </div>

            </div>

        </form>

    </div>

</div>

</div>

@include('layout.footer');

</body>
</html>
