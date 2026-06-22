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

<div class="mt-3 container-fluid">

    <!-- Header -->
    <div class="mb-3 d-flex justify-content-between align-items-center">

        <h4 class="mb-0">Client Management</h4>

        <!-- Add Client Button -->
        <button class="shadow-sm btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#addClientModal">
            <i class="fa fa-plus me-1"></i> Add Client
        </button>

    </div>

    <!-- Search Box -->
    <div class="mb-3 shadow-sm card">
        <div class="card-body">

            <input type="text"
                   class="form-control"
                   placeholder="Search Client...">

        </div>
    </div>

    <!-- Table Card -->
    <div class="shadow-sm card">

        <div class="bg-white card-header">
            <strong>Client List</strong>
        </div>

        <div class="p-0 card-body">

            <div class="table-responsive">

                <table class="table mb-0 align-middle table-hover">

                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>Client Name</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($clients as $key => $client)
                        <tr>

                            <td>{{ $key+1 }}</td>

                            <td>
                                <strong>{{ $client->client_name }}</strong>
                            </td>

                            <td>{{ $client->company_name }}</td>

                            <td>{{ $client->email }}</td>

                            <td>{{ $client->phone }}</td>

                            <td>
                                @if($client->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($client->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>

                            <td class="text-end">

                                <button class="btn btn-sm btn-info">
                                    <i class="fa fa-eye"></i>
                                </button>

                                <button class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <button class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>

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
<div class="modal fade" id="addClientModal" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="text-white modal-header bg-primary">
                <h5 class="modal-title">Add New Client</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('clients.store') }}">
                @csrf

                <div class="modal-body">

                    <div class="row">

                        <div class="mb-2 col-md-6">
                            <label>Client Name</label>
                            <input type="text" name="client_name" class="form-control" required>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label>Company Name</label>
                            <input type="text" name="company_name" class="form-control" required>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="mb-2 col-md-6">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>

                        <div class="mb-2 col-12">
                            <label>Address</label>
                            <textarea name="address" class="form-control"></textarea>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        Save Client
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@include('layout.footer')

</body>
</html>
