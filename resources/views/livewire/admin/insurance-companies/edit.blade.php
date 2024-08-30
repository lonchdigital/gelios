<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <form wire:submit.prevent="save">
                    <section class="mb-50">
                        <h6 class="card-title">{{ trans('admin.insurance_companies') }}</h6>


                        {{-- @dd('yes!', $this->companiesRowOne, $this->companiesRowTwo) --}}

                        {{-- @dd($this->companiesRowOne) --}}

                        <div class="row" id="companies-row-one">

                            @if(isset($this->companiesRowOne))
                                @foreach($this->companiesRowOne as $index => $companyRowOne)

                                <div class="col-md-4 company-row pb-1 mb-4" id="company-id-rrr">
                                    <div>
                                        <div class="border border-secondary rounded p-3">
                                            <div class="row justify-content-between align-items-center">

                                                <div class="col-md-12">
                                                    <div class="row" id="company-item-rrr">
                                                        <div class="col-md-12">

                                                            <div class="col-md-1">
                                                                @if ($loop->iteration !== 1)
                                                                    <div style="cursor: pointer;"
                                                                        wire:click="newPositionRowOne(-1, {{ $index }})">
                                                                        <i class="fa fa-sort-up"></i>
                                                                    </div>
                                                                @endif
                                                                {{ $companyRowOne['sort'] }}
                                                                @if (!$loop->last)
                                                                    <div style="cursor: pointer;"
                                                                        wire:click="newPositionRowOne(+1, {{ $index }})">
                                                                        <i class="fa fa-sort-desc"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                    

                                                            <x-admin.multilanguage-input
                                                                :is-required="false"
                                                                :label="trans('admin.item')"
                                                                field-name="company[rrr][test]"
                                                                field-display="test"
                                                                :values="[]"
                                                                />

                                                                {{ $companyRowOne['image'] }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <a href="#">
                                                        <i class="ti-close font-weight-bold mr-2"></i>
                                                        {{ trans('admin.delete') }}
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            @endif

                        </div>
                        <div class="row pt-3">
                            <div class="col-md-12 text-center">
                                <a href="#" id="add-company" class="btn mb-2 btn-secondary">
                                    <span class="ti-plus font-weight-bold"></span>
                                    {{ trans('admin.add_item') }}
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
