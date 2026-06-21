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

@include('layout.navber');

<h2>🧩 Menu Builder</h2>

<form method="POST" action="{{ route('manu.create') }}">
    @csrf

    <input type="text" name="name" placeholder="Menu Name" class="form-control mb-2">

    <input type="text" name="route" placeholder="Route (e.g. /users)" class="form-control mb-2">

    <input type="text" name="icon" placeholder="Icon (fa fa-user)" class="form-control mb-2">

    <select name="role" class="form-control mb-2">
        <option>Super Admin</option>
        <option>HR Manager</option>
        <option>Manager</option>
        <option>Employee</option>
    </select>

    <button class="btn btn-primary">Add Menu</button>
</form>

<hr>

<h4>📋 Existing Menus</h4>

<table class="table">
    <tr>
        <th>Name</th>
        <th>Route</th>
        <th>Role</th>
    </tr>

    @foreach($menus as $menu)
    <tr>
        <td>{{ $menu->name }}</td>
        <td>{{ $menu->route }}</td>
        <td>{{ $menu->role }}</td>
    </tr>
    @endforeach
</table>

</div>

@include('layout.footer');

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

<script>
Pusher.logToConsole = true;

var pusher = new Pusher('17dbd3c5308a361c0e40', {
    cluster: 'ap2'
});

var channel = pusher.subscribe('menu-channel');

channel.bind('menu.created', function(data) {
    alert("New Menu Created: " + data.menu.name);
});
</script>

</body>
</html>
