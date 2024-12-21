<!DOCTYPE html>
<html lang="en">
@include('layouts.header')
<body>


    <section class="hero">
        <h1>Time to Up Your Grades<br>With Our Online Tutoring Platform</h1>
        <a href="#" class="btn">GET STARTED</a>
    </section>



    <section class="courses">
        <h2>COURSES WE OFFER</h2>
        <div class="course-grid">
            <div class="course-item">AUB</div>
            <div class="course-item">LAU</div>
        </div>
    </section>

    <section class="why-EducationCenter">
        <h2>Why EducationCenter?</h2>
        <div class="features">
            <div class="feature">
                <img src="/placeholder.svg?height=80&width=80" alt="Expert Tutors Icon">
                <h3>Expert Tutors</h3>
                <p>Learn from highly qualified and experienced tutors who are passionate about helping you succeed.</p>
            </div>
            <div class="feature">
                <img src="/placeholder.svg?height=80&width=80" alt="Flexible Schedule Icon">
                <h3>Flexible Schedule</h3>
                <p>Choose from a wide range of time slots that fit your busy schedule and learn at your own pace.</p>
            </div>
            <div class="feature">
                <img src="/placeholder.svg?height=80&width=80" alt="Interactive Learning Icon">
                <h3>Interactive Learning</h3>
                <p>Engage in dynamic, interactive sessions that make learning enjoyable and effective.</p>
            </div>
        </div>
    </section>



    @include('components.testimonials')
    @include('components.achievements')
    @include('layouts.footer')
</body>
</html>
