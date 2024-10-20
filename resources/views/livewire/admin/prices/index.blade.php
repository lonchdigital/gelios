<div class="row">
    <div class="col-12">
        <div class="card mb-30">
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between align-items-center mb-20">
                    <h5 class="card-title mb-0">{{ trans('admin.prices') }}</h5>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit.prevent="save">

                    <table class="table mt-1">
                        <thead>
                            <tr style="background-color: rgba(149, 149, 149, 0.2)">
                                <th>ID</th>
                                <th>Заголовок</th>
                                <th style="text-align: right">Дії</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tests as $test)
                                <tr class="hover">
                                    <td>
                                        {{ $test->id }}
                                    </td>
                                    <td>
                                        {{ $test->title }}
                                    </td>
                                    <td>
                                        <div style="text-align: right">
                                            <a role="button"
                                                href="{{ route('prices.test.edit', ['page' => $page, 'test' => $test]) }}"
                                                class="btn btn-accent btn-xs">
                                                <i class="fa fa-edit text-info font-18"></i>
                                            </a>

                                            <a href="#" class="md-trigger mr-2" data-modal="modal-{{ $test->id }}">
                                                <i class="fa fa-trash text-danger font-18"></i>
                                            </a>
                                            <div class="md-modal md-effect-1" id="modal-{{ $test->id }}">
                                                <div class="md-content">
                                                    <h3 class="bg-main">{{ trans('admin.attention') }}</h3>
                                                    <p class="text-center mt-4">{{ trans('admin.delete') }} "{{ $test->title }}"?</p>
                                                    <div class="d-flex art-modal-buttons">
                                                        <a href="#" class="btn btn-primary md-close">{{ trans('admin.close') }}</a>
                                                        <button wire:click="removeTestFromDB('{{ $test->id }}')" class="btn btn-danger d-block">{{ trans('admin.delete') }}</button>
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
                        <h6 class="card-title mb-0">{{ trans('admin.tests_list') }}</h6>

                        <a href="{{ route('prices.test.create', ['page' => $page]) }}"
                            class="btn btn-primary waves-effect waves-light float-right mb-3">
                            + {{ trans('admin.add_test') }}
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