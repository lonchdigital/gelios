<div class="row" wire:ignore.self>
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <form wire:submit.prevent="save">
                    <section class="mb-50">
                        <h6 class="">
                            @if (!empty($this->block->id))
                                {{ __('admin.edit_slide') }}
                            @else
                                {{ __('admin.create_slide') }}
                            @endif
                        </h6>

                        <div class="row">
                            <div class="col-12 faq-car-row pb-1 mb-4 d-flex justify-content-start" id="faq-car-id-2">
                                <div class="border border-secondary rounded p-3 col-md-11">
                                    <div class="row justify-content-between align-items-center" wire:ignore.self>
                                        @if($this->block->block !== '3d')
                                            @if ($this->activeLocale == 'ua')
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div id="uaTitle"
                                                                            class="multilang-content tab-pane fade active show">
                                                                            <div class="form-group mb-1">
                                                                                <label>{{ __('admin.title') }}
                                                                                    <strong>UA</strong>
                                                                                </label>
                                                                                <input type="text" wire:model="uaTitle"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('uaTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaTitle') }}</div>
                                                                    @elseif($errors->has('ruTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruTitle') }}</div>
                                                                    @elseif($errors->has('enTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('enTitle') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div id="uaTitle"
                                                                            class="multilang-content tab-pane fade active show">
                                                                            <div class="form-group mb-1">
                                                                                <label>{{ __('admin.button_text') }}
                                                                                    <strong>UA</strong>
                                                                                </label>
                                                                                <input type="text" wire:model="uaButton"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @error('uaButton')
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

                                            @if ($this->activeLocale == 'ru')
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div id="uaTitle"
                                                                            class="multilang-content tab-pane fade active show">
                                                                            <div class="form-group mb-1">
                                                                                <label>{{ __('admin.title') }}
                                                                                    <strong>RU</strong>
                                                                                </label>
                                                                                <input type="text" wire:model="ruTitle"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('ruTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruTitle') }}</div>
                                                                    @elseif($errors->has('uaTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaTitle') }}</div>
                                                                    @elseif($errors->has('enTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('enTitle') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div id="uaTitle"
                                                                            class="multilang-content tab-pane fade active show">
                                                                            <div class="form-group mb-1">
                                                                                <label>{{ __('admin.button_text') }}
                                                                                    <strong>RU</strong>
                                                                                </label>
                                                                                <input type="text" wire:model="ruButton"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @error('ruButton')
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

                                            @if ($this->activeLocale == 'en')
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div id="uaTitle"
                                                                            class="multilang-content tab-pane fade active show">
                                                                            <div class="form-group mb-1">
                                                                                <label>{{ __('admin.title') }}
                                                                                    <strong>EN</strong>
                                                                                </label>
                                                                                <input type="text" wire:model="enTitle"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('enTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('enTitle') }}</div>
                                                                    @elseif($errors->has('ruTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruTitle') }}</div>
                                                                    @elseif($errors->has('uaTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaTitle') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div id="uaTitle"
                                                                            class="multilang-content tab-pane fade active show">
                                                                            <div class="form-group mb-1">
                                                                                <label>{{ __('admin.button_text') }}
                                                                                    <strong>EN</strong>
                                                                                </label>
                                                                                <input type="text" wire:model="enButton"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @error('enButton')
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

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div id="uaTitle"
                                                                        class="multilang-content tab-pane fade active show">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.link') }}
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

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <x-admin.multilanguage-text-area-rich
                                                            :is-required="false"
                                                            :label="__('admin.description')"
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

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.image') }}</label>
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
                                                                            {{ __('admin.delete_image') }}
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

                                        @if(!empty($this->block->block) && $this->block->block == '3d')
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div id="uaTitle"
                                                                        class="multilang-content tab-pane fade active show">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.link') }}
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <button type="submit" class="btn btn-primary mr-2 mb-3">{{ __('admin.save') }}</button>
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
