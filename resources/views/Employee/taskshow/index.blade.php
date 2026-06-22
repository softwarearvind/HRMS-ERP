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

<div class="container-fluid">

    <!-- Header -->
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">My Tasks</h4>
    </div>

    <!-- Summary Cards -->
    <div class="mb-3 row">

        <div class="col-md-4">
            <div class="p-3 text-center border-4 shadow-sm card border-start border-warning">
                <h6>Pending</h6>
                <h3>{{ $tasks->where('status','pending')->count() }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 text-center border-4 shadow-sm card border-start border-primary">
                <h6>In Progress</h6>
                <h3>{{ $tasks->where('status','in_progress')->count() }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-3 text-center border-4 shadow-sm card border-start border-success">
                <h6>Completed</h6>
                <h3>{{ $tasks->where('status','completed')->count() }}</h3>
            </div>
        </div>

    </div>

    <!-- Task Cards -->
    <div class="row">

        @forelse($tasks as $task)
        <div class="mb-3 col-md-4">

            <div class="shadow-sm card h-100">

                <div class="card-body">

                    <h5 class="fw-bold">{{ $task->title }}</h5>

                    <p class="text-muted small">
                        {{ $task->description ?? 'No description available' }}
                    </p>

                    <p class="mb-1">
                        <strong>Deadline:</strong>
                        {{ $task->deadline ?? 'Not Set' }}
                    </p>

                    <p>
                        <strong>Status:</strong>

                        @if($task->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($task->status == 'in_progress')
                            <span class="badge bg-primary">In Progress</span>
                        @else
                            <span class="badge bg-success">Completed</span>
                        @endif
                    </p>

                    <!-- Status Update Form -->
                    <form method="POST" action="{{ route('task.status', $task->id) }}">
                      @csrf
                        <select name="status" class="mb-2 form-select form-select-sm">
                            <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>

                        <button class="btn btn-sm btn-success w-100">
                            Update Status
                        </button>
                    </form>

                </div>

            </div>

        </div>
        @empty

        <div class="text-center col-12">
            <h5 class="text-muted">No Tasks Assigned</h5>
        </div>

        @endforelse

    </div>

</div>

</div>

@include('layout.footer')

</body>
</html>

