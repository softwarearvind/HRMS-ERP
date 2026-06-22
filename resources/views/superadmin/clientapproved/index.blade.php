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

        <h4 class="mb-0">Client Approval Panel</h4>

        <span class="badge bg-warning text-dark">
            Pending: {{ $clients->count() }}
        </span>

    </div>

    <!-- Table Card -->
    <div class="shadow-sm card">

        <div class="bg-white card-header">
            <strong>Pending Client Requests</strong>
        </div>

        <div class="p-0 card-body">

            <div class="table-responsive">

                <table class="table mb-0 align-middle table-hover">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Client Name</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Requested By</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($clients as $key => $client)

                        <tr>

                            <td>{{ $key + 1 }}</td>

                            <td>
                                <strong>{{ $client->client_name }}</strong>
                            </td>

                            <td>{{ $client->company_name }}</td>

                            <td>{{ $client->email }}</td>

                            <td>{{ $client->phone }}</td>

                            <td>
                                <span class="text-muted">
                                    Manager #{{ $client->manager_id }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>
                            </td>

                            <td class="text-end">

                                <!-- View Button -->
                                <button class="btn btn-sm btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewClient{{ $client->id }}">
                                    <i class="fa fa-eye"></i>
                                </button>

                                <!-- Approve -->
                                <form action="{{ route('client.approve', $client->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf

                                    <button class="btn btn-sm btn-success"
                                            onclick="return confirm('Approve this client?')">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </form>

                                <!-- Reject -->
                                <form action="{{ route('client.reject', $client->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Reject this client?')">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>

                            </td>

                        </tr>

                        <!-- View Modal -->
                        <div class="modal fade" id="viewClient{{ $client->id }}" tabindex="-1">

                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">

                                    <div class="text-white modal-header bg-primary">
                                        <h5 class="modal-title">Client Details</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="mb-2 col-md-6">
                                                <strong>Client Name:</strong><br>
                                                {{ $client->client_name }}
                                            </div>

                                            <div class="mb-2 col-md-6">
                                                <strong>Company:</strong><br>
                                                {{ $client->company_name }}
                                            </div>

                                            <div class="mb-2 col-md-6">
                                                <strong>Email:</strong><br>
                                                {{ $client->email }}
                                            </div>

                                            <div class="mb-2 col-md-6">
                                                <strong>Phone:</strong><br>
                                                {{ $client->phone }}
                                            </div>

                                            <div class="mb-2 col-12">
                                                <strong>Address:</strong><br>
                                                {{ $client->address }}
                                            </div>

                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>

                                </div>

                            </div>

                        </div>

                        @empty

                        <tr>
                            <td colspan="8" class="py-4 text-center text-muted">
                                No pending clients found
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</div>

@include('layout.footer');

</body>
</html>
