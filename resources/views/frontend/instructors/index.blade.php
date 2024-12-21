<!DOCTYPE html>
<html lang="en">
@include('layouts.header')
<style>
    /* Add some sexy card styles */
    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: linear-gradient(135deg, #ffffff, #f7f7f7);
    }

    .card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
        height: 300px;
        object-fit: cover;
    }

    .card-title {
        font-weight: 600;
        font-size: 1.25rem;
        color: #333;
    }

    .card-text {
        color: #555;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .card-body {
        background: #fff;
        padding: 20px;
    }

    .card-body p:last-of-type {
        margin-bottom: 0;
    }

    .text-center {
        margin-top: 50px;
        margin-bottom: 40px;
        font-size: 2rem;
        font-weight: 700;
        color: #333;
    }

    /* New styles to pin the footer to the bottom */
    html, body {
        height: 100%;
        margin: 0;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    .container {
        flex: 1;
    }

</style>
<body>
<div class="container">
    <h2 class="text-center mb-4">Our Instructors</h2>
    
    <div class="row">
        @foreach($instructors as $instructor)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $instructor->profile_picture }}" class="card-img-top" alt="{{ $instructor->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $instructor->name }}</h5>
                        <p class="card-text">{{ $instructor->email }}</p>
                        <p class="card-text">{{ $instructor->bio }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@include('layouts.footer')
</body>
</html>
