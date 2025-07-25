<div class="row" wire:ignore.self>
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <form wire:submit.prevent="save">
                    <section class="mb-50">
                        <h6 class="">
                            {{ __('admin.edit') }} SEO {{ $page->title ?? '' }}
                        </h6>

                        <div class="row">
                            <div class="col-12 faq-car-row pb-1 mb-4 d-flex justify-content-start" id="faq-car-id-2">
                                <div class="border border-secondary rounded p-3 col-md-11">
                                    {{-- <div class="row justify-content-between align-items-center" wire:ignore.self> --}}

                                        @if($this->activeLocale == 'ua')
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div id="uaTitle"
                                                                        class="multilang-content tab-pane fade active show">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.page_title') }}
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
                                        @endif

                                        @if($this->activeLocale == 'ru')
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div id="uaTitle"
                                                                        class="multilang-content tab-pane fade active show">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.page_title') }}
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
                                        @endif

                                        @if($this->activeLocale == 'en')
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div id="uaTitle"
                                                                        class="multilang-content tab-pane fade active show">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.page_title') }}
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
                                        @endif

                                        @if($this->activeLocale == 'ua')
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div id="uaTitle"
                                                                        class="multilang-content tab-pane fade active show">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.meta_page_title') }}
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="uaMetaTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-1 text-danger ajaxError">{{ 'Введіть %title% для підстановки' }}</div>
                                                                @if($errors->has('uaMetaTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaMetaTitle') }}</div>
                                                                @elseif($errors->has('ruMetaTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruMetaTitle') }}</div>
                                                                @elseif($errors->has('enMetaTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enMetaTitle') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($this->activeLocale == 'ru')
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div id="uaTitle"
                                                                        class="multilang-content tab-pane fade active show">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.meta_page_title') }}
                                                                                <strong>RU</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="ruMetaTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-1 text-danger ajaxError">{{ 'Введіть %title% для підстановки' }}</div>
                                                                @if($errors->has('ruMetaTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruMetaTitle') }}</div>
                                                                @elseif($errors->has('uaMetaTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaMetaTitle') }}</div>
                                                                @elseif($errors->has('enMetaTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enMetaTitle') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($this->activeLocale == 'en')
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div id="uaTitle"
                                                                        class="multilang-content tab-pane fade active show">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.meta_page_title') }}
                                                                                <strong>EN</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="enMetaTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-1 text-danger ajaxError">{{ 'Введіть %title% для підстановки' }}</div>
                                                                @if($errors->has('enMetaTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enMetaTitle') }}</div>
                                                                @elseif($errors->has('ruMetaTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruMetaTitle') }}</div>
                                                                @elseif($errors->has('uaMetaTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaMetaTitle') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <x-admin.multilanguage-text-area-rich
                                                        :is-required="false"
                                                        :label="__('admin.meta_description')"
                                                        field-name="seoDescription"
                                                        live-wire-field="seoDescription"
                                                        :values="[
                                                            'ua' => $this->uaSeoDescription,
                                                            'ru' => $this->ruSeoDescription,
                                                            'en' => $this->enSeoDescription
                                                        ]"
                                                    />
                                                    <div class="mt-1 text-danger ajaxError">{{ 'Введіть %title% для підстановки' }}</div>
                                                    @if($errors->has('uaSeoDescription'))
                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSeoDescription') }}</div>
                                                    @elseif($errors->has('ruSeoDescription'))
                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSeoDescription') }}</div>
                                                    @elseif($errors->has('enSeoDescription'))
                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSeoDescription') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        @if($this->activeLocale == 'ua')
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div id="uaTitle"
                                                                        class="multilang-content tab-pane fade active show">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.seo_page_title') }}
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="uaSeoTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('uaSeoTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSeoTitle') }}</div>
                                                                @elseif($errors->has('ruSeoTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSeoTitle') }}</div>
                                                                @elseif($errors->has('enSeoTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSeoTitle') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($this->activeLocale == 'ru')
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div id="uaTitle"
                                                                        class="multilang-content tab-pane fade active show">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.seo_page_title') }}
                                                                                <strong>RU</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="ruSeoTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('ruSeoTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSeoTitle') }}</div>
                                                                @elseif($errors->has('uaSeoTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSeoTitle') }}</div>
                                                                @elseif($errors->has('enSeoTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSeoTitle') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($this->activeLocale == 'en')
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div id="uaTitle"
                                                                        class="multilang-content tab-pane fade active show">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.seo_page_title') }}
                                                                                <strong>EN</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="enSeoTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('enSeoTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSeoTitle') }}</div>
                                                                @elseif($errors->has('ruSeoTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSeoTitle') }}</div>
                                                                @elseif($errors->has('uaSeoTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSeoTitle') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <x-admin.multilanguage-text-area-rich
                                                        :is-required="false"
                                                        :label="__('admin.seo_block')"
                                                        field-name="seoContent"
                                                        live-wire-field="seoContent"
                                                        :values="[
                                                            'ua' => $this->uaSeoContent,
                                                            'ru' => $this->ruSeoContent,
                                                            'en' => $this->enSeoContent
                                                        ]"
                                                    />
                                                    @if($errors->has('uaSeoContent'))
                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSeoContent') }}</div>
                                                    @elseif($errors->has('ruSeoContent'))
                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSeoContent') }}</div>
                                                    @elseif($errors->has('enSeoContent'))
                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSeoContent') }}</div>
                                                    @endif
                                                </div>
                                            </div>
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
