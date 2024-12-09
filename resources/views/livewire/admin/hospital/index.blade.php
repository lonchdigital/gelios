<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h5 class="card-title mb-0">{{ trans('admin.hospitals_stationary') }}</h5>

                    {{-- <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary waves-effect waves-light float-right mb-3">
                        + Додати лікаря
                    </a> --}}
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

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

                        <div class="{{ ($sectionData['is_image']) ? 'd-none' : '' }}">
                            <x-admin.multilanguage-text-area-rich
                            :is-required="false"
                            :label="trans('admin.text')"
                            field-name="textBlock[1][text_two]"
                            live-wire-field="sectionData.text_two"
                            :values="$sectionData['text_two']"
                            />
                        </div>

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


                    <table class="table mt-1">
                        <thead>
                            <tr style="background-color: rgba(149, 149, 149, 0.2)">
                                <th>ID</th>
                                <th>{{ __('admin.title') }}</th>
                                <th style="text-align: right">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hospitals as $hospital)
                                <tr class="hover">
                                    <td>
                                        {{ $hospital->id }}
                                    </td>
                                    <td>
                                        {{ $hospital->name }}
                                    </td>
                                    <td>
                                        <div style="text-align: right">
                                            <a role="button"
                                                href="{{ route('hospitals.edit', ['hospital' => $hospital]) }}"
                                                class="btn btn-accent btn-xs">
                                                <i class="fa fa-edit text-info font-18"></i>
                                            </a>

                                            <a href="#" class="md-trigger mr-2" data-modal="modal-{{ $hospital->id }}">
                                                <i class="fa fa-trash text-danger font-18"></i>
                                            </a>
                                            <div class="md-modal md-effect-1" id="modal-{{ $hospital->id }}">
                                                <div class="md-content">
                                                    <h3 class="bg-main">{{ trans('admin.attention') }}</h3>
                                                    <p class="text-center mt-4">{{ trans('admin.delete') }} "{{ $hospital->name }}"?</p>
                                                    <div class="d-flex art-modal-buttons">
                                                        <a href="#" class="btn btn-primary md-close">{{ trans('admin.close') }}</a>
                                                        <button wire:click="removeHospitalFromDB('{{ $hospital->id }}')" class="btn btn-danger d-block">{{ trans('admin.delete') }}</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center mb-20">
                        <h6 class="card-title mb-0">{{ trans('admin.hospitals_stationary_list') }}</h6>

                        <a href="{{ route('hospitals.create') }}"
                            class="btn btn-primary waves-effect waves-light float-right mb-3">
                            + {{ trans('admin.add_hospital_stationary') }}
                        </a>
                    </div>

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
