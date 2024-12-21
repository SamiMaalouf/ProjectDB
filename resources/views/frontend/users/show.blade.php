@extends('frontend.layouts.app')

@section('content')
    <x-frontend.show
        title="User Details"
        :model="$user"
        :fields="[
            'name' => [
                'label' => 'Name'
            ],
            'email' => [
                'label' => 'Email'
            ],
            'roles' => [
                'label' => 'Roles',
                'type' => 'array'
            ],
            'email_verified_at' => [
                'label' => 'Email Verified At'
            ],
            'can_edit' => auth()->user() && auth()->user()->can('user_edit')
        ]"
    />

    @if($user->courses->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Enrolled Courses</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($user->courses as $course)
                        <a href="{{ route('frontend.courses.show', $course->id) }}" 
                           class="list-group-item list-group-item-action">
                            {{ $course->title }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if($user->test_results->count() > 0)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Test Results</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Test</th>
                                <th>Score</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->test_results as $result)
                                <tr>
                                    <td>
                                        <a href="{{ route('frontend.tests.show', $result->test_id) }}">
                                            {{ $result->test->title }}
                                        </a>
                                    </td>
                                    <td>{{ $result->score }}%</td>
                                    <td>{{ $result->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection 