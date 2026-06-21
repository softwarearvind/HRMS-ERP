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

@include('layout.navber')

<form action="{{ route('designation.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Department</label>

        <select name="department_id" class="form-control">
            <option value="">Select Department</option>

            @foreach($departments as $department)

                <option value="{{ $department->id }}">
                    {{ $department->department_name }}
                </option>

            @endforeach

        </select>
    </div>

    <div class="mb-3">
        <label>Designation Name</label>

        <input type="text"
               name="name"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Description</label>

        <textarea name="description"
                  class="form-control"></textarea>
    </div>

    <button class="btn btn-primary">
        Save
    </button>

</form>

</div>

@include('layout.footer')

</body>
</html>
