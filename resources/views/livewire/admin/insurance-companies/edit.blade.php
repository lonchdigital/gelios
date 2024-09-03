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
                    <h4 class="card-head-title">{{ trans('admin.insurance_companies') }}</h4>
                </div>

                <form wire:submit.prevent="save">

                    <h6 class="card-title">{{ trans('admin.row_one') }}</h6>

                    <section class="mb-50">
                        


                        <div class="row" id="companies-row-one">

                            @if(isset($this->companiesRowOne))
                                @foreach($this->companiesRowOne as $index => $companyRowOne)

                                <div class="col-md-4 company-row pb-1 mb-4">
                                    <div>
                                        <div class="border border-secondary rounded p-3">
                                            <div class="row justify-content-between align-items-center">

                                                <div class="col-md-12">
                                                    <div class="row">
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

                                                            {{-- <x-admin.multilanguage-input
                                                                :is-required="false"
                                                                :label="trans('admin.item')"
                                                                field-name="company[rrr][test]"
                                                                field-display="test"
                                                                :values="$companyRowOne['fields']"
                                                                /> --}}

                                                            <div class="form-group mt-2 mb-3">
                                                                <label for="">Зображення</label></br>
                                                                @if (isset($this->companiesRowOne[$index]['temporaryImage']))
                                                                    <img src="{{ $this->companiesRowOne[$index]['temporaryImage'] }}"
                                                                        width="60"><a
                                                                        wire:click="deleteImageRowOne('{{ $index }}')"
                                                                        style="cursor: pointer;">
                                                                        <i
                                                                            class="ti-close font-weight-bold mr-2"></i>
                                                                        Видалити зображення
                                                                    </a>
                                                                @else
                                                                    @if (isset($this->companiesRowOne[$index]['image']))
                                                                        <img src="{{ '/storage/' . $this->companiesRowOne[$index]['image'] }}"
                                                                            class="mb-2"
                                                                            width="60"></br>
                                                                    @endif

                                                                    <input type="file"
                                                                        wire:model="companiesRowOne.{{ $index }}.newImage">
                                                                @endif
                                                            </div>
                                                            <input type="hidden" name="company_id" value="{{ $this->companiesRowOne[$index]['id'] }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <a wire:click="removeElementRowOne('{{ $index }}')">
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

                        </div> {{-- # companies-row-one --}}
                        

                        <div class="row pt-3">
                            <div class="col-md-12 text-center">
                                <a wire:click="addElementRowOne" class="btn mb-2 btn-secondary">
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
