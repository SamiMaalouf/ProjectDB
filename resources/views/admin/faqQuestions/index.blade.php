@extends('layouts.admin')
@section('content')
<div class="content">
    @can('faq_question_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.faq-questions.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.faqQuestion.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'FaqQuestion', 'route' => 'admin.faq-questions.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.faqQuestion.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ trans('cruds.faqQuestion.fields.id') }}</th>
                                <th>{{ trans('cruds.faqQuestion.fields.category') }}</th>
                                <th>{{ trans('cruds.faqQuestion.fields.question') }}</th>
                                <th>{{ trans('cruds.faqQuestion.fields.answer') }}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faqQuestions as $faqQuestion)
                                <tr>
                                    <td>{{ $faqQuestion->id }}</td>
                                    <td>{{ $faqQuestion->category->category ?? '' }}</td>
                                    <td>{{ $faqQuestion->question }}</td>
                                    <td>{{ $faqQuestion->answer }}</td>
                                    <td>

                                        @can('faq_question_edit')
                                            <a class="btn btn-xs btn-info" href="{{ route('admin.faq-questions.edit', $faqQuestion->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan
                                        @can('faq_question_delete')
                                            <form action="{{ route('admin.faq-questions.destroy', $faqQuestion->id) }}" method="POST" style="display: inline-block;">
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