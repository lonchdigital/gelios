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
                    @if(is_null($page))
                        <h4 class="card-head-title">{{ trans('admin.one_center') }}</h4>
                    @else
                        <h4 class="card-head-title">{{ $page->title }}</h4>
                    @endif
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

                        <div class="form-group mt-2 mb-0">
                            <label for="">slug</label>
                            <input 
                                    type="text"
                                    class="form-control"
                                    wire:model="pageData.slug"
                                >

                            @error('pageData.slug')
                                <div class="mt-1 text-danger ajaxError">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </section>

                    <hr>

                    <section class="mb-50">
                        <h6 class="card-title">{{ trans('admin.slides') }}</h6>
                        <div class="row" id="slides">

                            @if(isset($this->slides))
                                @foreach($this->slides as $index => $slideItem)

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
                                                                        wire:click="newPositionSlides(-1, {{ $index }})">
                                                                        <i class="fa fa-sort-up"></i>
                                                                    </div>
                                                                @endif
                                                                {{ $slideItem['sort'] }}
                                                                @if (!$loop->last)
                                                                    <div style="cursor: pointer;"
                                                                        wire:click="newPositionSlides(+1, {{ $index }})">
                                                                        <i class="fa fa-sort-desc"></i>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="form-group mt-2 mb-3">
                                                                <label for="">{{ trans('admin.image') }}</label></br>
                                                                @if (isset($this->slides[$index]['temporaryImage']))
                                                                    <img src="{{ $this->slides[$index]['temporaryImage'] }}"
                                                                        width="60"><a
                                                                        wire:click="deleteImageSlides('{{ $index }}')"
                                                                        style="cursor: pointer;">
                                                                        <i
                                                                            class="ti-close font-weight-bold mr-2"></i>
                                                                            {{ trans('admin.remove_image') }}
                                                                    </a>
                                                                @else
                                                                    @if (isset($this->slides[$index]['image']))
                                                                        <img src="{{ '/storage/' . $this->slides[$index]['image'] }}"
                                                                            class="mb-2"
                                                                            width="60"></br>
                                                                    @endif

                                                                    <input type="file"
                                                                        wire:model="slides.{{ $index }}.newImage">
                                                                @endif
                                                            </div>

                                                            <x-admin.multilanguage-input
                                                                :is-required="false"
                                                                :label="trans('admin.title')"
                                                                field-name="meta.{{ $index }}.title"
                                                                live-wire-field="slides.{{ $index }}.title"
                                                                :values="$slideItem['title']"
                                                            />
                                                            <x-admin.multilanguage-text-area
                                                                :is-required="false"
                                                                :label="trans('admin.description')"
                                                                field-name="meta.{{ $index }}.description"
                                                                live-wire-field="slides.{{ $index }}.description"
                                                                :values="$slideItem['description']"
                                                            />

                                                            <input type="hidden" name="slide_id" value="{{ $this->slides[$index]['id'] }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <a wire:click="removeElementSlides('{{ $index }}')">
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

                        </div> {{-- # slides --}}
                        
                        <div class="row pt-3">
                            <div class="col-md-12 text-center">
                                <a wire:click="addElementSlides" class="btn mb-2 btn-secondary">
                                    <span class="ti-plus font-weight-bold"></span>
                                    {{ trans('admin.add') }}
                                </a>
                            </div>
                        </div>
                    </section>

                    <hr>

                    <section class="mb-50">
                        <h6 class="card-title">{{ trans('admin.briefBlocks') }}</h6>
                        <div class="row" id="briefBlocks">

                            @if(isset($this->briefBlocks))
                                @foreach($this->briefBlocks as $index => $briefBlockItem)

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
                                                                        wire:click="newPositionBriefBlocks(-1, {{ $index }})">
                                                                        <i class="fa fa-sort-up"></i>
                                                                    </div>
                                                                @endif
                                                                {{ $briefBlockItem['sort'] }}
                                                                @if (!$loop->last)
                                                                    <div style="cursor: pointer;"
                                                                        wire:click="newPositionBriefBlocks(+1, {{ $index }})">
                                                                        <i class="fa fa-sort-desc"></i>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="form-group mt-2 mb-3">
                                                                <label for="">{{ trans('admin.image') }}</label></br>
                                                                @if (isset($this->briefBlocks[$index]['temporaryImage']))
                                                                    <img src="{{ $this->briefBlocks[$index]['temporaryImage'] }}"
                                                                        width="60"><a
                                                                        wire:click="deleteImageBriefBlocks('{{ $index }}')"
                                                                        style="cursor: pointer;">
                                                                        <i
                                                                            class="ti-close font-weight-bold mr-2"></i>
                                                                            {{ trans('admin.remove_image') }}
                                                                    </a>
                                                                @else
                                                                    @if (isset($this->briefBlocks[$index]['image']))
                                                                        <img src="{{ '/storage/' . $this->briefBlocks[$index]['image'] }}"
                                                                            class="mb-2"
                                                                            width="60"></br>
                                                                    @endif

                                                                    <input type="file"
                                                                        wire:model="briefBlocks.{{ $index }}.newImage">
                                                                @endif
                                                            </div>

                                                            <x-admin.multilanguage-input
                                                                :is-required="false"
                                                                :label="trans('admin.title')"
                                                                field-name="meta.{{ $index }}.title"
                                                                live-wire-field="briefBlocks.{{ $index }}.title"
                                                                :values="$briefBlockItem['title']"
                                                            />

                                                            <input type="hidden" name="brief_block_id" value="{{ $this->briefBlocks[$index]['id'] }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <a wire:click="removeElementBriefBlocks('{{ $index }}')">
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

                        </div> {{-- # briefBlocks --}}
                        
                        <div class="row pt-3">
                            <div class="col-md-12 text-center">
                                <a wire:click="addElementBriefBlocks" class="btn mb-2 btn-secondary">
                                    <span class="ti-plus font-weight-bold"></span>
                                    {{ trans('admin.add') }}
                                </a>
                            </div>
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

                    <section class="mb-50 mt-30">
                        
                        <div class="form-group">
                            <label for="video">video (MP4)</label>
                            <input type="file" class="form-control" wire:model="pageData.media.new_video_file" accept="video/mp4">

                            @if(!is_null($page))
                                <div class="mt-2">
                                    <span class="video-string">{{ $page->video_file }}</span>
                                    {{-- @if($page->video_file)
                                        <button type="button" class="btn btn-danger ml-5" id="delete-video-button">{{ trans('admin.delete_video') }}</button>
                                    @endif
                                    <input type="hidden" name="delete_video" id="delete-video-input" value="0"> --}}
                                </div>
                            @endif

                            @error('pageData.video_file')
                                <div class="mt-1 text-danger ajaxError">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

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