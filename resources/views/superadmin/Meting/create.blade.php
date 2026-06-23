<!DOCTYPE html>
<html lang="en">
@include('layout.csslink')
<body>
    <style>
.form-check {
    cursor: pointer;
    transition: 0.2s;
}

.form-check:hover {
    background: #f1f5ff;
    border-color: #0d6efd;
}
</style>

<div class="sidebar">
    <div class="logo">
       {{ Auth::user()->getRoleNames()->first()}}
    </div>

   @include('layout.sidebar')
</div>

<div class="main-content">

@include('layout.navber')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="border-0 shadow-lg card">
                <div class="text-white card-header bg-primary">
                    <h4 class="mb-0">
                        <i class="fa fa-video-camera me-2"></i>
                        Create Meeting
                    </h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('meetings.store') }}" method="POST">
                        @csrf

                        <!-- Meeting Title -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Meeting Title
                            </label>
                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   placeholder="Enter Meeting Title"
                                   required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Description
                            </label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Enter Meeting Description"></textarea>
                        </div>

                        <!-- Meeting Link -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Meeting Link
                            </label>
                            <input type="url"
                                   name="meeting_link"
                                   class="form-control"
                                   placeholder="https://meet.google.com/xyz">
                        </div>

                        <div class="row">

                            <!-- Meeting Date -->
                            <div class="mb-3 col-md-4">
                                <label class="form-label fw-bold">
                                    Meeting Date
                                </label>
                                <input type="date"
                                       name="meeting_date"
                                       class="form-control"
                                       required>
                            </div>

                            <!-- Start Time -->
                            <div class="mb-3 col-md-4">
                                <label class="form-label fw-bold">
                                    Start Time
                                </label>
                                <input type="time"
                                       name="start_time"
                                       class="form-control"
                                       required>
                            </div>

                            <!-- End Time -->
                            <div class="mb-3 col-md-4">
                                <label class="form-label fw-bold">
                                    End Time
                                </label>
                                <input type="time"
                                       name="end_time"
                                       class="form-control"
                                       required>
                            </div>

                             <div class="row">

        @foreach($users as $user)

            <div class="mb-2 col-md-4">

                <div class="p-2 border rounded form-check ps-4">

                    <input class="form-check-input"
                           type="checkbox"
                           name="users[]"
                           value="{{ $user->id }}"
                           id="user{{ $user->id }}">

                    <label class="form-check-label" for="user{{ $user->id }}">
                        <i class="fa fa-user me-1 text-primary"></i>
                        {{ $user->name }}

                        <small class="text-muted d-block">
                            {{ $user->role ?? 'User' }}
                        </small>
                    </label>

                </div>

            </div>

        @endforeach

                        </div>

                        <div class="text-end">
                            <button type="reset" class="btn btn-secondary">
                                <i class="fa fa-refresh"></i> Reset
                            </button>

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Create Meeting
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</div>

@include('layout.footer')

</body>
</html>
