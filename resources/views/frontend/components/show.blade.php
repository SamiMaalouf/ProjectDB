@props(['title', 'fields', 'model'])

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $title }}</h5>
        <div>
            @if(isset($fields['can_edit']) && $fields['can_edit'])
                <a href="{{ route('frontend.'.str_replace(' ', '-', strtolower($title)).'.edit', $model->id) }}" 
                   class="btn btn-info">
                    Edit
                </a>
            @endif
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tbody>
                @foreach($fields as $name => $field)
                    @if($name !== 'can_edit')
                        <tr>
                            <th style="width: 200px;">{{ $field['label'] }}</th>
                            <td>
                                @if(isset($field['type']) && $field['type'] === 'file' && $model->$name)
                                    <a href="{{ asset('storage/' . $model->$name) }}" target="_blank">
                                        View File
                                    </a>
                                @elseif(isset($field['type']) && $field['type'] === 'image' && $model->$name)
                                    <img src="{{ asset('storage/' . $model->$name) }}" 
                                         alt="{{ $field['label'] }}" 
                                         class="img-fluid" 
                                         style="max-width: 300px;">
                                @elseif(is_array($model->$name))
                                    {{ implode(', ', $model->$name) }}
                                @else
                                    {{ $model->$name }}
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div> 