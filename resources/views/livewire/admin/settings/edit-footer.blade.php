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
                        <h6 class="card-title">
                            {{ __('admin.edit_footer') }}
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
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.footer_description') }}
                                                                                <strong>UA</strong>
                                                                            </label>
                                                                            <textarea wire:model="uaDescription" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('uaDescription')
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
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.footer_description') }}
                                                                                <strong>RU</strong>
                                                                            </label>
                                                                            <textarea wire:model="ruDescription" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('ruDescription')
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
                                                                    <div
                                                                        class="multilang-content tab-pane fade active show ">
                                                                        <div class="form-group mb-1">
                                                                            <label>{{ __('admin.text') }}
                                                                                <strong>EN</strong>
                                                                            </label>
                                                                            <textarea wire:model="enDescription" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('enDescription')
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
                                                                        <label>{{ __('admin.facebook_link') }}
                                                                        </label>
                                                                        <input type="text" wire:model="facebook"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('facebook')
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
                                                                        <label>{{ __('admin.instagram_link') }}
                                                                        </label>
                                                                        <input type="text" wire:model="inst"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('inst')
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
                                                                        <label>{{ __('admin.youtube_link') }}
                                                                        </label>
                                                                        <input type="text" wire:model="youtube"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('youtube')
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
                                                                        <label>{{ __('admin.footer_image') }}</label>
                                                                        <input type="file" wire:model="footerImage"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @error('footerImage')
                                                                <div class="mt-1 text-danger ajaxError">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror

                                                            @if ($this->footerImageTemporary)
                                                                <div class="flex">
                                                                    <img src="{{ $this->footerImageTemporary }}"
                                                                        width="60">
                                                                    <a wire:click="deleteFooterImage()"
                                                                        style="cursor: pointer;">
                                                                        <i class="ti-close font-weight-bold mr-2"></i>
                                                                        {{ __('admin.delete_image') }}
                                                                    </a>
                                                                </div>
                                                            @elseif(!empty($this->footImage->value))
                                                                <img src="{{ $this->footImage->imageUrl }}"
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
                                                                        <h7>{{ __('admin.branches_in_footer') }}</h7>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @forelse ($this->footerAffiliates as $index => $affiliate)

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
                                                                            <input type="text" wire:model="footerAffiliates.{{ $index }}.first_phone"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error("footerAffiliates.$index.first_phone")
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
                                                                            <input type="text" wire:model="footerAffiliates.{{ $index }}.second_phone"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error("footerAffiliates.$index.second_phone")
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
                                                                            <input type="text" wire:model="footerAffiliates.{{ $index }}.email"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error("footerAffiliates.$index.email")
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
                                                                            <input type="text" wire:model="footerAffiliates.{{ $index }}.hours"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error("footerAffiliates.$index.hours")
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
                                                                            <input type="text" wire:model="footerAffiliates.{{ $index }}.latitude"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error("footerAffiliates.$index.latitude")
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
                                                                            <input type="text" wire:model="footerAffiliates.{{ $index }}.longitude"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error("footerAffiliates.$index.longitude")
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
                                        @endforelse
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
