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

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">Task Management</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal">
            + Assign Task
        </button>
    </div>

    <!-- Filter Cards -->
    <div class="mb-3 row">
        <div class="col-md-3">
            <div class="p-3 text-center shadow-sm card">
                <h6>Total Tasks</h6>
                <h4>{{ $tasks->count() }}</h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-3 text-center shadow-sm card">
                <h6>Pending</h6>
                <h4 class="text-warning">
                    {{ $tasks->where('status','pending')->count() }}
                </h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-3 text-center shadow-sm card">
                <h6>In Progress</h6>
                <h4 class="text-primary">
                    {{ $tasks->where('status','in_progress')->count() }}
                </h4>
            </div>
        </div>

        <div class="col-md-3">
            <div class="p-3 text-center shadow-sm card">
                <h6>Completed</h6>
                <h4 class="text-success">
                    {{ $tasks->where('status','completed')->count() }}
                </h4>
            </div>
        </div>
    </div>

    <!-- Task Table -->
    <div class="shadow-sm card">
        <div class="card-body">

            <table class="table align-middle table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Task</th>
                        <th>Assigned To</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tasks as $key => $task)
                    <tr>
                        <td>{{ $key + 1 }}</td>

                        <td>
                            <strong>{{ $task->title }}</strong><br>
                            <small class="text-muted">{{ $task->description }}</small>
                        </td>

                        <td>
                            {{ $task->assignedTo->name ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $task->deadline ?? 'No Deadline' }}
                        </td>

                        <td>
                            @if($task->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($task->status == 'in_progress')
                                <span class="badge bg-primary">In Progress</span>
                            @else
                                <span class="badge bg-success">Completed</span>
                            @endif
                        </td>

                        <td>
                 <a href="" class="btn btn-sm btn-info" title="View"><i class="fa fa-eye"></i></a>
                <a href="" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
<form action="{{ route('task.destroy', $task->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
        <i class="fa fa-trash"></i>
    </button>
</form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>

---

<!-- Assign Task Modal -->
<div class="modal fade" id="taskModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form method="POST" action="{{ route('task.store') }}">
        @csrf

        <div class="modal-header">
            <h5 class="modal-title">Assign New Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-2">
                <label>Task Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-2">
                <label>Assign To</label>
                <select name="assigned_to" class="form-control" required>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label>Deadline</label>
                <input type="date" name="deadline" class="form-control">
            </div>

        </div>

        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary">Assign Task</button>
        </div>

      </form>

    </div>
  </div>
</div>

</div>

@include('layout.footer')

</body>
</html>
