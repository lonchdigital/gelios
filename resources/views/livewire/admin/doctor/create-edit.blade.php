<div class="row" wire:ignore.self>
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <form wire:submit.prevent="save">
                    <section class="mb-50">
                        <h6 class="card-title">
                            @if (!empty($this->doctor->id))
                                {{ __('admin.edit_doctor') }}
                            @else
                                {{ __('admin.create_doctor') }}
                            @endif
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
                                                                            <label>{{ __('admin.first_name') }}
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="uaTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('uaTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('uaTitle') }}</div>
                                                                @elseif($errors->has('ruTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('ruTitle') }}</div>
                                                                @elseif($errors->has('enTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('enTitle') }}</div>
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
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.education') }}
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <textarea wire:model="uaEducation" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('uaEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('uaEducation') }}</div>
                                                                @elseif($errors->has('ruEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('ruEducation') }}</div>
                                                                @elseif($errors->has('enEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('enEducation') }}</div>
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
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.specialty') }}
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <textarea wire:model="uaSpecialty" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('uaSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('uaSpecialty') }}</div>
                                                                @elseif($errors->has('ruSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('ruSpecialty') }}</div>
                                                                @elseif($errors->has('enSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('enSpecialty') }}</div>
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
                                                                            <label>{{ __('admin.slug') }}
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="uaSlug"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('uaSlug'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('uaSlug') }}</div>
                                                                @elseif($errors->has('ruSlug'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('ruSlug') }}</div>
                                                                @elseif($errors->has('enSlug'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('enSlug') }}</div>
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
                                                                @if ($errors->has('ruTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('ruTitle') }}</div>
                                                                @elseif($errors->has('uaTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('uaTitle') }}</div>
                                                                @elseif($errors->has('enTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('enTitle') }}</div>
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
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.education') }}
                                                                                <strong>RU</strong>
                                                                            </label>
                                                                            <textarea wire:model="ruEducation" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('ruEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('ruEducation') }}</div>
                                                                @elseif($errors->has('uaEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('uaEducation') }}</div>
                                                                @elseif($errors->has('enEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('enEducation') }}</div>
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
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.specialty') }}
                                                                                <strong>RU</strong>
                                                                            </label>
                                                                            <textarea wire:model="ruSpecialty" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('ruSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('ruSpecialty') }}</div>
                                                                @elseif($errors->has('uaSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('uaSpecialty') }}</div>
                                                                @elseif($errors->has('enSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('enSpecialty') }}</div>
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
                                                                            <label>{{ __('admin.slug') }}
                                                                                <strong>RU</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="ruSlug"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('ruSlug'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('ruSlug') }}</div>
                                                                @elseif($errors->has('uaSlug'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('uaSlug') }}</div>
                                                                @elseif($errors->has('enSlug'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('enSlug') }}</div>
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
                                                                @if ($errors->has('enTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('enTitle') }}</div>
                                                                @elseif($errors->has('ruTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('ruTitle') }}</div>
                                                                @elseif($errors->has('uaTitle'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('uaTitle') }}</div>
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
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.education') }}
                                                                                <strong>EN</strong>
                                                                            </label>
                                                                            <textarea wire:model="enEducation" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('enEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('enEducation') }}</div>
                                                                @elseif($errors->has('ruEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('ruEducation') }}</div>
                                                                @elseif($errors->has('uaEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('uaEducation') }}</div>
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
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.specialty') }}
                                                                                <strong>EN</strong>
                                                                            </label>
                                                                            <textarea wire:model="enSpecialty" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('enSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('enSpecialty') }}</div>
                                                                @elseif($errors->has('ruSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('ruSpecialty') }}</div>
                                                                @elseif($errors->has('uaSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('uaSpecialty') }}</div>
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
                                                                            <label>{{ __('admin.slug') }}
                                                                                <strong>EN</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="enSlug"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if ($errors->has('enSlug'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('enSlug') }}</div>
                                                                @elseif($errors->has('ruSlug'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('ruSlug') }}</div>
                                                                @elseif($errors->has('uaSlug'))
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $errors->first('uaSlug') }}</div>
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
                                                    <x-admin.multilanguage-text-area-rich :is-required="false"
                                                        :label="__('admin.description')" field-name="description"
                                                        live-wire-field="description" :values="[
                                                            'ua' => $this->uaDescription,
                                                            'ru' => $this->ruDescription,
                                                            'en' => $this->enDescription,
                                                        ]" />
                                                    @if ($errors->has('uaDescription'))
                                                        <div class="text-danger">{{ $errors->first('uaDescription') }}
                                                        </div>
                                                    @elseif($errors->has('ruDescription'))
                                                        <div class="text-danger">{{ $errors->first('ruDescription') }}
                                                        </div>
                                                    @elseif($errors->has('enDescription'))
                                                        <div class="text-danger">{{ $errors->first('enDescription') }}
                                                        </div>
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
                                                                        <label>{{ __('admin.category') }}
                                                                        </label>
                                                                        <select class="form-control rounded-0"
                                                                            wire:model.live="category">
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
                                                            @error('category')
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
                                                                        <label>{{ __('admin.age') }}
                                                                        </label>
                                                                        <input type="number" wire:model="age"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('age')
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
                                                                        <label>{{ __('admin.experience') }}
                                                                        </label>
                                                                        <input type="number" wire:model="expirience"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('expirience')
                                                                <div class="mt-1 text-danger ajaxError">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
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
                                                                            <label>{{ __('admin.seo_page_title') }}
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="uaSeoTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-1 text-danger ajaxError">{{ 'Введіть %title% для підстановки' }}</div>
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
                                                                <div class="mt-1 text-danger ajaxError">{{ 'Введіть %title% для підстановки' }}</div>
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
                                                                <div class="mt-1 text-danger ajaxError">{{ 'Введіть %title% для підстановки' }}</div>
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
                                                            @elseif(!empty($this->doctor->image))
                                                                <img src="{{ $this->doctor->imageUrl }}"
                                                                    width="60">
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
                                                                <div
                                                                    class="multilang-content tab-pane fade active show ">
                                                                    <div class="form-group mb-1">
                                                                        <label>{{ __('admin.add_diploma_or_certificate') }}</label>
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
                                        </div>

                                        <div class="card-body pb-0 mb-5">
                                            <h5 class="card-title">{{ __('admin.diploma_or_certificate') }}</h5>
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
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="form-group mb-1">
                                                                <label>{{ __('areas_of_treatment') }}
                                                                </label>
                                                                @forelse($this->selectedArray ?? [] as $key => $item2)
                                                                    <li class="flex justify-between items-center py-2 px-3 border-b border-[#1f293733]"
                                                                        style="border-color: #1f293733">
                                                                        <span>{{ $item2->name ?? $item2['name'] }}</span>
                                                                        <a wire:click="deleteItem({{ $key }})" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                                                    </li>
                                                                @empty
                                                                    <li class="py-2 px-3">Empty</li>
                                                                @endforelse
                                                            </div>
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
                                                            <div class="form-group mb-1">
                                                                <label>{{ __('admin.add_direction') }}
                                                                </label>
                                                                <input type="search" tabIndex="0"
                                                                placeholder="Search"
                                                                wire:model.live="searchDirection"
                                                                    class="form-control">
                                                            </div>
                                                            @if(count($this->directions))
                                                            <div class="dropdown open w-full">
                                                                <ul tabindex="0"
                                                                    class="dropdown-content dropdown-open menu p-2 shadow rounded-box w-fit min-w-52 max-w-[400px] bg-white z-50">
                                                                    @foreach ($this->directions as $direction)
                                                                        <li
                                                                            wire:click="selectNetwork('{{ $direction->id }}')">
                                                                            <span>{{ $direction->name }}</span>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
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
                                                            <div class="form-group mb-1">
                                                                <label>{{ __('admin.doctor_specializations') }}
                                                                </label>
                                                                @forelse($this->selectedSpecializations ?? [] as $key => $specialization2)
                                                                    <li class="flex justify-between items-center py-2 px-3 border-b border-[#1f293733]"
                                                                        style="border-color: #1f293733">
                                                                        <span>{{ $specialization2->title ?? $specialization2['title'] }}</span>
                                                                        <a wire:click="deleteSpecializationItem({{ $key }})" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                                                    </li>
                                                                @empty
                                                                    <li class="py-2 px-3">{{ __('admin.empty') }}</li>
                                                                @endforelse
                                                            </div>
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
                                                            <div class="form-group mb-1">
                                                                <label>{{ __('admin.add_specialization') }}
                                                                </label>
                                                                <input type="search" tabIndex="0"
                                                                placeholder="Search"
                                                                wire:model.live="searchSpecialization"
                                                                    class="form-control">
                                                            </div>
                                                            @if(count($this->specializations))
                                                            <div class="dropdown open w-full">
                                                                <ul tabindex="0"
                                                                    class="dropdown-content dropdown-open menu p-2 shadow rounded-box w-fit min-w-52 max-w-[400px] bg-white z-50">
                                                                    @foreach ($this->specializations as $specialization)
                                                                        <li
                                                                            wire:click="selectSpecialization('{{ $specialization->id }}')">
                                                                            <span>{{ $specialization->title }}</span>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
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
