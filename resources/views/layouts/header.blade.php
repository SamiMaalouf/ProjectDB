<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>01 Tutor - Your Success is Ours</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700&display=swap&subset=latin-ext" rel="stylesheet" />
</head>

<header class="header">
        <a href="/" class="logo">
            <div class="logo-text">Educational<span>Center</span></div>
        </a>
        <nav class="nav">
            <a href="/">Home</a>
            <a href="/courses">Courses</a>
            <a href="/instructors">Instructors</a>
            <a href="/frontend/about">About Us</a>
            <a href="/frontend/contact">Contact Us</a>
            <a href="/faq">FAQ</a>
            @guest
                <a href="{{ route('login') }}" class="btn" style="margin-left: 0.5rem;color: white;">Login</a>
                <a href="{{ route('register') }}" class="btn" style="margin-left: 0.5rem;color: white;">Sign up</a>
            @else
                <a href="{{ route('profile.index') }}" class="btn" style="margin-left: 0.5rem;color: white;">Profile</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn" style="margin-left: 0.5rem;color: white;">Logout</button>
                </form>
            @endguest
        </nav>
    </header>