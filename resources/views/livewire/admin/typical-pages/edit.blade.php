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
                                        <h6 class="card-title">{{ trans('admin.content') }}</h6>

                                        <x-admin.multilanguage-input
                                            :is-required="false"
                                            :label="trans('admin.title')"
                                            field-name="title"
                                            live-wire-field="contentData.title"
                                            :values="$contentData['title']"
                                        />
                                        <div class="form-group mt-2 mb-0">
                                            <label for="">Slug</label>
                                            <input 
                                                    type="text"
                                                    class="form-control"
                                                    wire:model="contentData.slug"
                                                >
                                        </div>
                                    </section>

                                    <hr>

                                    <table class="table mt-1">
                                        <thead>
                                            <tr style="background-color: rgba(149, 149, 149, 0.2)">
                                                <th>ID</th>
                                                <th>Тип</th>
                                                <th style="text-align: right">Дії</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($pageTextBlocks as $pageTextBlock)
                                                <tr class="hover">
                                                    <td>
                                                        {{ $pageTextBlock->id }}
                                                    </td>
                                                    <td>
                                                        {{ trans('admin.text_block') }}
                                                    </td>
                                                    <td>
                                                        <div style="text-align: right">
                                                            <a role="button"
                                                                href="{{ route('typical.page.block.edit', ['page' => $page, 'pageTextBlock' => $pageTextBlock]) }}"
                                                                class="btn btn-accent btn-xs">
                                                                <i class="fa fa-edit text-info font-18"></i>
                                                            </a>
                
                                                            <a href="#" class="md-trigger mr-2" data-modal="modal-{{ $pageTextBlock->id }}">
                                                                <i class="fa fa-trash text-danger font-18"></i>
                                                            </a>
                                                            <div class="md-modal md-effect-1" id="modal-{{ $pageTextBlock->id }}">
                                                                <div class="md-content">
                                                                    <h3 class="bg-main">{{ trans('admin.attention') }}</h3>
                                                                    <p class="text-center mt-4">{{ trans('admin.delete') }} "{{ trans('admin.text_block') }}"?</p>
                                                                    <div class="d-flex art-modal-buttons">
                                                                        <a href="#" class="btn btn-primary md-close">{{ trans('admin.close') }}</a>
                                                                        <button wire:click="removePageTextBlockFromDB('{{ $pageTextBlock->id }}')" class="btn btn-danger d-block">{{ trans('admin.delete') }}</button>
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
                                        <h6 class="card-title mb-0"></h6>
                
                                        <a href="{{ route('typical.page.block.create', ['page' => $page]) }}"
                                            class="btn btn-primary waves-effect waves-light float-right mb-3">
                                            + {{ trans('admin.add_page_block') }}
                                        </a>
                                    </div>

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