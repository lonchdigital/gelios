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
                                            live-wire-field="sectionData.title"
                                            :values="$sectionData['title']"
                                        />
                                    </section>

                                    <section class="mb-50 mt-30">
                                        <h6 class="card-title">{{ trans('admin.section_text') }}</h6>
                
                                        <div class="form-group mt-2 mb-0">
                
                                            <div class="new-checkbox art-text-block-switcher">
                                                <label class="switch mr-3">
                                                    <input type="checkbox" wire:model="textBlockOneData.is_reverse" id="is_reverse_1" @if($textBlockOneData['is_reverse']) checked @endif>
                                                    <span class="slider"></span>
                                                </label>
                                                <span>{{ trans('admin.show_left') }}</span>
                                            </div>
                
                                            <div class="checkbox d-inline">
                                                <input 
                                                    type="checkbox" 
                                                    wire:model="textBlockOneData.is_image"
                                                    wire:click="handleDisplayFields()"
                                                    id="is_image_1" 
                                                    @if($textBlockOneData['is_image']) checked @endif
                                                >
                                                <label for="is_image_1" class="cr">{{ trans('admin.is_image') }}</label>
                                            </div>
                                        </div>
                                        
                                        <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[1][text_one]"
                                            live-wire-field="textBlockOneData.text_one"
                                            :values="$textBlockOneData['text_one']"
                                        />

                                        <div class="{{ ($textBlockOneData['is_image']) ? 'd-none' : '' }}">
                                            <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.text')"
                                            field-name="textBlock[1][text_two]"
                                            live-wire-field="textBlockOneData.text_two"
                                            :values="$textBlockOneData['text_two']"
                                            />
                                        </div>
                
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