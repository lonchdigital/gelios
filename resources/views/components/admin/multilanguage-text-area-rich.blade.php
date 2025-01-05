<div class="row mb-3">
    <div class="col-md-12">
        <div class="tab-content">
            @foreach(config('app.available_languages') as $availableLanguage)
                <input type="hidden" name="{{ $fieldName }}[{{$availableLanguage}}]" value="">
                <div wire:ignore language="{{ $availableLanguage }}" data-field-name="{{$liveWireField}}" class="multilang-content tab-pane fade @if($availableLanguage == config('app.active_lang'))active show @endif test-{{ $availableLanguage }}">
                    <label for="{{ $fieldName }}_{{ $availableLanguage }}">{{ $label }} <strong>{{ mb_strtoupper($availableLanguage) }}</strong>@if($isRequired) <strong class="text-danger">*</strong>@endif</label>
                    <div class="editor rich-editor" id="editor-{{ $availableLanguage }}" style="min-height:100px;">
                        @if(isset($valuesField[$availableLanguage])) {!! $valuesField[$availableLanguage] !!} @endif
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
