<!DOCTYPE html>
<html lang="en" class="h-100">
    @include('layouts.header')
    <body class="d-flex flex-column h-100">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Page Content -->
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white py-3">
                            <div class="d-flex align-items-center">
                                <h1 class="h3 mb-0">{{ $course->title }}</h1>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="course-description mb-4">
                                        {!! $course->description !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <div class="course-details mb-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="fas fa-user-tie me-2"></i>
                                                    <strong>Teacher:</strong>
                                                    <span class="ms-2">{{ $course->teacher->name }}</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-tag me-2"></i>
                                                    <strong>Price:</strong>
                                                    <span class="ms-2">{{ $course->price }}</span>
                                                </div>
                                            </div>
                                            
                                            @if(!auth()->user()->enrolledCourses->contains($course))
                                                <form action="{{ route('courses.enroll.store', $course) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary w-100">
                                                        Enroll Now
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(auth()->user()->enrolledCourses->contains($course))
                                <div class="mt-4">
                                    <div class="alert alert-info border-0 bg-light">
                                        <h5 class="mb-3">Course Progress</h5>
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar bg-success" role="progressbar" 
                                                 style="width: {{ auth()->user()->calculateCourseProgress($course) }}%">
                                            </div>
                                        </div>
                                        <p class="mt-2 mb-0 text-center">
                                            {{ auth()->user()->calculateCourseProgress($course) }}% Complete
                                        </p>
                                    </div>

                                    <div class="mt-4">
                                        <h3 class="h4 mb-3">Course Lessons</h3>
                                        <div class="list-group">
                                            @foreach($course->lessons as $lesson)
                                                <a href="{{ route('lessons.show', $lesson) }}" 
                                                   class="list-group-item list-group-item-action d-flex align-items-center">
                                                    <i class="fas fa-book-reader me-3"></i>
                                                    {{ $lesson->title }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')

    </body>
</html>
