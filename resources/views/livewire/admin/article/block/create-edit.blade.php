<div class="row" wire:ignore.self>
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <form wire:submit.prevent="save">
                    <section class="mb-50">
                        <h6 class="">
                            {{-- @if (!empty($this->article->id))
                                Редагування статті
                            @else
                                Створення статті
                            @endif --}}
                        </h6>

                        <div class="row">
                            <div class="col-12 faq-car-row pb-1 mb-4 d-flex justify-content-start" id="faq-car-id-2">
                                <div class="border border-secondary rounded p-3 col-md-11">
                                    <div class="row justify-content-between align-items-center">

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="tab-content">
                                                                <div id="uaTitle"
                                                                    class="multilang-content tab-pane fade active show">
                                                                    <div class="form-group mb-1">
                                                                        <label>{{ __('admin.block_type') }}
                                                                        </label>
                                                                        <select class="form-control rounded-0"
                                                                            wire:model.live="type">
                                                                            @forelse($this->types as $type2)
                                                                                <option value="{{ $type2 }}">{{ __('admin.article.blocks_type.'.$type2) }}</option>
                                                                            @empty
                                                                            @endforelse
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('type')
                                                                <div class="mt-1 text-danger ajaxError">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
                                                                            <input type="text"
                                                                                wire:model="uaFirstTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('uaFirstTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaFirstTitle') }}</div>
                                                                @elseif($errors->has('ruFirstTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruFirstTitle') }}</div>
                                                                @elseif($errors->has('enFirstTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enFirstTitle') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.description') }}
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <textarea wire:model="uaFirstDescription" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('uaFirstDescription'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaFirstDescription') }}</div>
                                                                @elseif($errors->has('ruFirstDescription'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruFirstDescription') }}</div>
                                                                @elseif($errors->has('enFirstDescription'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enFirstDescription') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            @if ($this->type == 'two_blocks')
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div id="uaTitle"
                                                                            class="multilang-content tab-pane fade active show">
                                                                            <div class="form-group mb-1">
                                                                                <label>{{ __('admin.second_block_title') }}
                                                                                    <strong>UA</strong>
                                                                                </label>
                                                                                <input type="text"
                                                                                    wire:model="uaSecondTitle"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('uaSecondTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSecondTitle') }}</div>
                                                                    @elseif($errors->has('ruSecondTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSecondTitle') }}</div>
                                                                    @elseif($errors->has('enSecondTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSecondTitle') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div
                                                                            class="multilang-content tab-pane fade active show ">
                                                                            <div class="form-group mb-1">
                                                                                <label>{{ __('admin.second_block_description') }}
                                                                                    <strong>UA</strong>
                                                                                </label>
                                                                                <textarea wire:model="uaSecondDescription" class="form-control"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('uaSecondDescription'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSecondDescription') }}</div>
                                                                    @elseif($errors->has('ruSecondDescription'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSecondDescription') }}</div>
                                                                    @elseif($errors->has('enSecondDescription'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSecondDescription') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            @endif
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
                                                                            <input type="text"
                                                                                wire:model="ruFirstTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('ruFirstTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruFirstTitle') }}</div>
                                                                @elseif($errors->has('uaFirstTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaFirstTitle') }}</div>
                                                                @elseif($errors->has('enFirstTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enFirstTitle') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.description') }}
                                                                                <strong>RU</strong>
                                                                            </label>
                                                                            <textarea wire:model="ruFirstDescription" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('ruFirstDescription'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruFirstDescription') }}</div>
                                                                @elseif($errors->has('uaFirstDescription'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaFirstDescription') }}</div>
                                                                @elseif($errors->has('enFirstDescription'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enFirstDescription') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            @if ($this->type == 'two_blocks')
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div
                                                                            class="multilang-content tab-pane fade active show">
                                                                            <div class="form-group mb-1">
                                                                                <label>{{ __('admin.second_block_title') }}
                                                                                    <strong>RU</strong>
                                                                                </label>
                                                                                <input type="text"
                                                                                    wire:model="ruSecondTitle"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('ruSecondTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSecondTitle') }}</div>
                                                                    @elseif($errors->has('uaSecondTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSecondTitle') }}</div>
                                                                    @elseif($errors->has('enSecondTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSecondTitle') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div
                                                                            class="multilang-content tab-pane fade active show ">
                                                                            <div class="form-group mb-1">
                                                                                <label>{{ __('admin.second_block_description') }}
                                                                                    <strong>RU</strong>
                                                                                </label>
                                                                                <textarea wire:model="ruSecondDescription" class="form-control"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('ruSecondDescription'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSecondDescription') }}</div>
                                                                    @elseif($errors->has('uaSecondDescription'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSecondDescription') }}</div>
                                                                    @elseif($errors->has('enSecondDescription'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSecondDescription') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            @endif
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
                                                                            <input type="text"
                                                                                wire:model="enFirstTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('enFirstTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enFirstTitle') }}</div>
                                                                @elseif($errors->has('ruFirstTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruFirstTitle') }}</div>
                                                                @elseif($errors->has('uaFirstTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaFirstTitle') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.description') }}
                                                                                <strong>EN</strong>
                                                                            </label>
                                                                            <textarea wire:model="enFirstDescription" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('enFirstDescription'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enFirstDescription') }}</div>
                                                                @elseif($errors->has('ruFirstDescription'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruFirstDescription') }}</div>
                                                                @elseif($errors->has('uaFirstDescription'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaFirstDescription') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            @if ($this->type == 'two_blocks')
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div
                                                                            class="multilang-content tab-pane fade active show">
                                                                            <div class="form-group mb-1">
                                                                                <label>{{ __('admin.second_block_title') }}
                                                                                    <strong>EN</strong>
                                                                                </label>
                                                                                <input type="text"
                                                                                    wire:model="enSecondTitle"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('enSecondTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSecondTitle') }}</div>
                                                                    @elseif($errors->has('ruSecondTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSecondTitle') }}</div>
                                                                    @elseif($errors->has('uaSecondTitle'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSecondTitle') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div
                                                                            class="multilang-content tab-pane fade active show ">
                                                                            <div class="form-group mb-1">
                                                                                <label>{{ __('admin.second_block_description') }}
                                                                                    <strong>EN</strong>
                                                                                </label>
                                                                                <textarea wire:model="enSecondDescription" class="form-control"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('enSecondDescription'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSecondDescription') }}</div>
                                                                    @elseif($errors->has('ruSecondDescription'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSecondDescription') }}</div>
                                                                    @elseif($errors->has('uaSecondDescription'))
                                                                        <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSecondDescription') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            @endif
                                        @endif

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <x-admin.multilanguage-text-area-rich
                                                        :is-required="false"
                                                        :label="__('admin.description')"
                                                        field-name="description"
                                                        live-wire-field="description"
                                                        :values="[
                                                            'ua' => $this->uaFirstDescription,
                                                            'ru' => $this->ruFirstDescription,
                                                            'en' => $this->enFirstDescription
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

                                        {{-- @if ($this->type == 'two_blocks') --}}
                                            <div class="col-md-12" @if ($this->type == 'two_blocks') style="display: block;" @else style="display: none;" @endif>
                                                <div class="row" wire:ignore>
                                                    <div class="col-md-12">
                                                        <x-admin.multilanguage-text-area-rich
                                                            :is-required="false"
                                                            :label="__('admin.second_block_description')"
                                                            field-name="description2"
                                                            live-wire-field="description2"
                                                            :values="[
                                                                'ua' => $this->uaSecondDescription,
                                                                'ru' => $this->ruSecondDescription,
                                                                'en' => $this->enSecondDescription
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
                                        {{-- @endif --}}
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
