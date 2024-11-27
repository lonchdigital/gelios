<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h5 class="card-title mb-0">{{ trans('admin.contacts') }}</h5>
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