<!DOCTYPE html>
<html lang="en">
@include('layouts.header')
<body class="d-flex flex-column min-vh-100">

<div class="container my-4 flex-grow-1">
    <!-- Main row wrapper -->
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Profile Update Form -->
            <div class="card mb-4">
                <div class="card-header">
                    {{ trans('global.my_profile') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('frontend.profile.update') }}">
                        @csrf
                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                {{ trans('cruds.user.fields.name') }}
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                value="{{ old('name', auth()->user()->name) }}" 
                                required
                            >
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                {{ trans('cruds.user.fields.email') }}
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                value="{{ old('email', auth()->user()->email) }}" 
                                required
                            >
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-danger">
                            {{ trans('global.save') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Enrolled Courses Section -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Enrolled Courses</h5>
                </div>
                <div class="card-body">
                    @if($enrolledCourses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cruds.course.fields.title') }}</th>
                                        <th>Instructor</th>
                                        <th>Enrolled Date</th>
                                        <th>{{ trans('global.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enrolledCourses as $course)
                                        <tr>
                                            <td>{{ $course->title }}</td>
                                            <td>{{ $course->instructor->name }}</td>
                                            <td>{{ $course->pivot->created_at ? $course->pivot->created_at->format('M d, Y') : 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('frontend.courses.show', $course->id) }}" 
                                                   class="btn btn-sm btn-primary">
                                                    {{ trans('global.view') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted mb-0">{{ trans('global.no_enrolled_courses') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Password Change Form -->
            <div class="card mb-4">
                <div class="card-header">
                    {{ trans('global.change_password') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('frontend.profile.password') }}">
                        @csrf
                        <!-- New Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                New {{ trans('cruds.user.fields.password') }}
                            </label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                required
                            >
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">
                                Repeat New {{ trans('cruds.user.fields.password') }}
                            </label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation" 
                                class="form-control" 
                                required
                            >
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-danger">
                            {{ trans('global.save') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    {{ trans('global.delete_account') }}
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">{{ trans('global.delete_account_warning') }}</p>
                    <form 
                        method="POST" 
                        action="{{ route('frontend.profile.destroy') }}" 
                        onsubmit="return confirm('{{ __('global.delete_account_warning') }}')"
                    >
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100">
                            {{ trans('global.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
</body>
</html>
