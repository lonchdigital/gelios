<div class="row" wire:ignore.self>
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <form wire:submit.prevent="save">
                    <section class="mb-50">
                        <h6 class="card-title">
                            Редагування блоку
                        </h6>

                        <div class="row">
                            <div class="col-12 faq-car-row pb-1 mb-4 d-flex justify-content-start" id="faq-car-id-2">
                                <div class="border border-secondary rounded p-3 col-md-11">
                                    {{-- <div class="row justify-content-between align-items-center" wire:ignore.self> --}}

                                    @if ($this->isShowTitle())
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="tab-content">
                                                                <div id="uaTitle"
                                                                    class="multilang-content tab-pane fade active show">
                                                                    <div class="form-group mb-1">
                                                                        <label>Заголовок
                                                                            <strong>{{ strtoupper($this->activeLocale) }}</strong>
                                                                        </label>
                                                                        <input type="text" wire:model="{{ $this->activeLocale }}Title"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error($this->activeLocale . 'Title')
                                                                <div class="mt-1 text-danger ajaxError">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($this->isShowDescription())
                                        {{-- <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="tab-content">
                                                                <div
                                                                    class="multilang-content tab-pane fade active show ">
                                                                    <div class="form-group mb-1">
                                                                        <label>Опис
                                                                            <strong>{{ strtoupper($this->activeLocale) }}</strong>
                                                                        </label>
                                                                        <textarea wire:model="{{ $this->activeLocale }}Description" class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error($this->activeLocale . 'Description')
                                                                <div class="mt-1 text-danger ajaxError">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <x-admin.multilanguage-text-area-rich
                                                        :is-required="false"
                                                        :label="'Опис'"
                                                        field-name="description"
                                                        live-wire-field="description"
                                                        :values="[
                                                            'ua' => $this->uaDescription,
                                                            'ru' => $this->ruDescription,
                                                            'en' => $this->enDescription
                                                        ]"
                                                    />
                                                    @if($errors->has('uaDescription'))
                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaDescription') }}</div>
                                                    @elseif($errors->has('ruDescription'))
                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruDescription') }}</div>
                                                    @elseif($errors->has('enDescription'))
                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('enDescription') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($this->isShowContent())
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="tab-content">
                                                                <div
                                                                    class="multilang-content tab-pane fade active show ">
                                                                    <div class="form-group mb-1">
                                                                        <label>Контент
                                                                            <strong>{{ strtoupper($this->activeLocale) }}</strong>
                                                                        </label>
                                                                        <textarea wire:model="{{ $this->activeLocale }}Content" class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error($this->activeLocale . 'Content')
                                                                <div class="mt-1 text-danger ajaxError">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($this->isShowButtonName())
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="tab-content">
                                                                <div id="uaTitle"
                                                                    class="multilang-content tab-pane fade active show">
                                                                    <div class="form-group mb-1">
                                                                        <label>Текст кнопки
                                                                            <strong>{{ strtoupper($this->activeLocale) }}</strong>
                                                                        </label>
                                                                        <input type="text" wire:model="{{ $this->activeLocale }}ButtonName"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error($this->activeLocale . 'ButtonName')
                                                                <div class="mt-1 text-danger ajaxError">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($this->isShowLink())
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="tab-content">
                                                                <div id="uaTitle"
                                                                    class="multilang-content tab-pane fade active show">
                                                                    <div class="form-group mb-1">
                                                                        <label>Посилання
                                                                        </label>
                                                                        <input type="text" wire:model="link"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('link')
                                                                <div class="mt-1 text-danger ajaxError">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($this->isShowImage())
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="tab-content">
                                                                <div
                                                                    class="multilang-content tab-pane fade active show ">
                                                                    <div class="form-group mb-1">
                                                                        <label>Зображення</label>
                                                                        <input type="file" wire:model="image"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('image')
                                                                <div class="mt-1 text-danger ajaxError">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror

                                                            @if ($this->imageTemporary)
                                                                <div class="flex">
                                                                    <img src="{{ $this->imageTemporary }}"
                                                                        width="60">
                                                                    <a wire:click="deleteImage()"
                                                                        style="cursor: pointer;">
                                                                        <i class="ti-close font-weight-bold mr-2"></i>
                                                                        Видалити зображення
                                                                    </a>
                                                                </div>
                                                            @elseif(!empty($this->block->image))
                                                                <img src="{{ $this->block->imageUrl }}"
                                                                    width="60">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>

                    <button type="submit" class="btn btn-primary mr-2 mb-3">Зберегти</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('admin_src/js/default-assets/quill-init.js') }}"></script>
    <script type="text/javascript">
        document.addEventListener('livewire:load', () => {
            initQuillEditors((quill, fieldName, language) => {
                quill.on('text-change', function() {
                    let value = quill.root.innerHTML;
                    @this.set(`${fieldName}`, value);
                });
            });
        });
    </script>
@endpush
