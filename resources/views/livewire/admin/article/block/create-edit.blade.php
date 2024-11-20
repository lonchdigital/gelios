<div class="row" wire:ignore.self>
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <form wire:submit.prevent="save">
                    <section class="mb-50">
                        <h6 class="card-title">
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
                                                                        <label>Тип блоку
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
                                                                            <label>Заголовок
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

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>Опис
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
                                            </div>

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
                                                                                <label>Заголовок другого блоку
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

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div
                                                                            class="multilang-content tab-pane fade active show ">
                                                                            <div class="form-group mb-1">
                                                                                <label>Опис другого блоку
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
                                                </div>
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
                                                                            <label>Заголовок
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

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>Опис
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
                                            </div>

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
                                                                                <label>Заголовок другого блоку
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

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div
                                                                            class="multilang-content tab-pane fade active show ">
                                                                            <div class="form-group mb-1">
                                                                                <label>Опис другого блоку
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
                                                </div>
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
                                                                            <label>Заголовок
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

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>Опис
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
                                            </div>

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
                                                                                <label>Заголовок другого блоку
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

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <div class="tab-content">
                                                                        <div
                                                                            class="multilang-content tab-pane fade active show ">
                                                                            <div class="form-group mb-1">
                                                                                <label>Опис другого блоку
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
                                                </div>
                                            @endif
                                        @endif
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
