<!DOCTYPE html>
<html lang="en">
@include('layouts.header')
<body>

<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h1 class="mb-4">Contact Us</h1>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('frontend.contact.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required></textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>

                    <div class="mt-5">
                        <h3>Other Ways to Reach Us</h3>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5>Email</h5>
                                <p>support@educationalcenter.com</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Phone</h5>
                                <p>+961 1 123-4567</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
</body>
</html>