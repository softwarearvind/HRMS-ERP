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

<div class="mt-4 container-fluid">

    <!-- Top Header -->
    <div class="mb-3 d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            <i class="fa fa-video me-2 text-primary"></i>
            Meeting Management
        </h4>

        <a href="{{ route('meetings.create') }}" class="shadow-sm btn btn-primary">
            <i class="fa fa-plus me-1"></i>
            Create Meeting
        </a>

    </div>

    <!-- Table Card -->
    <div class="border-0 shadow card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle table-hover">

                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($meetings as $key => $meeting)

                        <tr>
                            <td>{{ $key+1 }}</td>

                            <td>
                                <i class="fa fa-calendar-check text-success me-1"></i>
                                {{ $meeting->title }}
                            </td>

                            <td>
                                <i class="fa fa-calendar text-danger me-1"></i>
                                {{ $meeting->meeting_date }}
                            </td>

                            <td>
                                <i class="fa fa-clock text-warning me-1"></i>
                                {{ $meeting->start_time }} - {{ $meeting->end_time }}
                            </td>

                            <td>
                                <a href="{{ $meeting->meeting_link }}" target="_blank" class="btn btn-sm btn-success">
                                    <i class="fa fa-link"></i> Join
                                </a>
                            </td>

                            <td>

                                <a href="" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action=""
                                      method="POST"
                                      style="display:inline-block">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                </form>

                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No Meetings Found
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

@include('layout.footer')

</body>
</html>
