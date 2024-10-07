<div class="row mb-3">
    <div class="col-md-12">
        <div class="tab-content">
            @foreach(config('app.available_languages') as $availableLanguage)


            <input type="hidden" name="{{ $fieldName }}[{{$availableLanguage}}]" value="">
            <div wire:ignore language="{{ $availableLanguage }}" data-field-name="{{$liveWireField}}" class="multilang-content tab-pane fade @if($availableLanguage == app()->getLocale())active show @endif">
                <label for="{{ $fieldName }}_{{ $availableLanguage }}">{{ $label }} <strong>{{ mb_strtoupper($availableLanguage) }}</strong>@if($isRequired) <strong class="text-danger">*</strong>@endif</label>
                <div class="editor rich-editor" id="editor-{{ $availableLanguage }}" style="min-height:100px;">
                    @if(isset($valuesField[$availableLanguage])) {!! $valuesField[$availableLanguage] !!} @endif
                </div>
            </div>

            
                {{-- TODO:: REmove it --}}
                {{-- <div language="{{ $availableLanguage }}" class="multilang-content tab-pane fade @if($availableLanguage == app()->getLocale())active show @endif" id="{{ $fieldName }}-{{ $availableLanguage }}">
                    <div class="form-group mb-1">
                        <label for="{{ $fieldName }}_{{ $availableLanguage }}">{{ $label }} <strong>{{ mb_strtoupper($availableLanguage) }}</strong>@if($isRequired) <strong class="text-danger">*</strong>@endif</label>
                        <textarea @if($liveWireField) wire:model="{{$liveWireField}}.{{$availableLanguage}}" @endif name="{{ $fieldName }}[{{$availableLanguage}}]" id="{{ $fieldName }}_{{ $availableLanguage }}" class="form-control rich-editor">                            
                            @if(isset($valuesField[$availableLanguage])) {{ $valuesField[$availableLanguage] }} @endif
                        </textarea>
                    </div>
                </div> --}}

            @endforeach
        </div>
        <div class="mt-1 text-danger ajaxError" id="error-field-{{$errorFieldName . '.*'}}"></div>
        @error($errorFieldName . '.*')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>