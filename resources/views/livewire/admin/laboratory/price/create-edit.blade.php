<div class="row" wire:ignore.self>
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <form wire:submit.prevent="save">
                    <section class="mb-50">
                        <h6 class="card-title">
                            @if (!empty($this->category->id))
                                {{ __('admin.edit_category') }}
                            @else
                                {{ __('admin.create_category') }}
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
                                                                            <label>{{ __('admin.title') }}
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="uaTitle"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('uaTitle')
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
                                                                @error('ruTitle')
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
                                                                @error('enTitle')
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

                            @if(!empty($this->category->id))
                                <div class="col-12 faq-car-row pb-1 mb-4 d-flex justify-content-start">
                                    <div class="border border-secondary rounded p-3 col-md-11">
                                        <div class="row justify-content-between align-items-center m-2" wire:ignore.self>
                                            <div class="d-flex justify-content-between align-items-center mb-20">
                                                <h6 class="card-title mb-0">{{ __('admin.prices_list') }}</h6>&nbsp;&nbsp;&nbsp;

                                                <div style="text-align: right;">
                                                    <a href="{{ route('admin.laboratories.prices.create-item', ['category' => $this->category]) }}" class="btn btn-primary waves-effect waves-light float-right mb-3">
                                                        + {{ __('admin.add_item') }}
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="table-responsive art-cars-list">
                                                <table class="table table-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('admin.title') }}</th>
                                                            <th>{{ __('admin.price') }}</th>
                                                            <th style="text-align: right">{{ __('admin.actions') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($this->category->labPriceItems as $item)
                                                        <tr>
                                                            <td>{{ $item->title }}</td>
                                                            <td>
                                                                {{ $item->price }}
                                                            </td>
                                                            <td style="text-align: right">
                                                                <a href="{{ route('admin.laboratories.prices.edit-item', ['category' => $this->category, 'item' => $item]) }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                                                <a wire:click="deleteItem('{{ $item->id }}', 'categoryPriceItem')" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>

                    <button type="submit" class="btn btn-primary mr-2 mb-3">{{ __('admin.save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
