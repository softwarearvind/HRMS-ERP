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

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fa fa-user-tag me-2"></i> Designation Management
            </h5>

            <a href="{{ route('designation.create') }}" class="btn btn-light">
                <i class="fa fa-plus-circle me-1"></i> Add Designation
            </a>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>Sn</th>
                            <th><i class="fa fa-user-tag"></i> Designation Name</th>
                            <th><i class="fa fa-building"></i> Department</th>
                            <th><i class="fa fa-calendar"></i> Created Date</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($department as $key=>$departments)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$departments->name}}</td>
                            <td>{{ $departments->department->department_name ?? 'N/A' }}</td>
                            <td>{{ $departments->created_at->format('d-M-Y') }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a href="#" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>

    </div>

</div>

</div>

@include('layout.footer')

</body>
</html>
