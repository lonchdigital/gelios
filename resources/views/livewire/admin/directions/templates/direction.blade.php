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
                                    <h4 class="card-head-title">{{ $direction->name }}</h4>
                                </div>

                                <form wire:submit.prevent="save">

                                    <section class="mb-50 mt-30">

                                        <x-admin.multilanguage-input
                                        :is-required="false"
                                        :label="trans('admin.name')"
                                        field-name="name"
                                        live-wire-field="сurrentDirectionData.name"
                                        :values="$сurrentDirectionData['name']"
                                        />

                                        <div class="form-group mt-2 mb-0">
                                            <label for="">slug</label>
                                            <input 
                                                    type="text"
                                                    class="form-control"
                                                    wire:model="сurrentDirectionData.slug"
                                                >
                
                                            @error('сurrentDirectionData.slug')
                                                <div class="mt-1 text-danger ajaxError">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </section>
                                    
                                    <section class="mb-50">

                                        <div wire:ignore>
                                            <label>{{ trans('admin.belonging') }}</label>
                                            <select class="js-parent-cat form-control" id="status-select" wire:model="directionParent" name="parent_id">
                                                <option value="{{ null }}">- {{ trans('admin.not_chosen') }} -</option>
                                                @foreach($allDirections as $cat)
                                                    @include('admin.directions.partials.direction-option', ['direction' => $cat, 'depth' => 0, 'parent_id' => $direction->parent_id])
                                                @endforeach
                                            </select>
                                        </div>

                                        <div wire:ignore class="mt-3">
                                            <label>{{ trans('admin.offices') }}</label>
                                            <select id="offices" class="js-direction-contacts-multiple form-control" name="offices[]" wire:model="directionContacts" multiple>
                                                @foreach ($allDirectionContacts as $directionContactItem)
                                                    <option value="{{ $directionContactItem->id }}">{{ $directionContactItem->city . ' ' . $directionContactItem->street }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </section>

                                    <hr>

                                    {{-- Section 1 --}}
                                    <section class="mb-50">
                                        <h6 class="card-title">{{ trans('admin.section_one') }}</h6>

                                        <div class="form-group mt-2 mb-0">

                                            <div class="new-checkbox art-text-block-switcher">
                                                <label class="switch mr-3">
                                                    <input type="checkbox" wire:model="sectionOneData.is_reverse" id="is_reverse_1" @if($sectionOneData['is_reverse']) checked @endif>
                                                    <span class="slider"></span>
                                                </label>
                                                <span>{{ trans('admin.show_left') }}</span>
                                            </div>

                                            <div class="checkbox d-inline">
                                                <input 
                                                    type="checkbox" 
                                                    wire:model="sectionOneData.is_image"
                                                    wire:click="handleDisplayFields(1)"
                                                    id="is_image_1" 
                                                    @if($sectionOneData['is_image']) checked @endif
                                                >
                                                <label for="is_image_1" class="cr">{{ trans('admin.is_image') }}</label>
                                            </div>
                                        </div>
                                        
                                        <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[1][text_one]"
                                            live-wire-field="sectionOneData.text_one"
                                            :values="$sectionOneData['text_one']"
                                        />

                                        <div class="{{ ($sectionOneData['is_image']) ? 'd-none' : '' }}">
                                            <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[1][text_two]"
                                            live-wire-field="sectionOneData.text_two"
                                            :values="$sectionOneData['text_two']"
                                            />
                                        </div>

                                        @if($sectionOneData['is_image'])
                                            <div class="form-group mt-2 mb-3">
                                                <label for="">{{ trans('admin.image') }}</label></br>
                                                @if (isset($sectionOneData['media']['temporaryImage']))
                                                    <img src="{{ $sectionOneData['media']['temporaryImage'] }}"
                                                        width="60"><a
                                                        wire:click="deleteSectionImage(1)"
                                                        style="cursor: pointer;">
                                                        <i
                                                            class="ti-close font-weight-bold mr-2"></i>
                                                            {{ trans('admin.remove_image') }}
                                                    </a>
                                                @else
                                                    @if (isset($sectionOneData['media']['image']))
                                                        <img src="{{ '/storage/' . $sectionOneData['media']['image'] }}"
                                                            class="mb-2"
                                                            width="60"></br>
                                                    @endif

                                                    <input type="file"
                                                        wire:model="sectionOneData.media.newImage">
                                                @endif
                                            </div>
                                        @endif

                                    </section>

                                    <hr>

                                    {{-- Section 2 --}}
                                    <section class="mb-50 mt-30">
                                        <h6 class="card-title">{{ trans('admin.section_two') }}</h6>

                                        {{-- Hidden because we do not need it for this section --}}
                                        <div class="form-group mt-2 mb-0 d-none">

                                           <div class="new-checkbox art-text-block-switcher">
                                                <label class="switch mr-3">
                                                    <input type="checkbox" wire:model="sectionTwoData.is_reverse" id="is_reverse_2" @if($sectionTwoData['is_reverse']) checked @endif>
                                                    <span class="slider"></span>
                                                </label>
                                                <span>{{ trans('admin.show_left') }}</span>
                                            </div> 

                                            <div class="checkbox d-inline">
                                                <input 
                                                    type="checkbox" 
                                                    wire:model="sectionTwoData.is_image"
                                                    wire:click="handleDisplayFields(2)"
                                                    id="is_image_2" 
                                                    @if($sectionTwoData['is_image']) checked @endif
                                                >
                                                <label for="is_image_2" class="cr">{{ trans('admin.is_image') }}</label>
                                            </div>
                                        </div>
                                        
                                        <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[2][text_one]"
                                            live-wire-field="sectionTwoData.text_one"
                                            :values="$sectionTwoData['text_one']"
                                        />

                                    </section>

                                    <hr>

                                    {{-- Section 3 --}}
                                    <section class="mb-50 mt-30">
                                        <h6 class="card-title">{{ trans('admin.section_three') }}</h6>

                                        <div class="form-group mt-2 mb-0">

                                            <div class="new-checkbox art-text-block-switcher">
                                                <label class="switch mr-3">
                                                    <input type="checkbox" wire:model="sectionThreeData.is_reverse" id="is_reverse_3" @if($sectionThreeData['is_reverse']) checked @endif>
                                                    <span class="slider"></span>
                                                </label>
                                                <span>{{ trans('admin.show_left') }}</span>
                                            </div>

                                            <div class="checkbox d-inline">
                                                <input 
                                                    type="checkbox" 
                                                    wire:model="sectionThreeData.is_image"
                                                    wire:click="handleDisplayFields(3)"
                                                    id="is_image_3" 
                                                    @if($sectionThreeData['is_image']) checked @endif
                                                >
                                                <label for="is_image_3" class="cr">{{ trans('admin.is_image') }}</label>
                                            </div>
                                        </div>
                                        
                                        <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[3][text_one]"
                                            live-wire-field="sectionThreeData.text_one"
                                            :values="$sectionThreeData['text_one']"
                                        />

                                        <div class="{{ ($sectionThreeData['is_image']) ? 'd-none' : '' }}">
                                            <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[3][text_two]"
                                            live-wire-field="sectionThreeData.text_two"
                                            :values="$sectionThreeData['text_two']"
                                            />
                                        </div>

                                        @if($sectionThreeData['is_image'])
                                            <div class="form-group mt-2 mb-3">
                                                <label for="">{{ trans('admin.image') }}</label></br>
                                                @if (isset($sectionThreeData['media']['temporaryImage']))
                                                    <img src="{{ $sectionThreeData['media']['temporaryImage'] }}"
                                                        width="60"><a
                                                        wire:click="deleteSectionImage(3)"
                                                        style="cursor: pointer;">
                                                        <i
                                                            class="ti-close font-weight-bold mr-2"></i>
                                                            {{ trans('admin.remove_image') }}
                                                    </a>
                                                @else
                                                    @if (isset($sectionThreeData['media']['image']))
                                                        <img src="{{ '/storage/' . $sectionThreeData['media']['image'] }}"
                                                            class="mb-2"
                                                            width="60"></br>
                                                    @endif

                                                    <input type="file"
                                                        wire:model="sectionThreeData.media.newImage">
                                                @endif
                                            </div>
                                        @endif

                                        
                                        <div class="form-group mt-2 mb-0">
                                            <label for="">{{ trans('admin.link') }}</label>
                                            <input 
                                                    type="text"
                                                    class="form-control"
                                                    wire:model="sectionThreeData.button_one_url"
                                                >
                
                                            @error('sectionThreeData.button_one_url')
                                                <div class="mt-1 text-danger ajaxError">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </section>

                                    <hr>

                                    {{-- Section 4 --}}
                                    <section class="mb-50 mt-30">
                                        <h6 class="card-title">{{ trans('admin.section_four') }}</h6>

                                        <div class="form-group mt-2 mb-0">

                                            <div class="new-checkbox art-text-block-switcher">
                                                <label class="switch mr-3">
                                                    <input type="checkbox" wire:model="sectionFourData.is_reverse" id="is_reverse_4" @if($sectionFourData['is_reverse']) checked @endif>
                                                    <span class="slider"></span>
                                                </label>
                                                <span>{{ trans('admin.show_left') }}</span>
                                            </div>

                                            <div class="checkbox d-inline">
                                                <input 
                                                    type="checkbox" 
                                                    wire:model="sectionFourData.is_image"
                                                    wire:click="handleDisplayFields(4)"
                                                    id="is_image_4" 
                                                    @if($sectionFourData['is_image']) checked @endif
                                                >
                                                <label for="is_image_4" class="cr">{{ trans('admin.is_image') }}</label>
                                            </div>
                                        </div>
                                        
                                        <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[4][text_one]"
                                            live-wire-field="sectionFourData.text_one"
                                            :values="$sectionFourData['text_one']"
                                        />

                                        <div class="{{ ($sectionFourData['is_image']) ? 'd-none' : '' }}">
                                            <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[4][text_two]"
                                            live-wire-field="sectionFourData.text_two"
                                            :values="$sectionFourData['text_two']"
                                            />
                                        </div>

                                        @if($sectionFourData['is_image'])
                                            <div class="form-group mt-2 mb-3">
                                                <label for="">{{ trans('admin.image') }}</label></br>
                                                @if (isset($sectionFourData['media']['temporaryImage']))
                                                    <img src="{{ $sectionFourData['media']['temporaryImage'] }}"
                                                        width="60"><a
                                                        wire:click="deleteSectionImage(4)"
                                                        style="cursor: pointer;">
                                                        <i
                                                            class="ti-close font-weight-bold mr-2"></i>
                                                            {{ trans('admin.remove_image') }}
                                                    </a>
                                                @else
                                                    @if (isset($sectionFourData['media']['image']))
                                                        <img src="{{ '/storage/' . $sectionFourData['media']['image'] }}"
                                                            class="mb-2"
                                                            width="60"></br>
                                                    @endif

                                                    <input type="file"
                                                        wire:model="sectionFourData.media.newImage">
                                                @endif
                                            </div>
                                        @endif

                                    </section>

                                    <hr>

                                    {{-- Section 5 --}}
                                    <section class="mb-50 mt-30">
                                        <h6 class="card-title">{{ trans('admin.section_five') }}</h6>

                                        <div class="form-group mt-2 mb-0">

                                            <div class="new-checkbox art-text-block-switcher">
                                                <label class="switch mr-3">
                                                    <input type="checkbox" wire:model="sectionFiveData.is_reverse" id="is_reverse_5" @if($sectionFiveData['is_reverse']) checked @endif>
                                                    <span class="slider"></span>
                                                </label>
                                                <span>{{ trans('admin.show_left') }}</span>
                                            </div>

                                            <div class="checkbox d-inline">
                                                <input 
                                                    type="checkbox" 
                                                    wire:model="sectionFiveData.is_image"
                                                    wire:click="handleDisplayFields(5)"
                                                    id="is_image_5" 
                                                    @if($sectionFiveData['is_image']) checked @endif
                                                >
                                                <label for="is_image_5" class="cr">{{ trans('admin.is_image') }}</label>
                                            </div>
                                        </div>
                                        
                                        <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[5][text_one]"
                                            live-wire-field="sectionFiveData.text_one"
                                            :values="$sectionFiveData['text_one']"
                                        />

                                        <div class="{{ ($sectionFiveData['is_image']) ? 'd-none' : '' }}">
                                            <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[5][text_two]"
                                            live-wire-field="sectionFiveData.text_two"
                                            :values="$sectionFiveData['text_two']"
                                            />
                                        </div>

                                        @if($sectionFiveData['is_image'])
                                            <div class="form-group mt-2 mb-3">
                                                <label for="">{{ trans('admin.image') }}</label></br>
                                                @if (isset($sectionFiveData['media']['temporaryImage']))
                                                    <img src="{{ $sectionFiveData['media']['temporaryImage'] }}"
                                                        width="60"><a
                                                        wire:click="deleteSectionImage(5)"
                                                        style="cursor: pointer;">
                                                        <i
                                                            class="ti-close font-weight-bold mr-2"></i>
                                                            {{ trans('admin.remove_image') }}
                                                    </a>
                                                @else
                                                    @if (isset($sectionFiveData['media']['image']))
                                                        <img src="{{ '/storage/' . $sectionFiveData['media']['image'] }}"
                                                            class="mb-2"
                                                            width="60"></br>
                                                    @endif

                                                    <input type="file"
                                                        wire:model="sectionFiveData.media.newImage">
                                                @endif
                                            </div>
                                        @endif

                                    </section>

                                    <hr>

                                    <section class="mb-50 mt-30 art-services-section ">
                                        <h6 class="card-title">{{ trans('admin.prices') }}</h6>

                                        @if(isset($directionPrices))
                                            @foreach($directionPrices as $index => $directionPrice)

                                                <div class="">
                                                    <div class="row justify-content-between align-items-center">

                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-1 service-left-side">
                                                                    <div class="art-sort-arrows">
                                                                        @if ($loop->iteration !== 1)
                                                                            <div style="cursor: pointer;"
                                                                                wire:click="newPositionDirectionPrices(-1, {{ $index }})">
                                                                                <i class="fa fa-sort-up"></i>
                                                                            </div>
                                                                        @endif
                                                                        {{ $directionPrice['sort'] }}
                                                                        @if (!$loop->last)
                                                                            <div style="cursor: pointer;"
                                                                                wire:click="newPositionDirectionPrices(+1, {{ $index }})">
                                                                                <i class="fa fa-sort-desc"></i>
                                                                            </div>
                                                                        @endif
                                                                    </div>

                                                                    <div class="art-remove">
                                                                        <a wire:click="removeElementDirectionPrices('{{ $index }}')">
                                                                            <i class="ti-close font-weight-bold mr-2"></i>
                                                                        </a>
                                                                    </div>
                                                                    
                                                                </div>

                                                                <div class="col-md-9">
                                                                    <x-admin.multilanguage-input
                                                                        :is-required="false"
                                                                        :label="trans('admin.service')"
                                                                        field-name="directionPrices.{{ $index }}.service"
                                                                        live-wire-field="directionPrices.{{ $index }}.service"
                                                                        :values="$directionPrice['service']"
                                                                    />
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group mb-1">
                                                                        <label for="meta_title_ua">{{ trans('admin.price') }}</label>
                                                                        <input type="number" wire:model="directionPrices.{{ $index }}.price" name="directionPrices.{{ $index }}.price" value="{{ $directionPrice['price'] }}" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-2">
                                                                    <div class="form-group mb-1">
                                                                        <label for="">{{ trans('admin.free') }}</label>
                                                                        <input 
                                                                            class="form-control art-price-checkbox"
                                                                            type="checkbox" 
                                                                            wire:model="directionPrices.{{ $index }}.is_free"
                                                                            @if($directionPrice['is_free']) checked @endif
                                                                        >
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="direction_price_id" value="{{ $this->directionPrices[$index]['id'] }}">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                
                                            @endforeach
                                        @endif

                                        <div class="row pt-3">
                                            <div class="col-md-12 text-center">
                                                <a wire:click="addElementDirectionPrices" class="btn mb-2 btn-secondary">
                                                    <span class="ti-plus font-weight-bold"></span>
                                                    {{ trans('admin.add') }}
                                                </a>
                                            </div>
                                        </div>

                                    </section>

                                    <hr>

                                    <section class="mb-50">
                                        <h6 class="card-title">{{ trans('admin.info_block') }}</h6>
                                        <div class="row" id="companies-row-one">
                
                                            @if(isset($infoData))
                                                @foreach($infoData as $index => $infoDataItem)
                
                                                <div class="col-md-4 company-row pb-1 mb-4">
                                                    <div>
                                                        <div class="border border-secondary rounded p-3">
                                                            <div class="row justify-content-between align-items-center">
                
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                
                                                                            <x-admin.multilanguage-input
                                                                                :is-required="false"
                                                                                :label="trans('admin.title')"
                                                                                field-name="infoData.{{ $index }}.title"
                                                                                live-wire-field="infoData.{{ $index }}.title"
                                                                                :values="$infoDataItem['title']"
                                                                            />

                                                                            <x-admin.multilanguage-text-area
                                                                                :is-required="false"
                                                                                :label="trans('admin.description')"
                                                                                field-name="infoData.{{ $index }}.description"
                                                                                live-wire-field="infoData.{{ $index }}.description"
                                                                                :values="$infoDataItem['description']"
                                                                            />
                              
                                                                            <input type="hidden" name="direction_info_data_id" value="{{ $infoData[$index]['id'] }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                
                                                                <div class="col-md-5">
                                                                    <a wire:click="removeElementDirectionInfo('{{ $index }}')">
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
                                                <a wire:click="addElementDirectionInfo" class="btn mb-2 btn-secondary">
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
                                        
                                    <button type="submit" class="btn btn-primary mr-2 mb-3">{{ trans('admin.save') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="pagination-wrapper d-flex justify-content-center mt-4 mb-5">
            {{-- {{ $this->faqs->links('vendor.pagination.default') }} --}}
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



            // Handle directionParent
            let parentCat = $('.js-parent-cat').select2();
            parentCat.val(@json($directionParent)).trigger('change');
            parentCat.on('change', function () {
                let selectedValue = $(this).val();
                @this.set('directionParent', selectedValue);
            });

            // Handle directionContacts
            let directionContacts = $('.js-direction-contacts-multiple').select2();
            directionContacts.val(@json($directionContacts)).trigger('change');
            directionContacts.on('change', function () {
                let selectedValues = $(this).val();
                @this.set('directionContacts', selectedValues);
            });

        });
    </script>
@endpush