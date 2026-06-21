<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Auth::user()->getRoleNames()->first()}}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f7fe;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar{
            width:260px;
            height:100vh;
            position:fixed;
            left:0;
            top:0;
            background:#111827;
            color:#fff;
        }

        .sidebar .logo{
            padding:20px;
            font-size:22px;
            font-weight:bold;
            text-align:center;
            border-bottom:1px solid #374151;
        }

        .sidebar a{
            color:#d1d5db;
            text-decoration:none;
            display:block;
            padding:14px 20px;
            transition:.3s;
        }

        .sidebar a:hover{
            background:#4f46e5;
            color:#fff;
        }

        .main-content{
            margin-left:260px;
            padding:20px;
        }

        .topbar{
            background:#fff;
            border-radius:15px;
            padding:15px 25px;
            box-shadow:0 4px 12px rgba(0,0,0,.08);
        }

        .stat-card{
            border:none;
            border-radius:20px;
            color:#fff;
            overflow:hidden;
        }

        .stat-card .icon{
            font-size:40px;
            opacity:.3;
        }

        .bg-gradient-primary{
            background:linear-gradient(135deg,#4f46e5,#7c3aed);
        }

        .bg-gradient-success{
            background:linear-gradient(135deg,#10b981,#059669);
        }

        .bg-gradient-warning{
            background:linear-gradient(135deg,#f59e0b,#d97706);
        }

        .bg-gradient-danger{
            background:linear-gradient(135deg,#ef4444,#dc2626);
        }

        .card{
            border:none;
            border-radius:20px;
            box-shadow:0 5px 20px rgba(0,0,0,.08);
        }
    </style>
</head>
