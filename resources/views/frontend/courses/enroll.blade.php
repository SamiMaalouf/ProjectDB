<!DOCTYPE html>
<html lang="en">
@include('layouts.header')
<body>
    <section class="enrollment-form">
        <h1>Enroll in {{ $course->title }}</h1>
        
        <form action="{{ route('courses.enroll.store', $course->id) }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div class="payment-details">
                <h3>Payment Details</h3>
                <div class="price-summary">
                    <div class="price-item">
                        <span>Course Price</span>
                        <span>${{ $course->price }}</span>
                    </div>
                    <div class="price-item total">
                        <span>Total</span>
                        <span>${{ $course->price }}</span>
                    </div>
                </div>
            </div>

            <div class="form-group payment-method">
                <label>Payment Method</label>
                <div class="payment-options">
                    <label>
                        <input type="radio" name="payment_method" value="credit_card" checked>
                        Credit Card
                    </label>
                    <label>
                        <input type="radio" name="payment_method" value="paypal">
                        PayPal
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Complete Enrollment</button>
        </form>
    </section>

    @include('layouts.footer')
</body>
</html> 