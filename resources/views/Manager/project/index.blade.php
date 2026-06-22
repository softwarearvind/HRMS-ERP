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

        <h4 class="mb-0">Client Projects</h4>

        <!-- Add Project Button -->
        <button class="shadow-sm btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#addProjectModal">
            <i class="fa fa-plus me-1"></i> Add Project
        </button>

    </div>

    <!-- Table -->
    <div class="shadow-sm card">

        <div class="p-0 card-body">

            <div class="table-responsive">

                <table class="table mb-0 align-middle table-hover">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Project Name</th>
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($projects as $key => $project)

                        <tr>

                            <td>{{ $key + 1 }}</td>

                            <!-- Client from Relationship -->
                            <td>
                                <strong>
                                    {{ $project->client->client_name ?? '-' }}
                                </strong>
                            </td>

                            <td>{{ $project->project_name }}</td>

                            <td>

                                @if($project->status == 'new')
                                    <span class="badge bg-secondary">New</span>

                                @elseif($project->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>

                                @elseif($project->status == 'running')
                                    <span class="badge bg-primary">Running</span>

                                @elseif($project->status == 'completed')
                                    <span class="badge bg-success">Completed</span>

                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif

                            </td>

                            <td>{{ $project->start_date }}</td>
                            <td>{{ $project->end_date }}</td>

                            <td class="text-end">

                                <button class="btn btn-sm btn-info">
                                    <i class="fa fa-eye"></i>
                                </button>

                                <button class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </button>

                                <form action="{{ url('/projects/delete/'.$project->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete project?')">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="py-4 text-center text-muted">
                                No Projects Found
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="addProjectModal" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="text-white modal-header bg-primary">
                <h5 class="modal-title">Add New Project</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('projects.store') }}">
                @csrf

                <div class="modal-body">

                    <div class="row">

                        <!-- Client Dropdown (FROM MODEL) -->
                        <div class="mb-2 col-md-6">
                            <label>Client</label>
                            <select name="client_id" class="form-control" required>
                                <option value="">Select Client</option>

                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">
                                        {{ $client->client_name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label>Project Name</label>
                            <input type="text" name="project_name" class="form-control" required>
                        </div>

                        <div class="mb-2 col-12">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>

                        <div class="mb-2 col-md-6">
                            <label>End Date</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-success">
                        Save Project
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

</div>

@include('layout.footer')

</body>
</html>
