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

                                        <div class="row">
                                            <div class="col-md-6">
                                                <x-admin.multilanguage-input
                                                    :is-required="false"
                                                    :label="trans('admin.name')"
                                                    field-name="name"
                                                    live-wire-field="сurrentDirectionData.name"
                                                    :values="$сurrentDirectionData['name']"
                                                    />
                                            </div>
                                            <div class="col-md-4">
                                                <x-admin.multilanguage-input
                                                    :is-required="false"
                                                    :label="trans('admin.short_name')"
                                                    field-name="name"
                                                    live-wire-field="сurrentDirectionData.short_name"
                                                    :values="$сurrentDirectionData['short_name']"
                                                    />
                                            </div>
                                            <div class="col-md-2 checkbox-in-footer">
                                                <div class="checkbox">
                                                    <input 
                                                        type="checkbox" 
                                                        wire:model="сurrentDirectionData.in_footer"
                                                        id="in_footer" 
                                                        @if($сurrentDirectionData['in_footer']) checked @endif
                                                    >
                                                    <label for="in_footer" class="cr">{{ trans('admin.in_footer') }}</label>
                                                </div>
                                            </div>
                                        </div>

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
                                    <section class="mb-50 mt-30">
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

                                        <div class="form-group mt-2 mb-0">
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

                                        <div class="{{ ($sectionTwoData['is_image']) ? 'd-none' : '' }}">
                                            <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[2][text_two]"
                                            live-wire-field="sectionTwoData.text_two"
                                            :values="$sectionTwoData['text_two']"
                                            />
                                        </div>

                                        @if($sectionTwoData['is_image'])
                                            <div class="form-group mt-2 mb-3">
                                                <label for="">{{ trans('admin.image') }}</label></br>
                                                @if (isset($sectionTwoData['media']['temporaryImage']))
                                                    <img src="{{ $sectionTwoData['media']['temporaryImage'] }}"
                                                        width="60"><a
                                                        wire:click="deleteSectionImage(2)"
                                                        style="cursor: pointer;">
                                                        <i
                                                            class="ti-close font-weight-bold mr-2"></i>
                                                            {{ trans('admin.remove_image') }}
                                                    </a>
                                                @else
                                                    @if (isset($sectionTwoData['media']['image']))
                                                        <img src="{{ '/storage/' . $sectionTwoData['media']['image'] }}"
                                                            class="mb-2"
                                                            width="60"></br>
                                                    @endif

                                                    <input type="file"
                                                        wire:model="sectionTwoData.media.newImage">
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

                                                                <div class="col-md-7">
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

                                                                            <x-admin.multilanguage-text-area-rich
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

        window.addEventListener('infoDataFieldAdded', () => {
            initQuillEditors((quill, fieldName, language) => {
                quill.on('text-change', function () {
                    let value = quill.root.innerHTML;
                    @this.set(`${fieldName}.${language}`, value);
                });
            });
        });

    </script>
@endpush