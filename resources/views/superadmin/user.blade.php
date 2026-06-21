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

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">
            <i class="fas fa-users me-2"></i> Users List
        </h4>

        <a href="" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i> Add User
        </a>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Sn</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($user as $key=>$users)
                    <tr>
                        <td>{{ $key+1}}</td>
                        <td>{{ $users->name}}</td>
                        <td>{{ $users->email}}</td>
                        <td>
                        @foreach($users->getRoleNames() as $role)
                            <span class="badge bg-success">{{ $role }}</span>
                        @endforeach
                    </td>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                        <td>
                            <a href="" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
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

@include('layout.footer');

</body>
</html>
