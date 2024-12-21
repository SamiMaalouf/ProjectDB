@extends('layouts.admin')
@section('content')
<div class="content">
@can('lesson_create')
<div style=" 10px;" class="row">
<div class="col-lg-12">
<a class="btn btn-success" href="{{ route('admin.lessons.create') }}">
{{ trans('global.add') }} {{ trans('cruds.lesson.title_singular') }}
</a>
<button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
{{ trans('global.app_csvImport') }}
</button>
@include('csvImport.modal', ['model' => 'Lesson', 'route' => 'admin.lessons.parseCsvImport'])
</div>
</div>
@endcan
<div class="rolw">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
{{ trans('cruds.lesson.title_singular') }} {{ trans('global.list') }}
</div>
<div class="panel-body">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>{{ trans('cruds.lesson.fields.id') }}</th>
<th>{{ trans('cruds.lesson.fields.course') }}</th>
<th>{{ trans('cruds.lesson.fields.title') }}</th>
<th>{{ trans('cruds.lesson.fields.thumbnail') }}</th>
<th>{{ trans('cruds.lesson.fields.short_text') }}</th>
<th>{{ trans('cruds.lesson.fields.long_text') }}</th>
<th>{{ trans('cruds.lesson.fields.video') }}</th>
<th>{{ trans('cruds.lesson.fields.position') }}</th>
<th>{{ trans('cruds.lesson.fields.is_published') }}</th>
<th>{{ trans('cruds.lesson.fields.is_free') }}</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
@foreach($lessons as $lesson)
<tr>
<td>{{ $lesson->id }}</td>
<td>{{ $lesson->course->title ?? '' }}</td>
<td>{{ $lesson->title }}</td>
<td>@if($lesson->thumbnail)<a href="{{ $lesson->thumbnail->getUrl() }}" target="_blank"><img src="{{ $lesson->thumbnail->getUrl('thumb') }}"></a>@endif</td>
<td>{{ $lesson->short_text }}</td>
<td>{{ $lesson->long_text }}</td>
<td>@if($lesson->video)<a href="{{ $lesson->video->getUrl() }}" target="_blank">{{ trans('global.view_file') }}</a>@endif</td>
<td>{{ $lesson->position }}</td>
<td>{{ $lesson->is_published ? trans('global.yes') : trans('global.no') }}</td>
<td>{{ $lesson->is_free ? trans('global.yes') : trans('global.no') }}</td>
<td>
@can('lesson_show')
<a class="btn btn-xs btn-primary" href="{{ route('admin.lessons.show', $lesson->id) }}">
{{ trans('global.view') }}
</a>
@endcan
@can('lesson_edit')
<a class="btn btn-xs btn-info" href="{{ route('admin.lessons.edit', $lesson->id) }}">
{{ trans('global.edit') }}
</a>
@endcan
@can('lesson_delete')
<form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-xs btn-danger">{{ trans('global.delete') }}</button>
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