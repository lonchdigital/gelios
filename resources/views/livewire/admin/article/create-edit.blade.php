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
                                    <div class="row justify-content-between align-items-center" wire:ignore.self>

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
                                                                <div id="uaTitle"
                                                                    class="multilang-content tab-pane fade active show">
                                                                    <div class="form-group mb-1">
                                                                        <label>{{ __('admin.slug') }}
                                                                        </label>
                                                                        <input type="text" wire:model="slug"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('slug')
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
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="tab-content">
                                                                <div id="uaTitle"
                                                                    class="multilang-content tab-pane fade active show">
                                                                    <div class="form-group mb-1">
                                                                        <label>{{ __('admin.category') }}
                                                                        </label>
                                                                        <select class="form-control rounded-0"
                                                                            wire:model.live="categoryId">
                                                                            <option value="">{{ __('admin.choose_category') }}
                                                                            </option>
                                                                            @forelse($this->categories as $category2)
                                                                                <option value="{{ $category2->id }}">
                                                                                    {{ $category2->title }}</option>
                                                                            @empty
                                                                            @endforelse
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('categoryId')
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
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="tab-content">
                                                                <div id="uaTitle"
                                                                    class="multilang-content tab-pane fade active show">
                                                                    <div class="form-group mb-1">
                                                                        <label>{{ __('admin.doctor') }}
                                                                        </label>
                                                                        <select class="form-control rounded-0"
                                                                            wire:model.live="doctorId">
                                                                            <option value="">{{ __('admin.choose_doctor') }}
                                                                            </option>
                                                                            @forelse($this->doctors as $doctor)
                                                                                <option value="{{ $doctor->id }}">
                                                                                    {{ $doctor->title }}</option>
                                                                            @empty
                                                                            @endforelse
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('doctorId')
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
                                                            @elseif(!empty($this->article->image))
                                                                <img src="{{ $this->article->imageUrl }}"
                                                                    width="60">
                                                            @endif
                                                        </div>
                                                    </div>
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
                                                                            <label>{{ __('admin.meta_title') }}
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="uaSeoTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="mt-1 text-danger ajaxError">{{ 'Введіть %title% для підстановки' }}</div> --}}
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
                                                                            <label>{{ __('admin.meta_title') }}
                                                                                <strong>RU</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="ruSeoTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="mt-1 text-danger ajaxError">{{ 'Введіть %title% для підстановки' }}</div> --}}
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
                                                                            <label>{{ __('admin.meta_title') }}
                                                                                <strong>EN</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="enSeoTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="mt-1 text-danger ajaxError">{{ 'Введіть %title% для підстановки' }}</div> --}}
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
                                                        :label="__('admin.meta_description')"
                                                        field-name="seoDescription"
                                                        live-wire-field="seoDescription"
                                                        :values="[
                                                            'ua' => $this->uaSeoDescription,
                                                            'ru' => $this->ruSeoDescription,
                                                            'en' => $this->enSeoDescription
                                                        ]"
                                                    />
                                                    {{-- <div class="mt-1 text-danger ajaxError">{{ 'Введіть %title% для підстановки' }}</div> --}}
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

                                        {{-- <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="tab-content">
                                                                <div
                                                                    class="multilang-content tab-pane fade active show ">
                                                                    <div class="form-group mb-1">
                                                                        <label>{{ __('admin.slider_image') }}</label>
                                                                        <input type="file" wire:model="newImage"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('newImage')
                                                                <div class="mt-1 text-danger ajaxError">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="card-body pb-0 mb-5">
                                            <h5 class="card-title">{{ __('admin.image') }}</h5>
                                            <div class="row">
                                                @forelse($this->images as $key => $image)
                                                    <div class="col-sm-6 col-xl-3 text-danger ">
                                                        <img src="{{ $image['imageUrl'] }}" class="img-fluid mb-30"
                                                            alt="">
                                                        <a wire:click="deleteNewImage('{{ $key }}')"
                                                            style="cursor: pointer;">X видалити</a>
                                                    </div>
                                                @empty
                                                @endforelse

                                            </div>
                                        </div> --}}
                                    </div>

                                    @if(!empty($this->article->id))
                                        <div class="card-body pb-0">
                                            <div class="d-flex justify-content-between align-items-center mb-20">
                                                <h6 class="card-title mb-0">{{ __('admin.slider') }}</h6>

                                                <a href="{{ route('admin.articles.create-article-slide', ['article' => $this->article]) }}"
                                                    class="btn btn-primary waves-effect waves-light float-right mb-3">
                                                    + {{ __('admin.add_slide') }}
                                                </a>
                                            </div>

                                            <div class="table-responsive art-cars-list">
                                                <table class="table table-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('admin.sort') }}</th>
                                                            <th>{{ __('admin.title') }}</th>
                                                            <th style="text-align: right">{{ __('admin.actions') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($this->article->articleSliders()->with('translations')->orderBy('sort', 'ASC')->get() as $block)
                                                            <tr>
                                                                <td>
                                                                    @if ($loop->iteration !== 1)
                                                                        <div style="cursor: pointer;"
                                                                            wire:click="newSliderPosition(-1, {{ $block }})">
                                                                            <i class="fa fa-sort-up"></i>
                                                                        </div>
                                                                    @endif
                                                                    {{ $block->sort }}
                                                                    @if (!$loop->last)
                                                                        <div style="cursor: pointer;"
                                                                            wire:click="newSlidePosition(+1, {{ $block }})">
                                                                            <i class="fa fa-sort-desc"></i>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $block->title }}</td>
                                                                <td style="text-align: right">
                                                                    <a href="{{ route('admin.articles.edit-article-slide', ['article' => $this->article, 'slide' => $block]) }}"
                                                                        class="mr-2"><i
                                                                            class="fa fa-edit text-info font-18"></i></a>
                                                                    <a wire:click="deleteItem('{{ $block->id }}', 'articleSlide')" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty($this->article->id))
                                        <div class="card-body pb-0">
                                            <div class="d-flex justify-content-between align-items-center mb-20">
                                                <h6 class="card-title mb-0">{{ __('admin.article_blocks_list') }}</h6>

                                                <a href="{{ route('admin.articles.create-block', ['article' => $this->article]) }}"
                                                    class="btn btn-primary waves-effect waves-light float-right mb-3">
                                                    + {{ __('admin.add_block') }}
                                                </a>
                                            </div>

                                            <div class="table-responsive art-cars-list">
                                                <table class="table table-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('admin.sort') }}</th>
                                                            <th>{{ __('admin.type') }}</th>
                                                            <th>{{ __('admin.title') }}</th>
                                                            <th style="text-align: right">{{ __('admin.actions') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($this->article->articleBlocks()->with('translations')->orderBy('sort', 'ASC')->get() as $block)
                                                            <tr>
                                                                <td>
                                                                    @if ($loop->iteration !== 1)
                                                                        <div style="cursor: pointer;"
                                                                            wire:click="newPosition(-1, {{ $block }})">
                                                                            <i class="fa fa-sort-up"></i>
                                                                        </div>
                                                                    @endif
                                                                    {{ $block->sort }}
                                                                    @if (!$loop->last)
                                                                        <div style="cursor: pointer;"
                                                                            wire:click="newPosition(+1, {{ $block }})">
                                                                            <i class="fa fa-sort-desc"></i>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td>{{ $block->type }}</td>
                                                                <td>{{ $block->first_title }}</td>
                                                                <td style="text-align: right">
                                                                    <a href="{{ route('admin.articles.edit-block', ['article' => $this->article, 'block' => $block]) }}"
                                                                        class="mr-2"><i
                                                                            class="fa fa-edit text-info font-18"></i></a>
                                                                    <a wire:click="deleteItem('{{ $block->id }}', 'articleBlock')" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
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
