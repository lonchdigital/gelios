<div class="row" wire:ignore.self>
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <form wire:submit.prevent="save">
                    <section class="mb-50">
                        <h6 class="card-title">
                            @if (!empty($this->doctor->id))
                                Редагування лікаря
                            @else
                                Додавання лікаря
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
                                                                            <label>Ім'я
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
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>Освіта
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <textarea wire:model="uaEducation" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('uaEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaEducation') }}</div>
                                                                @elseif($errors->has('ruEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruEducation') }}</div>
                                                                @elseif($errors->has('enEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enEducation') }}</div>
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
                                                                            <label>Спеціальність
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <textarea wire:model="uaSpecialty" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('uaSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSpecialty') }}</div>
                                                                @elseif($errors->has('ruSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSpecialty') }}</div>
                                                                @elseif($errors->has('enSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSpecialty') }}</div>
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
                                                                            <label>Заголовок
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
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>Освіта
                                                                                <strong>RU</strong>
                                                                            </label>
                                                                            <textarea wire:model="ruEducation" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('ruEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruEducation') }}</div>
                                                                @elseif($errors->has('uaEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaEducation') }}</div>
                                                                @elseif($errors->has('enEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enEducation') }}</div>
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
                                                                            <label>Спеціальність
                                                                                <strong>RU</strong>
                                                                            </label>
                                                                            <textarea wire:model="ruSpecialty" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('ruSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSpecialty') }}</div>
                                                                @elseif($errors->has('uaSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSpecialty') }}</div>
                                                                @elseif($errors->has('enSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSpecialty') }}</div>
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
                                                                            <label>Заголовок
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
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>Освіта
                                                                                <strong>EN</strong>
                                                                            </label>
                                                                            <textarea wire:model="enEducation" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('enEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enEducation') }}</div>
                                                                @elseif($errors->has('ruEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruEducation') }}</div>
                                                                @elseif($errors->has('uaEducation'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaEducation') }}</div>
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
                                                                            <label>Спеціальність
                                                                                <strong>EN</strong>
                                                                            </label>
                                                                            <textarea wire:model="enSpecialty" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($errors->has('enSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('enSpecialty') }}</div>
                                                                @elseif($errors->has('ruSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('ruSpecialty') }}</div>
                                                                @elseif($errors->has('uaSpecialty'))
                                                                    <div class="mt-1 text-danger ajaxError">{{ $errors->first('uaSpecialty') }}</div>
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
                                                        <div class="text-danger">{{ $errors->first('uaDescription') }}</div>
                                                    @elseif($errors->has('ruDescription'))
                                                        <div class="text-danger">{{ $errors->first('ruDescription') }}</div>
                                                    @elseif($errors->has('enDescription'))
                                                        <div class="text-danger">{{ $errors->first('enDescription') }}</div>
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
                                                                        <label>Спеціалізація
                                                                        </label>
                                                                        <select class="form-control rounded-0"
                                                                            wire:model.live="specialization">
                                                                            <option value="">Виберіть спеціалізацію</option>
                                                                            @forelse($this->specializations as $specialization2)
                                                                                <option value="{{ $specialization2->id }}">{{ $specialization2->title }}</option>
                                                                            @empty
                                                                            @endforelse
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('specialization')
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
                                                                        <label>Категорія
                                                                        </label>
                                                                        <select class="form-control rounded-0"
                                                                            wire:model.live="category">
                                                                            <option value="">Виберіть категорію</option>
                                                                            @forelse($this->categories as $category2)
                                                                                <option value="{{ $category2->id }}">{{ $category2->title }}</option>
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
                                                                        <label>Слаг
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
                                                                        <label>Вік
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
                                                                        <label>Досвід
                                                                        </label>
                                                                        <input type="number" wire:model="expirience"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('expiriencee')
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
                                                                        <label>Додати диплом або сертифікат</label>
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
                                            <h5 class="card-title">Дипломи та сертифікати</h5>
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
                                    </div>
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
