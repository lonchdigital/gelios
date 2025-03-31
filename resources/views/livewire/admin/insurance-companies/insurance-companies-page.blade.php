<div class="row">
    <div class="col-12">
        <div class=" mb-30">
            <div class=" pb-0">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif


                                <div class="card-head mb-20">
                                    <h4 class="card-head-title">{{ $page->title }}</h4>
                                </div>

                                <form wire:submit.prevent="save">

                                    <section class="mb-50 mt-30">
                                        <x-admin.multilanguage-input
                                            :is-required="false"
                                            :label="trans('admin.title')"
                                            field-name="title"
                                            live-wire-field="pageData.title"
                                            :values="$pageData['title']"
                                        />

                                    </section>

                                    <hr>

                                    <section class="mb-50 mt-30">
                                        <h6 class="card-title">{{ trans('admin.section_text') }}</h6>

                                        <x-admin.multilanguage-input
                                            :is-required="false"
                                            :label="trans('admin.sub_title')"
                                            field-name="sub_title"
                                            live-wire-field="pageData.sub_title"
                                            :values="$pageData['sub_title']"
                                        />
                                        
                                        <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[1][text_one]"
                                            live-wire-field="textBlockOneData.text_one"
                                            :values="$textBlockOneData['text_one']"
                                        />
                
                                        @if($textBlockOneData['is_image'])
                                            <div class="form-group mt-2 mb-3">
                                                <label for="">{{ trans('admin.image') }}</label></br>
                                                @if (isset($textBlockOneData['media']['temporaryImage']))
                                                    <img src="{{ $textBlockOneData['media']['temporaryImage'] }}"
                                                        width="60"><a
                                                        wire:click="deleteSectionImage()"
                                                        style="cursor: pointer;">
                                                        <i
                                                            class="ti-close font-weight-bold mr-2"></i>
                                                            {{ trans('admin.remove_image') }}
                                                    </a>
                                                @else
                                                    @if (isset($textBlockOneData['media']['image']))
                                                        <img src="{{ '/storage/' . $textBlockOneData['media']['image'] }}"
                                                            class="mb-2"
                                                            width="60"></br>
                                                    @endif
                
                                                    <input type="file"
                                                        wire:model="textBlockOneData.media.newImage">
                                                @endif
                                            </div>
                                        @endif
                
                                    </section>

                                    <hr>

                                    <section class="mb-50 mt-30">

                                        <x-admin.multilanguage-text-area
                                            :is-required="false"
                                            :label="trans('admin.description')"
                                            field-name="description"
                                            live-wire-field="pageData.description"
                                            :values="$pageData['description']"
                                        />

                                        <h6 class="card-title">{{ trans('admin.phones') }}</h6>
                                        <div class="row" id="phones">
                
                                            @if(isset($this->phones))
                                                @foreach($this->phones as $index => $phone)
                
                                                <div class="col-md-4 company-row pb-1 mb-4">
                                                    <div>
                                                        <div class="border border-secondary rounded p-3">
                                                            <div class="row justify-content-between align-items-center">
                
                                                                <div class="col-md-12 mb-3">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                
                                                                            <div class="col-md-1 service-left-side">
                                                                                <div class="art-sort-arrows">
                                                                                    @if ($loop->iteration !== 1)
                                                                                        <div style="cursor: pointer;"
                                                                                            wire:click="newPositionPhones(-1, {{ $index }})">
                                                                                            <i class="fa fa-sort-up"></i>
                                                                                        </div>
                                                                                    @endif
                                                                                    {{ $phone['sort'] }}
                                                                                    @if (!$loop->last)
                                                                                        <div style="cursor: pointer;"
                                                                                            wire:click="newPositionPhones(+1, {{ $index }})">
                                                                                            <i class="fa fa-sort-desc"></i>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                
                                                                            </div>
                
                                                                            <div class="">
                                                                                <div class="form-group mb-1">
                                                                                    <label for="meta_title_ua">{{ trans('admin.phone') }}</label>
                                                                                    <input type="text" wire:model="phones.{{ $index }}.item" name="phones.{{ $index }}.item" value="{{ $phone['item'] }}" class="form-control">
                                                                                    @error("phones.$index.item")
                                                                                        <div class="mt-1 text-danger ajaxError">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                
                                                                            <input type="hidden" name="phone_id" value="{{ $this->phones[$index]['id'] }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                
                                                                <div class="col-md-5">
                                                                    <a wire:click="removeElementPhones('{{ $index }}')">
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
                                                <a wire:click="addElementPhones" class="btn mb-2 btn-secondary">
                                                    <span class="ti-plus font-weight-bold"></span>
                                                    {{ trans('admin.add') }}
                                                </a>
                                            </div>
                                        </div>
                                    </section>

                                    <hr>
                                    
                                    <section class="mb-50 mt-30">
                                        <h6 class="card-title">SEO</h6>

                                        <x-admin.multilanguage-input
                                            :is-required="false"
                                            :label="trans('admin.meta_title')"
                                            field-name="meta_title"
                                            live-wire-field="seoData.meta_title"
                                            :values="$seoData['meta_title']"
                                        />
                                    
                                        <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.meta_description')"
                                            field-name="meta_description"
                                            live-wire-field="seoData.meta_description"
                                            :values="$seoData['meta_description']"
                                        />
                                        <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.meta_keywords')"
                                            field-name="meta_keywords"
                                            live-wire-field="seoData.meta_keywords"
                                            :values="$seoData['meta_keywords']"
                                        />
                                        <x-admin.multilanguage-input
                                            :is-required="false"
                                            :label="trans('admin.seo_title')"
                                            field-name="seo_title"
                                            live-wire-field="seoData.seo_title"
                                            :values="$seoData['seo_title']"
                                        />
                                        <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.seo_text')"
                                            field-name="seo_text"
                                            live-wire-field="seoData.seo_text"
                                            :values="$seoData['seo_text']"
                                        />

                                    </section>

                                    <h6 class="card-title">{{ trans('admin.insurance_companies') }}</h6>

                                    {{-- Row One --}}
                                    <section class="mb-50">
                                        <h6 class="card-title">{{ trans('admin.row_one') }}</h6>
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
                                                                                <label for="">{{ trans('admin.image') }}</label></br>
                                                                                @if (isset($this->companiesRowOne[$index]['temporaryImage']))
                                                                                    <img src="{{ $this->companiesRowOne[$index]['temporaryImage'] }}"
                                                                                        width="60"><a
                                                                                        wire:click="deleteImageRowOne('{{ $index }}')"
                                                                                        style="cursor: pointer;">
                                                                                        <i
                                                                                            class="ti-close font-weight-bold mr-2"></i>
                                                                                            {{ trans('admin.remove_image') }}
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
                                                    {{ trans('admin.add') }}
                                                </a>
                                            </div>
                                        </div>
                                    </section>

                                    {{-- Row Two --}}
                                    <section class="mb-50">
                                        <h6 class="card-title">{{ trans('admin.row_two') }}</h6>
                                        <div class="row" id="companies-row-two">

                                            @if(isset($this->companiesRowTwo))
                                                @foreach($this->companiesRowTwo as $index => $companyRowTwo)

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
                                                                                        wire:click="newPositionRowTwo(-1, {{ $index }})">
                                                                                        <i class="fa fa-sort-up"></i>
                                                                                    </div>
                                                                                @endif
                                                                                {{ $companyRowTwo['sort'] }}
                                                                                @if (!$loop->last)
                                                                                    <div style="cursor: pointer;"
                                                                                        wire:click="newPositionRowTwo(+1, {{ $index }})">
                                                                                        <i class="fa fa-sort-desc"></i>
                                                                                    </div>
                                                                                @endif
                                                                            </div>

                                                                            <div class="form-group mt-2 mb-3">
                                                                                <label for="">{{ trans('admin.image') }}</label></br>
                                                                                @if (isset($this->companiesRowTwo[$index]['temporaryImage']))
                                                                                    <img src="{{ $this->companiesRowTwo[$index]['temporaryImage'] }}"
                                                                                        width="60"><a
                                                                                        wire:click="deleteImageRowTwo('{{ $index }}')"
                                                                                        style="cursor: pointer;">
                                                                                        <i
                                                                                            class="ti-close font-weight-bold mr-2"></i>
                                                                                            {{ trans('admin.remove_image') }}
                                                                                    </a>
                                                                                @else
                                                                                    @if (isset($this->companiesRowTwo[$index]['image']))
                                                                                        <img src="{{ '/storage/' . $this->companiesRowTwo[$index]['image'] }}"
                                                                                            class="mb-2"
                                                                                            width="60"></br>
                                                                                    @endif

                                                                                    <input type="file"
                                                                                        wire:model="companiesRowTwo.{{ $index }}.newImage">
                                                                                @endif
                                                                            </div>
                                                                            <input type="hidden" name="company_id" value="{{ $this->companiesRowTwo[$index]['id'] }}">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-5">
                                                                    <a wire:click="removeElementRowTwo('{{ $index }}')">
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

                                        </div> {{-- # companies-row-Two --}}
                                        
                                        <div class="row pt-3">
                                            <div class="col-md-12 text-center">
                                                <a wire:click="addElementRowTwo" class="btn mb-2 btn-secondary">
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
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('admin_src/js/default-assets/quill-init.js') }}"></script>
    <script type="text/javascript">
        document.addEventListener('livewire:load', () => {
            initQuillEditors((quill, fieldName, language) => {
                quill.on('text-change', function () {
                    let value = quill.root.innerHTML;
                    @this.set(`${fieldName}.${language}`, value);
                });
            });
        });
    </script>
@endpush