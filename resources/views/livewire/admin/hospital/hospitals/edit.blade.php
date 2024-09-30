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
                        @if(is_null($hospital))
                            {{ trans('admin.new_hospitals_stationary') }}
                        @else
                            {{ trans('admin.edit_hospitals_stationary') }}
                        @endif
                    </h4>
                </div>

                <form wire:submit.prevent="save">

                    <section class="mb-50 mt-30">
                        <x-admin.multilanguage-input
                            :is-required="false"
                            :label="trans('admin.title')"
                            field-name="name"
                            live-wire-field="sectionData.name"
                            :values="$sectionData['name']"
                        />
                    </section>
                    
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

                    <section class="mb-50">
                        <h6 class="card-title">{{ trans('admin.gallery') }}</h6>
                        <div class="row" id="gallery">

                            @if(isset($this->gallery))
                                @foreach($this->gallery as $index => $galleryItem)

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
                                                                        wire:click="newPositionGallery(-1, {{ $index }})">
                                                                        <i class="fa fa-sort-up"></i>
                                                                    </div>
                                                                @endif
                                                                {{ $galleryItem['sort'] }}
                                                                @if (!$loop->last)
                                                                    <div style="cursor: pointer;"
                                                                        wire:click="newPositionGallery(+1, {{ $index }})">
                                                                        <i class="fa fa-sort-desc"></i>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="form-group mt-2 mb-3">
                                                                <label for="">{{ trans('admin.image') }}</label></br>
                                                                @if (isset($this->gallery[$index]['temporaryImage']))
                                                                    <img src="{{ $this->gallery[$index]['temporaryImage'] }}"
                                                                        width="60"><a
                                                                        wire:click="deleteImageGallery('{{ $index }}')"
                                                                        style="cursor: pointer;">
                                                                        <i
                                                                            class="ti-close font-weight-bold mr-2"></i>
                                                                            {{ trans('admin.remove_image') }}
                                                                    </a>
                                                                @else
                                                                    @if (isset($this->gallery[$index]['image']))
                                                                        <img src="{{ '/storage/' . $this->gallery[$index]['image'] }}"
                                                                            class="mb-2"
                                                                            width="60"></br>
                                                                    @endif

                                                                    <input type="file"
                                                                        wire:model="gallery.{{ $index }}.newImage">
                                                                @endif
                                                            </div>
                                                            <input type="hidden" name="company_id" value="{{ $this->gallery[$index]['id'] }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <a wire:click="removeElementGallery('{{ $index }}')">
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

                        </div> {{-- # gallery --}}
                        
                        <div class="row pt-3">
                            <div class="col-md-12 text-center">
                                <a wire:click="addElementGallery" class="btn mb-2 btn-secondary">
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
