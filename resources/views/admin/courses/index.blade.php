@extends('layouts.admin')
@section('content')
<div class="content">
@can('course_create')
<div style=" 10px;" class="row">
<div class="col-lg-12">
<a class="btn btn-success" href="{{ route('admin.courses.create') }}">
{{ trans('global.add') }} {{ trans('cruds.course.title_singular') }}
</a>
<button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
{{ trans('global.app_csvImport') }}
</button>
@include('csvImport.modal', ['model' => 'Course', 'route' => 'admin.courses.parseCsvImport'])
</div>
</div>
@endcan
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
{{ trans('cruds.course.title_singular') }} {{ trans('global.list') }}
</div>
<div class="panel-body">
<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
<th>
{{ trans('cruds.course.fields.id') }}
</th>
<th>
{{ trans('cruds.course.fields.teacher') }}
</th>
<th>
{{ trans('cruds.course.fields.title') }}
</th>
<th>
{{ trans('cruds.course.fields.description') }}
</th>
<th>
{{ trans('cruds.course.fields.price') }}
</th>
<th>
{{ trans('cruds.course.fields.thumbnail') }}
</th>
<th>
{{ trans('cruds.course.fields.is_published') }}
</th>
<th>
{{ trans('cruds.course.fields.students') }}
</th>
<th>
&nbsp;
</th>
</tr>
</thead>
<tbody>
@foreach($courses as $course)
<tr>
<td>{{ $course->id }}</td>
<td>{{ $course->teacher->name ?? '' }}</td>
<td>{{ $course->title }}</td>
<td>{{ $course->description }}</td>
<td>{{ $course->price }}</td>
<td>
@if($course->thumbnail)
<a href="{{ $course->thumbnail->getUrl() }}" target="_blank">
<img src="{{ $course->thumbnail->getUrl('thumb') }}" width="50px" height="50px">
</a>
@endif
</td>
<td>{{ $course->is_published ? trans('global.yes') : trans('global.no') }}</td>
<td>
@foreach($course->students as $student)
<span class="label label-info">{{ $student->name }}</span>
@endforeach
</td>
<td>

@can('course_edit')
<a class="btn btn-xs btn-info" href="{{ route('admin.courses.edit', $course->id) }}">
{{ trans('global.edit') }}
</a>
@endcan
@can('course_delete')
<form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display: inline-block;">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('{{ trans('global.areYouSure') }}')">
{{ trans('global.delete') }}
</button>
</form>
@endcan
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>



</div>
</div>
</div>
@endsection
@section('scripts')
@parent
@endsection