@extends('layouts.admin')
@section('content')
<div class="content">
    @can('faq_category_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.faq-categories.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.faqCategory.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'FaqCategory', 'route' => 'admin.faq-categories.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.faqCategory.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>
                                    {{ trans('cruds.faqCategory.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.faqCategory.fields.category') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faqCategories as $faqCategory)
                                <tr>
                                    <td>
                                        {{ $faqCategory->id }}
                                    </td>
                                    <td>
                                        {{ $faqCategory->category }}
                                    </td>
                                    <td>

                                        @can('faq_category_edit')
                                            <a class="btn btn-xs btn-info" href="{{ route('admin.faq-categories.edit', $faqCategory->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan
                                        @can('faq_category_delete')
                                            <form action="{{ route('admin.faq-categories.destroy', $faqCategory->id) }}" method="POST" style="display: inline-block;">
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