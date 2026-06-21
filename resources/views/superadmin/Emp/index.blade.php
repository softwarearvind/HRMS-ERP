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

<div class="card shadow-sm border-0">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">
            <i class="fas fa-users text-primary me-2"></i>
            Employee Management
        </h4>

        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i>
            Add Employee
        </a>
    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover table-bordered align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($employees as $employee)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            @if($employee->photo)
                                <img src="{{ asset('storage/'.$employee->photo) }}"
                                     width="40"
                                     height="40"
                                     class="rounded-circle">
                            @else
                                <img src="https://via.placeholder.com/40"
                                     class="rounded-circle">
                            @endif
                        </td>

                        <td>{{ $employee->employee_id }}</td>

                        <td>{{ $employee->name }}</td>

                        <td>{{ $employee->email }}</td>

                        <td>
                            {{ $employee->department->department_name ?? 'N/A' }}
                        </td>

                        <td>{{ $employee->designation->name ?? '' }}</td>

                        <td>
                            @if($employee->status == 'Active')
                                <span class="badge bg-success">
                                    Active
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td>

                            <a href=""
                               class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href=""
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('employees.delete',$employee->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete Employee?')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            No Employees Found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

@include('layout.footer');

</body>
</html>
