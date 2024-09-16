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

                                        @if(!$sectionOneData['is_image'])
                                            <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[1][text_two]"
                                            live-wire-field="sectionOneData.text_two"
                                            :values="$sectionOneData['text_two']"
                                            />
                                        @endif

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

                                        @if(!$sectionTwoData['is_image'])
                                            <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[2][text_two]"
                                            live-wire-field="sectionTwoData.text_two"
                                            :values="$sectionTwoData['text_two']"
                                            />
                                        @endif

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

                                        @if(!$sectionThreeData['is_image'])
                                            <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[3][text_two]"
                                            live-wire-field="sectionThreeData.text_two"
                                            :values="$sectionThreeData['text_two']"
                                            />
                                        @endif

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
