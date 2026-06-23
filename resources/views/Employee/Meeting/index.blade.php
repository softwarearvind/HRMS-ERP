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

    <!-- TOP BAR -->
    <div class="mb-3 d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            <i class="fa fa-video text-primary me-2"></i>
            Meetings Dashboard
        </h4>



    </div>

    <!-- TABLE CARD -->
    <div class="border-0 shadow-sm card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle table-hover">

                    <thead class="table-primary">
                        <tr>
                            <th>S.No</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Link</th>

                        </tr>
                    </thead>

                   <tbody>

@forelse($meetings as $key => $meeting)

@php
$invite = $meeting->invites->where('user_id',auth()->id())->first();
@endphp

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

@if($invite && $invite->otp_verified)

    <!-- ✅ AFTER OTP VERIFIED -->
    <a href="{{ $meeting->meeting_link }}"
       target="_blank"
       class="btn btn-success btn-sm">

        <i class="fa fa-link"></i> Join

    </a>

@else

    <!-- 🔐 OTP INPUT FORM -->
    <form method="POST" action="{{ route('meeting.verifyOtp') }}">

        @csrf

        <input type="text"
               name="otp"
               class="form-control form-control-sm d-inline w-50"
               placeholder="Enter OTP">

        <input type="hidden"
               name="meeting_id"
               value="{{ $meeting->id }}">

        <button class="btn btn-primary btn-sm">
            Verify
        </button>

    </form>

@endif

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
