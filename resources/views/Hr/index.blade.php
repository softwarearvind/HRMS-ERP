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

@include('layout.maincontent');

</div>

@include('layout.footer');

</body>
</html>
