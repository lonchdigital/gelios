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
                    <h4 class="card-head-title">{{ trans('admin.about_us') }}</h4>
                </div>

                <form wire:submit.prevent="save">

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
                                                            <x-admin.multilanguage-text-area
                                                                :is-required="false"
                                                                :label="trans('admin.description')"
                                                                field-name="meta.{{ $index }}.description"
                                                                live-wire-field="briefBlocks.{{ $index }}.description"
                                                                :values="$briefBlockItem['description']"
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

                    <section class="mb-50 mt-30">
                        <h6 class="card-title">{{ trans('admin.section_media') }}</h6>

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
                            field-name="textBlock[1][text]"
                            live-wire-field="sectionData.text"
                            :values="$sectionData['text']"
                        />

                        @if(!$sectionData['is_image'])
                            <div class="form-group mt-2 mb-0">
                                <label for="">YouTube Video</label>
                                <input 
                                        type="text"
                                        class="form-control"
                                        wire:model="sectionData.video"
                                    >
                            </div>
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

                    <hr>

                    <section class="mb-50">
                        <h6 class="card-title">{{ trans('admin.сertificates') }}</h6>
                        <div class="row" id="сertificates">

                            @if(isset($this->сertificates))
                                @foreach($this->сertificates as $index => $сertificateItem)

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
                                                                        wire:click="newPositionCertificates(-1, {{ $index }})">
                                                                        <i class="fa fa-sort-up"></i>
                                                                    </div>
                                                                @endif
                                                                {{ $сertificateItem['sort'] }}
                                                                @if (!$loop->last)
                                                                    <div style="cursor: pointer;"
                                                                        wire:click="newPositionCertificates(+1, {{ $index }})">
                                                                        <i class="fa fa-sort-desc"></i>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="form-group mt-2 mb-3">
                                                                <label for="">{{ trans('admin.image') }}</label></br>
                                                                @if (isset($this->сertificates[$index]['temporaryImage']))
                                                                    <img src="{{ $this->сertificates[$index]['temporaryImage'] }}"
                                                                        width="60"><a
                                                                        wire:click="deleteImageCertificates('{{ $index }}')"
                                                                        style="cursor: pointer;">
                                                                        <i
                                                                            class="ti-close font-weight-bold mr-2"></i>
                                                                            {{ trans('admin.remove_image') }}
                                                                    </a>
                                                                @else
                                                                    @if (isset($this->сertificates[$index]['image']))
                                                                        <img src="{{ '/storage/' . $this->сertificates[$index]['image'] }}"
                                                                            class="mb-2"
                                                                            width="60"></br>
                                                                    @endif

                                                                    <input type="file"
                                                                        wire:model="сertificates.{{ $index }}.newImage">
                                                                @endif
                                                            </div>

                                                            <input type="hidden" name="сertificate_id" value="{{ $this->сertificates[$index]['id'] }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <a wire:click="removeElementCertificates('{{ $index }}')">
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

                        </div> {{-- # Certificates --}}
                        
                        <div class="row pt-3">
                            <div class="col-md-12 text-center">
                                <a wire:click="addElementCertificates" class="btn mb-2 btn-secondary">
                                    <span class="ti-plus font-weight-bold"></span>
                                    {{ trans('admin.add') }}
                                </a>
                            </div>
                        </div>
                    </section>

                    <hr>

                    <section class="mb-50">
                        <h6 class="card-title">{{ trans('admin.photos') }}</h6>
                        <div class="row" id="photos">

                            @if(isset($this->photos))
                                @foreach($this->photos as $index => $photoItem)

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
                                                                        wire:click="newPositionPhotos(-1, {{ $index }})">
                                                                        <i class="fa fa-sort-up"></i>
                                                                    </div>
                                                                @endif
                                                                {{ $photoItem['sort'] }}
                                                                @if (!$loop->last)
                                                                    <div style="cursor: pointer;"
                                                                        wire:click="newPositionPhotos(+1, {{ $index }})">
                                                                        <i class="fa fa-sort-desc"></i>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="form-group mt-2 mb-3">
                                                                <label for="">{{ trans('admin.image') }}</label></br>
                                                                @if (isset($this->photos[$index]['temporaryImage']))
                                                                    <img src="{{ $this->photos[$index]['temporaryImage'] }}"
                                                                        width="60"><a
                                                                        wire:click="deleteImagePhotos('{{ $index }}')"
                                                                        style="cursor: pointer;">
                                                                        <i
                                                                            class="ti-close font-weight-bold mr-2"></i>
                                                                            {{ trans('admin.remove_image') }}
                                                                    </a>
                                                                @else
                                                                    @if (isset($this->photos[$index]['image']))
                                                                        <img src="{{ '/storage/' . $this->photos[$index]['image'] }}"
                                                                            class="mb-2"
                                                                            width="60"></br>
                                                                    @endif

                                                                    <input type="file"
                                                                        wire:model="photos.{{ $index }}.newImage">
                                                                @endif
                                                            </div>

                                                            <input type="hidden" name="photo_id" value="{{ $this->photos[$index]['id'] }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <a wire:click="removeElementPhotos('{{ $index }}')">
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

                        </div> {{-- # photos --}}
                        
                        <div class="row pt-3">
                            <div class="col-md-12 text-center">
                                <a wire:click="addElementPhotos" class="btn mb-2 btn-secondary">
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
