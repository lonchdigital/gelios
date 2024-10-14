<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card-head mb-20">
                    <h4 class="card-head-title">
                        @if(is_null($test))
                            {{ trans('admin.new_test') }}
                        @else
                            {{ trans('admin.edit_test') }}
                        @endif
                    </h4>
                </div>

                <form wire:submit.prevent="save">

                    <section class="mb-50 mt-30">
                        <x-admin.multilanguage-input
                            :is-required="false"
                            :label="trans('admin.title')"
                            field-name="title"
                            live-wire-field="sectionData.title"
                            :values="$sectionData['title']"
                        />
                    </section>

                    <section class="mb-50 mt-30 art-services-section ">
                        <h6 class="card-title">{{ trans('admin.prices') }}</h6>

                        @if(isset($prices))
                            @foreach($prices as $index => $price)

                                <div class="">
                                    <div class="row justify-content-between align-items-center">

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-1 service-left-side">
                                                    <div class="art-sort-arrows">
                                                        @if ($loop->iteration !== 1)
                                                            <div style="cursor: pointer;"
                                                                wire:click="newPositionPrices(-1, {{ $index }})">
                                                                <i class="fa fa-sort-up"></i>
                                                            </div>
                                                        @endif
                                                        {{ $price['sort'] }}
                                                        @if (!$loop->last)
                                                            <div style="cursor: pointer;"
                                                                wire:click="newPositionPrices(+1, {{ $index }})">
                                                                <i class="fa fa-sort-desc"></i>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="art-remove">
                                                        <a wire:click="removeElementPrices('{{ $index }}')">
                                                            <i class="ti-close font-weight-bold mr-2"></i>
                                                        </a>
                                                    </div>
                                                    
                                                </div>

                                                <div class="col-md-9">
                                                    <x-admin.multilanguage-input
                                                        :is-required="false"
                                                        :label="trans('admin.service')"
                                                        field-name="prices.{{ $index }}.service"
                                                        live-wire-field="prices.{{ $index }}.service"
                                                        :values="$price['service']"
                                                    />
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group mb-1">
                                                        <label for="meta_title_ua">{{ trans('admin.price') }}</label>
                                                        <input type="number" wire:model="prices.{{ $index }}.price" name="prices.{{ $index }}.price" value="{{ $price['price'] }}" class="form-control">
                                                    </div>
                                                </div>

                                                <input type="hidden" name="direction_price_id" value="{{ $this->prices[$index]['id'] }}">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                            @endforeach
                        @endif

                        <div class="row pt-3">
                            <div class="col-md-12 text-center">
                                <a wire:click="addElementPrices" class="btn mb-2 btn-secondary">
                                    <span class="ti-plus font-weight-bold"></span>
                                    {{ trans('admin.add') }}
                                </a>
                            </div>
                        </div>

                    </section>

                    <button type="submit" class="btn btn-primary mr-2 mb-3">{{ trans('admin.save') }}</button>
                </form>
            </div>
        </div>
        <div class="pagination-wrapper d-flex justify-content-center mt-4 mb-5">
            {{-- {{ $this->faqs->links('vendor.pagination.default') }} --}}
        </div>
    </div>
</div>