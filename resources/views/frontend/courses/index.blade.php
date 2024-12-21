<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.header')
    <!-- Make sure your page is responsive on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Basic resets and typography */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
        }

        /* Header section */
        .courses-header {
            text-align: center;
            padding: 2rem 1rem;
            background-color: #f4f4f4;
        }
        .courses-header h1 {
            margin-bottom: 0.5rem;
        }
        .courses-header p {
            color: #666;
        }

        /* Course catalog container */
        .course-catalog {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }

        /* Filters */
        .course-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .course-filters select {
            flex: 1 1 auto;
            min-width: 180px;
            padding: 0.5rem;
        }

        /* Course grid */
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        /* Individual course card */
        .course-card {
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.3s ease;
        }
        .course-card:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .course-card img {
            width: 100%;
            height: auto;
            display: block;
        }
        .course-info {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .course-info h3 {
            margin-bottom: 0.5rem;
        }
        .course-info p {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }
        .course-meta {
            display: flex;
            gap: 1rem;
            margin-top: auto;
            font-size: 0.9rem;
        }

        /* Course footer */
        .course-footer {
            margin-top: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .price {
            font-weight: bold;
            font-size: 1rem;
        }
        .btn {
            background-color: #3490dc;
            color: #fff;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.2s ease;
        }
        .btn:hover {
            background-color: #2779bd;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .course-filters {
                justify-content: center;
            }
        }
        @media (max-width: 480px) {
            .courses-header h1 {
                font-size: 1.5rem;
            }
            .courses-header p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <section class="courses-header">
        <h1>Available Courses</h1>
        <p>Browse through our selection of quality courses</p>
    </section>

    <section class="course-catalog">
        <div class="course-filters">
            <select name="university" id="university">
                <option value="">All Universities</option>
                <option value="AUB">AUB</option>
                <option value="LAU">LAU</option>
            </select>
            <select name="subject" id="subject">
                <option value="">All Subjects</option>
                <!-- Dynamically added subjects -->
            </select>
        </div>

        <div class="course-grid">
            @foreach($courses as $course)
            <div class="course-card">
                <img src="{{ $course->thumbnail }}" alt="{{ $course->title }}">
                <div class="course-info">
                    <h3>{{ $course->title }}</h3>
                    <p>{{ $course->description }}</p>
                    <div class="course-meta">
                        <span>{{ $course->lessons_count }} lessons</span>
                        <span>{{ $course->duration }}</span>
                    </div>
                    <div class="course-footer">
                        <span class="price">${{ $course->price }}</span>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn">View Course</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    @include('layouts.footer')
</body>
</html>
