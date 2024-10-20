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
                        @if(is_null($pageTextBlock))
                            {{ trans('admin.new_text_page_block') }}
                        @else
                            {{ trans('admin.edit_text_page_block') }}
                        @endif
                    </h4>
                </div>

                <form wire:submit.prevent="save">
                    
                    <section class="mb-50 mt-30">
                        <h6 class="card-title">{{ trans('admin.section_text') }}</h6>

                        <div class="form-group mt-2 mb-0">

                            <div class="new-checkbox art-text-block-switcher">
                                <label class="switch mr-3">
                                    <input type="checkbox" wire:model="sectionData.is_reverse" id="is_reverse_1" @if($sectionData['is_reverse']) checked @endif>
                                    <span class="slider"></span>
                                </label>
                                <span>{{ trans('admin.show_left') }}</span>
                            </div>

                            <div class="checkbox d-inline">
                                <input 
                                    type="checkbox" 
                                    wire:model="sectionData.is_image"
                                    wire:click="handleDisplayFields()"
                                    id="is_image_1" 
                                    @if($sectionData['is_image']) checked @endif
                                >
                                <label for="is_image_1" class="cr">{{ trans('admin.is_image') }}</label>
                            </div>
                        </div>
                        
                        <x-admin.multilanguage-text-area-rich
                            :is-required="false"
                            :label="trans('admin.text')"
                            field-name="textBlock[1][text_one]"
                            live-wire-field="sectionData.text_one"
                            :values="$sectionData['text_one']"
                        />

                        @if(!$sectionData['is_image'])
                            <x-admin.multilanguage-text-area-rich
                            :is-required="false"
                            :label="trans('admin.text')"
                            field-name="textBlock[1][text_two]"
                            live-wire-field="sectionData.text_two"
                            :values="$sectionData['text_two']"
                            />
                        @endif

                        @if($sectionData['is_image'])
                            <div class="form-group mt-2 mb-3">
                                <label for="">{{ trans('admin.image') }}</label></br>
                                @if (isset($sectionData['media']['temporaryImage']))
                                    <img src="{{ $sectionData['media']['temporaryImage'] }}"
                                        width="60"><a
                                        wire:click="deleteSectionImage()"
                                        style="cursor: pointer;">
                                        <i
                                            class="ti-close font-weight-bold mr-2"></i>
                                            {{ trans('admin.remove_image') }}
                                    </a>
                                @else
                                    @if (isset($sectionData['media']['image']))
                                        <img src="{{ '/storage/' . $sectionData['media']['image'] }}"
                                            class="mb-2"
                                            width="60"></br>
                                    @endif

                                    <input type="file"
                                        wire:model="sectionData.media.newImage">
                                @endif
                            </div>
                        @endif

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