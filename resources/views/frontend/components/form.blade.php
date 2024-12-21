@props(['action', 'method' => 'POST', 'title', 'fields', 'model' => null])

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ $title }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(strtoupper($method) !== 'POST')
                @method($method)
            @endif

            @foreach($fields as $name => $field)
                <div class="mb-3">
                    <label for="{{ $name }}" class="form-label">{{ $field['label'] }}</label>
                    
                    @if($field['type'] === 'text' || $field['type'] === 'email' || $field['type'] === 'password' || $field['type'] === 'number')
                        <input type="{{ $field['type'] }}" 
                               name="{{ $name }}" 
                               id="{{ $name }}" 
                               class="form-control @error($name) is-invalid @enderror"
                               value="{{ old($name, $model ? $model->$name : '') }}"
                               {{ isset($field['required']) && $field['required'] ? 'required' : '' }}>
                    
                    @elseif($field['type'] === 'textarea')
                        <textarea name="{{ $name }}" 
                                  id="{{ $name }}" 
                                  class="form-control @error($name) is-invalid @enderror"
                                  rows="3"
                                  {{ isset($field['required']) && $field['required'] ? 'required' : '' }}>{{ old($name, $model ? $model->$name : '') }}</textarea>
                    
                    @elseif($field['type'] === 'select')
                        <select name="{{ $name }}" 
                                id="{{ $name }}" 
                                class="form-select @error($name) is-invalid @enderror"
                                {{ isset($field['required']) && $field['required'] ? 'required' : '' }}>
                            @foreach($field['options'] as $value => $label)
                                <option value="{{ $value }}" 
                                        {{ old($name, $model ? $model->$name : '') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    
                    @elseif($field['type'] === 'file')
                        <input type="file" 
                               name="{{ $name }}" 
                               id="{{ $name }}" 
                               class="form-control @error($name) is-invalid @enderror"
                               {{ isset($field['required']) && $field['required'] ? 'required' : '' }}>
                        @if($model && $model->$name)
                            <div class="mt-2">
                                Current file: {{ $model->$name }}
                            </div>
                        @endif
                    
                    @elseif($field['type'] === 'checkbox')
                        <div class="form-check">
                            <input type="checkbox" 
                                   name="{{ $name }}" 
                                   id="{{ $name }}" 
                                   class="form-check-input @error($name) is-invalid @enderror"
                                   value="1"
                                   {{ old($name, $model ? $model->$name : '') ? 'checked' : '' }}
                                   {{ isset($field['required']) && $field['required'] ? 'required' : '' }}>
                            <label class="form-check-label" for="{{ $name }}">
                                {{ $field['label'] }}
                            </label>
                        </div>
                    @endif

                    @error($name)
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    @if(isset($field['help']))
                        <div class="form-text">
                            {{ $field['help'] }}
                        </div>
                    @endif
                </div>
            @endforeach

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
</div> 