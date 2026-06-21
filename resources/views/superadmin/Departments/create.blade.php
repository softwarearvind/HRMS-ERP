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

        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="fas fa-building me-2"></i>
                Add Department
            </h4>

            <a href="{{ route('Departments.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Back
            </a>
        </div>

        <div class="card-body">

            <form action="{{ route('departments.store') }}" method="POST">
                @csrf

                <div class="row">

                    <!-- Department Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Department Name</label>

                        <input type="text"
                               name="department_name"
                               class="form-control @error('department_name') is-invalid @enderror"
                               value="{{ old('department_name') }}"
                               placeholder="Enter Department Name">

                        @error('department_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Department Code -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Department Code</label>

                        <input type="text"
                               name="department_code"
                               class="form-control @error('department_code') is-invalid @enderror"
                               value="{{ old('department_code') }}"
                               placeholder="HR001">

                        @error('department_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Head Name -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Head Of Department</label>

                        <input type="text"
                               name="head_name"
                               class="form-control"
                               value="{{ old('head_name') }}"
                               placeholder="Enter Head Name">
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>

                        <select name="status" class="form-select">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>

                        <textarea name="description"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Department Description">{{ old('description') }}</textarea>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Save Department
                </button>

                <a href="{{ route('Departments.index') }}"
                   class="btn btn-danger">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@include('layout.footer');

</body>
</html>
