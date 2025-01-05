<div class="row mb-3">
    <div class="col-md-12">
        <div class="tab-content">
            @foreach(config('app.available_languages') as $availableLanguage)
                <div wire:ignore language="{{ $availableLanguage }}" class="multilang-content tab-pane fade @if($availableLanguage == config('app.active_lang'))active show @endif" id="{{ $fieldName }}-{{ $availableLanguage }}">
                    <div class="form-group mb-1">
                        <label for="{{ $fieldName }}_{{ $availableLanguage }}">{{ $label }} <strong>{{ mb_strtoupper($availableLanguage) }}</strong>@if($isRequired) <strong class="text-danger">*</strong>@endif</label>
                        <textarea @if($liveWireField) wire:model="{{$liveWireField}}.{{$availableLanguage}}" @endif name="{{ $fieldName }}[{{$availableLanguage}}]" id="{{ $fieldName }}_{{ $availableLanguage }}" class="form-control">                            
                            @if(isset($valuesField[$availableLanguage])) {{ $valuesField[$availableLanguage] }} @endif
                        </textarea>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-1 text-danger ajaxError" id="error-field-{{$liveWireField . '.*'}}"></div>
        @error($liveWireField . '.*')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>