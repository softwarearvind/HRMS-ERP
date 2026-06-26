<!DOCTYPE html>
<html lang="en">
@include('layout.csslink')

<body>

<div class="sidebar">
    <div class="logo">
        {{ Auth::user()->getRoleNames()->first() }}
    </div>

    @include('layout.sidebar')
</div>

<div class="main-content">

@include('layout.navber')

<div class="container mt-4">

    <!-- HEADER -->
    <div class="mb-4 d-flex justify-content-between align-items-center">

        <h3 class="mb-0">Attendance Management</h3>

        <!-- ✔ FIX: wrap buttons properly -->
        <div class="gap-2 d-flex">

            <form action="{{ route('attendance.checkin') }}" method="POST">
                @csrf
                <button class="btn btn-success">
                    <i class="fa fa-sign-in-alt"></i> Check In
                </button>
            </form>

            <form action="{{ route('attendance.checkout') }}" method="POST">
                @csrf
                <button class="btn btn-danger">
                    <i class="fa fa-sign-out-alt"></i> Check Out
                </button>
            </form>

        </div>

    </div>

    <!-- CARDS -->
    <div class="mb-4 row">

        <div class="col-md-3">
            <div class="text-white shadow card bg-success">
                <div class="text-center card-body">
                    <h5>Present</h5>
                    <h3>{{ $presentCount ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="text-white shadow card bg-danger">
                <div class="text-center card-body">
                    <h5>Absent</h5>
                    <h3>{{ $absentCount ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="text-white shadow card bg-warning">
                <div class="text-center card-body">
                    <h5>Late</h5>
                    <h3>{{ $lateCount ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="text-white shadow card bg-primary">
                <div class="text-center card-body">
                    <h5>Total Today</h5>
                    <h3>{{ $totalCount ?? 0 }}</h3>
                </div>
            </div>
        </div>

    </div>

    <!-- TABLE -->
    <div class="border-0 shadow card">

        <div class="text-white card-header bg-dark">
            <h5 class="mb-0">Today Attendance List</h5>
        </div>

        <div class="p-0 card-body">

            <table class="table mb-0 table-hover">

                <thead class="table-light">
                    <tr>
                        <th>Employee</th>
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Face Recognition</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($attendances as $att)

                    <tr>
                        <td><strong>{{ $att->employee->name ?? '-' }}</strong></td>

                        <td>{{ $att->date }}</td>

                        <td>
                            <span class="badge bg-success">
                                {{ $att->check_in ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-danger">
                                {{ $att->check_out ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('face.index',$att->id) }}"
                            class="btn btn-primary">
                                Register Face
                            </a>
                        </td>

                        <td>
                            @if($att->status == 'Present')
                                <span class="badge bg-success">Present</span>
                            @elseif($att->status == 'Late')
                                <span class="badge bg-warning text-dark">Late</span>
                            @else
                                <span class="badge bg-danger">Absent</span>
                            @endif
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="py-3 text-center text-muted">
                            No attendance records found
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

@include('layout.footer')

</body>
</html>
