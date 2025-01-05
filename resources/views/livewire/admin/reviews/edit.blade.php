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
                        @if(is_null($review))
                            {{ trans('admin.new_review') }}
                        @else
                            {{ trans('admin.edit_review') }}
                        @endif
                    </h4>
                </div>

                <form wire:submit.prevent="save">

                    <div class="new-checkbox art-text-block-switcher">
                        <label class="switch mr-3">
                            <input type="checkbox" wire:model="sectionData.published" @if($sectionData['published']) checked @endif>
                            <span class="slider"></span>
                        </label>
                        <span>{{ trans('admin.show_review') }}</span>
                    </div>

                    <section class="mb-50 mt-30">

                        <div wire:ignore class="mt-3">
                            <label>{{ trans('admin.doctors') }}</label>
                            <select id="doctors" class="js-doctors-multiple form-control" name="doctors[]" wire:model="reviewDoctors" multiple>
                                @foreach ($allDoctos as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div wire:ignore class="mt-3">
                            <label>{{ trans('admin.all_pages') }}</label>
                            <select id="pages" class="js-pages-multiple form-control" name="pages[]" wire:model="reviewPages" multiple>
                                @foreach ($allPages as $page)
                                    <option value="{{ $page->id }}">{{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div>

                    </section>

                    <section class="mb-50 mt-30">

                        <div class="form-group mt-2 mb-3">
                            <label for="">{{ trans('admin.image') }}</label></br>
                            @if (isset($sectionData['media']['temporaryImage']))
                                <img src="{{ $sectionData['media']['temporaryImage'] }}"
                                    width="60"><a
                                    wire:click="deleteReviewImage()"
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

                        <x-admin.multilanguage-input
                            :is-required="false"
                            :label="trans('admin.name')"
                            field-name="name"
                            live-wire-field="sectionData.name"
                            :values="$sectionData['name']"
                        />

                        <x-admin.multilanguage-text-area-rich
                            :is-required="false"
                            :label="trans('admin.text')"
                            field-name="text"
                            live-wire-field="sectionData.text"
                            :values="$sectionData['text']"
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

            // Handle doctors
            let reviewDoctors = $('#doctors').select2();
            reviewDoctors.val(@json($reviewDoctors)).trigger('change');
            reviewDoctors.on('change', function () {
                let selectedValues = $(this).val();
                @this.set('reviewDoctors', selectedValues);
            });

            // Handle pages
            let reviewPages = $('#pages').select2();
            reviewPages.val(@json($reviewPages)).trigger('change');
            reviewPages.on('change', function () {
                let selectedValues = $(this).val();
                @this.set('reviewPages', selectedValues);
            });

        });
    </script>
@endpush