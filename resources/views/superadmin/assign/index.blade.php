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

<form action="{{ route('assign.manager.store') }}" method="POST">
    @csrf

    <div class="row">

        <div class="col-md-6 mb-3">
            <label>Select Employee</label>
            <select name="employee_id" class="form-control" required>
                <option value="">Select Employee</option>

                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>



    </div>

    <button type="submit" class="btn btn-primary">
        Assign Manager
    </button>
</form>

</div>

@include('layout.footer');

</body>
</html>
