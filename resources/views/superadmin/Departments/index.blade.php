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

<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">
            <i class="fas fa-building me-2"></i>Department List
        </h4>

        <a href="{{ route('Departments.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add Department
        </a>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>Sn</th>
                        <th>Department Name</th>
                        <th>Department Code</th>
                        <th>Head Of Department</th>
                        <th>Total Employees</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($departments as $department)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $department->department_name }}</td>

                        <td>{{ $department->department_code }}</td>

                        <td>{{ $department->head_name }}</td>

                        <td>
                            <span class="badge bg-info">
                                {{   $department->employees_count  ?? 0 }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-success">
                               {{$department->status  }}
                            </span>
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

                            <form action=""
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this department?')">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </form>

                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No Departments Found
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
