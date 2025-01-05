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
                                    <h4 class="card-head-title">{{ trans('admin.directions')}}</h4>
                                </div>

                                <form wire:submit.prevent="save">

                                    <section class="mb-50 mt-30">
                                        <x-admin.multilanguage-input
                                            :is-required="false"
                                            :label="trans('admin.title')"
                                            field-name="title"
                                            live-wire-field="contentData.title"
                                            :values="$contentData['title']"
                                        />
                                        <x-admin.multilanguage-text-area-rich
                                            :is-required="false"
                                            :label="trans('admin.description')"
                                            field-name="description"
                                            live-wire-field="contentData.description"
                                            :values="$contentData['description']"
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
                });
            });
        });
    </script>
@endpush