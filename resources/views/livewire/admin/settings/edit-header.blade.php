<div class="row" wire:ignore.self>
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit.prevent="save">
                    <section class="mb-50">
                        <h6 class="">
                            {{ __('admin.edit_header') }}
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
                                                                            <label>{{ __('admin.first_city') }}
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="uaFirstCity"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('uaFirstCity')
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
                                                                            <label>{{ __('admin.first_city') }}
                                                                                <strong>RU</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="ruFirstCity"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('ruFirstCity')
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
                                                                            <label>{{ __('admin.first_city') }}
                                                                                <strong>EN</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="enFirstCity"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('enFirstCity')
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
                                                                        <label>{{ __('admin.first_city_first_phone') }}
                                                                            <strong>UA</strong>
                                                                        </label>
                                                                        <input type="text" wire:model="firstCityFirstPhone"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('firstCityFirstPhone')
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
                                                                        <label>{{ __('admin.first_city_second_phone') }}
                                                                            <strong>UA</strong>
                                                                        </label>
                                                                        <input type="text" wire:model="firstCitySecondPhone"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('firstCitySecondPhone')
                                                                <div class="mt-1 text-danger ajaxError">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- @forelse ($this->headerAffiliates as $index => $affiliate)

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="tab-content">
                                                                    <div id="uaTitle"
                                                                        class="multilang-content tab-pane fade active show">
                                                                        <div class="form-group mb-1">
                                                                            <h8>{{ __('admin.branch') }} {{ $loop->iteration }}</h8>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                                                <label>{{ __('admin.address') }}
                                                                                    <strong>UA</strong>
                                                                                </label>
                                                                                <input type="text" wire:model="translatedAddresses.{{ $index }}.ua"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @error("translatedAddresses.$index.ua")
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
                                                                                <label>{{ __('admin.address') }}
                                                                                    <strong>RU</strong>
                                                                                </label>
                                                                                <input type="text" wire:model="translatedAddresses.{{ $index }}.ru"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @error("translatedAddresses.$index.ru")
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
                                                                                <label>{{ __('admin.address') }}
                                                                                    <strong>EN</strong>
                                                                                </label>
                                                                                <input type="text" wire:model="translatedAddresses.{{ $index }}.en"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @error("translatedAddresses.$index.en")
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
                                                                            <label>{{ __('admin.first_phone_number') }}
                                                                            </label>
                                                                            <input type="text" wire:model="headerAffiliates.{{ $index }}.first_phone"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error("headerAffiliates.$index.first_phone")
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
                                                                            <label>{{ __('admin.second_phone_number') }}
                                                                            </label>
                                                                            <input type="text" wire:model="headerAffiliates.{{ $index }}.second_phone"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error("headerAffiliates.$index.second_phone")
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
                                                                            <label>Email
                                                                            </label>
                                                                            <input type="text" wire:model="headerAffiliates.{{ $index }}.email"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error("headerAffiliates.$index.email")
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
                                                                            <label>{{ __('admin.work_hours') }}
                                                                            </label>
                                                                            <input type="text" wire:model="headerAffiliates.{{ $index }}.hours"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error("headerAffiliates.$index.hours")
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
                                                                            <label>{{ __('admin.latitude') }}
                                                                            </label>
                                                                            <input type="text" wire:model="headerAffiliates.{{ $index }}.latitude"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error("headerAffiliates.$index.latitude")
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
                                                                            <label>{{ __('admin.longitude') }}
                                                                            </label>
                                                                            <input type="text" wire:model="headerAffiliates.{{ $index }}.longitude"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error("headerAffiliates.$index.longitude")
                                                                    <div class="mt-1 text-danger ajaxError">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse --}}

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
                                                                            <label>{{ __('admin.second_city') }}
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="uaSecondCity"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('uaSecondCity')
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
                                                                            <label>{{ __('admin.second_city') }}
                                                                                <strong>RU</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="ruSecondCity"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('ruSecondCity')
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
                                                                            <label>{{ __('admin.second_city') }}
                                                                                <strong>EN</strong>
                                                                            </label>
                                                                            <input type="text" wire:model="enSecondCity"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('enSecondCity')
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
                                                                        <label>{{ __('admin.second_city_first_phone') }}
                                                                            <strong>UA</strong>
                                                                        </label>
                                                                        <input type="text" wire:model="secondCityFirstPhone"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('secondCityFirstPhone')
                                                                <div class="mt-1 text-danger ajaxError">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
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
                                                                        <h7>{{ __('admin.branches_of_the_second_city') }}</h7>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="tab-content">
                                                                <div
                                                                    class="multilang-content tab-pane fade active show ">
                                                                    <div class="form-group mb-1">
                                                                        <label>{{ __('admin.header_image') }}</label>
                                                                        <input type="file" wire:model="headerImage"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('headerImage')
                                                                <div class="mt-1 text-danger ajaxError">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror

                                                            @if ($this->headerImageTemporary)
                                                                <div class="flex">
                                                                    <img src="{{ $this->headerImageTemporary }}"
                                                                        width="60">
                                                                    <a wire:click="deleteHeaderImage()"
                                                                        style="cursor: pointer;">
                                                                        <i class="ti-close font-weight-bold mr-2"></i>
                                                                        {{ __('admin.delete_image') }}
                                                                    </a>
                                                                </div>
                                                            @elseif(!empty($this->headImage->value))
                                                                <img src="{{ $this->headImage->imageUrl }}"
                                                                    width="60">
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

                        <div class="card mb-30">
                            <div class="card-body pb-0">
                                <div class="d-flex justify-content-between align-items-center mb-20">
                                    <h6 class=" mb-0">{{ __('admin.first_city_header_affiliates') }}</h6>

                                    <a href="{{ route('admin.affiliate.create', ['city' => 1]) }}" class="btn btn-primary waves-effect waves-light float-right mb-3">
                                        + {{ __('admin.add_affiliate') }}
                                    </a>
                                </div>

                                <div class="table-responsive art-cars-list">
                                    <table class="table table-nowrap">
                                        <thead>
                                            <tr>
                                                <th>{{ __('admin.name') }}</th>
                                                <th style="text-align: right">{{ __('admin.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($this->affiliates as $affiliate)
                                            @if($affiliate->header_city_id == 1)
                                                <tr>
                                                    <td>{{ $affiliate->address }}</td>
                                                    <td style="text-align: right">
                                                        <a href="{{ route('admin.affiliate.edit', ['city' => 1, 'affiliate' => $affiliate]) }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                                        <a wire:click="deleteItem('{{ $affiliate->id }}', 'affiliate')" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-30">
                            <div class="card-body pb-0">
                                <div class="d-flex justify-content-between align-items-center mb-20">
                                    <h6 class=" mb-0">{{ __('admin.second_city_header_affiliates') }}</h6>

                                    <a href="{{ route('admin.affiliate.create', ['city' => 2]) }}" class="btn btn-primary waves-effect waves-light float-right mb-3">
                                        + {{ __('admin.add_affiliate') }}
                                    </a>
                                </div>

                                <div class="table-responsive art-cars-list">
                                    <table class="table table-nowrap">
                                        <thead>
                                            <tr>
                                                <th>{{ __('admin.name') }}</th>
                                                <th style="text-align: right">{{ __('admin.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($this->affiliates as $affiliate2)
                                            @if($affiliate2->header_city_id == 2)
                                                <tr>
                                                    <td>{{ $affiliate2->address }}</td>
                                                    <td style="text-align: right">
                                                        <a href="{{ route('admin.affiliate.edit', ['city' => 2, 'affiliate' => $affiliate2]) }}" class="mr-2"><i class="fa fa-edit text-info font-18"></i></a>
                                                        <a wire:click="deleteItem('{{ $affiliate2->id }}', 'affiliate')" style="cursor: pointer"><i class="fa fa-trash text-danger font-18"></i></a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
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
