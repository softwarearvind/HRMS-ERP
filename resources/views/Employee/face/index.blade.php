<!DOCTYPE html>
<html lang="en">
@include('layout.csslink')

<style>
body{
    background:#f4f7fc;
}

.card{
    border:none;
    border-radius:15px;
}

.profile-img{
    width:150px;
    height:150px;
    border-radius:50%;
    border:5px solid #0d6efd;
    object-fit:cover;
}

.camera-box{
    border:4px solid #0d6efd;
    border-radius:15px;
    overflow:hidden;
    background:#000;
}

#video{
    width:100%;
    height:500px;
    object-fit:cover;
}

.info-box{
    font-size:15px;
}

.info-box td{
    padding:10px;
}

.status{
    font-size:16px;
    font-weight:bold;
}
</style>

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

<div class="row">

<div class="col-md-4">

<div class="shadow card">

<div class="text-white card-header bg-primary">
<h5>
<i class="fa fa-user"></i>
Employee Details
</h5>
</div>

<div class="text-center card-body">

@if($employee->photo)

<img src="{{ asset('storage/'.$employee->photo) }}"
class="profile-img">

@else

<img src="https://via.placeholder.com/150"
class="profile-img">

@endif

<h4 class="mt-3">
{{ $employee->name }}
</h4>

<table class="table info-box">

<tr>
<th>Employee ID</th>
<td>{{ $employee->employee_id }}</td>
</tr>

<tr>
<th>Email</th>
<td>{{ $employee->email }}</td>
</tr>

<tr>
<th>Phone</th>
<td>{{ $employee->phone }}</td>
</tr>

<tr>


<tr>
<th>Status</th>

<td>

@if($employee->status=="Active")

<span class="badge bg-success">
Active
</span>

@else

<span class="badge bg-danger">
Inactive
</span>

@endif

</td>

</tr>

<tr>

<th>Face Status</th>

<td>

@if($employee->face_image)

<span class="badge bg-success">

Registered

</span>

@else

<span class="badge bg-warning text-dark">

Not Registered

</span>

@endif

</td>

</tr>

</table>

</div>

</div>

</div>

<div class="col-md-8">

<div class="shadow card">

<div class="text-white card-header bg-dark">

<h5>

<i class="fa fa-camera"></i>

AI Face Scanner

</h5>

</div>

<div class="card-body">

<div class="camera-box">

<video id="video" autoplay muted></video>

<canvas id="canvas" style="display:none;"></canvas>

</div>

<div class="mt-4 text-center">

<button id="startCamera"
class="btn btn-success btn-lg">

<i class="fa fa-video"></i>

Start Camera

</button>

<button id="registerFace"
class="btn btn-primary btn-lg">

<i class="fa fa-user-check"></i>

Register Face

</button>

</div>

<div class="mt-4 text-center">

<h5>

Face Detection Status

</h5>

<span
id="status"
class="p-3 badge bg-danger status">

Waiting For Camera

</span>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

@include('layout.footer')

<script>

let video = document.getElementById('video');
let canvas = document.getElementById('canvas');
let preview = document.getElementById('preview');

let startCamera = document.getElementById('startCamera');
let registerFace = document.getElementById('registerFace');
let status = document.getElementById('status');

let stream;

// Camera Start
startCamera.addEventListener('click', async function () {

    try{

        stream = await navigator.mediaDevices.getUserMedia({
            video:{
                width:640,
                height:480,
                facingMode:"user"
            }
        });

        video.srcObject = stream;

        status.innerHTML = "Camera Started";
        status.className = "badge bg-success p-3";

    }catch(error){

        alert("Camera Permission Denied");

        console.log(error);

    }

});


// Capture Face





</script>

<script>
    
registerFace.addEventListener('click',function(){

    let ctx = canvas.getContext("2d");

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    ctx.drawImage(video,0,0);

    let image = canvas.toDataURL("image/png");

    document.getElementById("face_image").value = image;

    preview.src = image;

    preview.style.display="block";

    status.innerHTML="Face Captured Successfully";

    status.className="badge bg-primary p-3";

});
</script>


<script>
    const detection = await faceapi
    .detectSingleFace(
        video,
        new faceapi.TinyFaceDetectorOptions()
    )
    .withFaceLandmarks()
    .withFaceDescriptor();

if (detection) {

    console.log("Face Detected");

    console.log(detection.descriptor);

}

const distance = faceapi.euclideanDistance(
    savedDescriptor,
    currentDescriptor
);

if (distance < 0.5) {

    console.log("Matched");

}
</script>

</body>

</html>