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
                        @if(is_null($contact))
                            {{ trans('admin.new_contact') }}
                        @else
                            {{ trans('admin.edit_contact') }}
                        @endif
                    </h4>
                </div>

                <form wire:submit.prevent="save">

                    <section class="mb-50 mt-30">

                        <div class="form-group mt-2 mb-3">
                            <label for="">{{ trans('admin.image') }}</label></br>
                            @if (isset($sectionData['media']['temporaryImage']))
                                <img src="{{ $sectionData['media']['temporaryImage'] }}"
                                    width="60"><a
                                    wire:click="deleteContactImage()"
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
                            :label="trans('admin.city')"
                            field-name="city"
                            live-wire-field="sectionData.city"
                            :values="$sectionData['city']"
                        />

                        <x-admin.multilanguage-input
                            :is-required="false"
                            :label="trans('admin.street')"
                            field-name="street"
                            live-wire-field="sectionData.street"
                            :values="$sectionData['street']"
                        />

                        <div class="form-group mt-2 mb-0">
                            <label for="">iframe</label>
                            <input 
                                    type="text"
                                    class="form-control"
                                    wire:model="sectionData.iframe"
                                >
                        </div>

                    </section>


                    <section class="mb-50">
                        <h6 class="card-title">{{ trans('admin.phones') }}</h6>
                        <div class="row" id="phones">

                            @if(isset($this->phones))
                                @foreach($this->phones as $index => $phone)

                                <div class="col-md-4 company-row pb-1 mb-4">
                                    <div>
                                        <div class="border border-secondary rounded p-3">
                                            <div class="row justify-content-between align-items-center">

                                                <div class="col-md-12 mb-3">
                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            <div class="col-md-1 service-left-side">
                                                                <div class="art-sort-arrows">
                                                                    @if ($loop->iteration !== 1)
                                                                        <div style="cursor: pointer;"
                                                                            wire:click="newPositionPhones(-1, {{ $index }})">
                                                                            <i class="fa fa-sort-up"></i>
                                                                        </div>
                                                                    @endif
                                                                    {{ $phone['sort'] }}
                                                                    @if (!$loop->last)
                                                                        <div style="cursor: pointer;"
                                                                            wire:click="newPositionPhones(+1, {{ $index }})">
                                                                            <i class="fa fa-sort-desc"></i>
                                                                        </div>
                                                                    @endif
                                                                </div>
                
                                                            </div>

                                                            <div class="">
                                                                <div class="form-group mb-1">
                                                                    <label for="meta_title_ua">{{ trans('admin.phone') }}</label>
                                                                    <input type="text" wire:model="phones.{{ $index }}.item" name="phones.{{ $index }}.item" value="{{ $phone['item'] }}" class="form-control">
                                                                </div>
                                                            </div>
                
                                                            <input type="hidden" name="phone_id" value="{{ $this->phones[$index]['id'] }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <a wire:click="removeElementPhones('{{ $index }}')">
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

                        </div>
                        
                        <div class="row pt-3">
                            <div class="col-md-12 text-center">
                                <a wire:click="addElementPhones" class="btn mb-2 btn-secondary">
                                    <span class="ti-plus font-weight-bold"></span>
                                    {{ trans('admin.add') }}
                                </a>
                            </div>
                        </div>
                    </section>

                    <section class="mb-50">
                        <h6 class="card-title">{{ trans('admin.emails') }}</h6>
                        <div class="row" id="emails">

                            @if(isset($this->emails))
                                @foreach($this->emails as $index => $email)

                                <div class="col-md-4 company-row pb-1 mb-4">
                                    <div>
                                        <div class="border border-secondary rounded p-3">
                                            <div class="row justify-content-between align-items-center">

                                                <div class="col-md-12 mb-3">
                                                    <div class="row">
                                                        <div class="col-md-12">

                                                            <div class="col-md-1 service-left-side">
                                                                <div class="art-sort-arrows">
                                                                    @if ($loop->iteration !== 1)
                                                                        <div style="cursor: pointer;"
                                                                            wire:click="newPositionEmails(-1, {{ $index }})">
                                                                            <i class="fa fa-sort-up"></i>
                                                                        </div>
                                                                    @endif
                                                                    {{ $email['sort'] }}
                                                                    @if (!$loop->last)
                                                                        <div style="cursor: pointer;"
                                                                            wire:click="newPositionEmails(+1, {{ $index }})">
                                                                            <i class="fa fa-sort-desc"></i>
                                                                        </div>
                                                                    @endif
                                                                </div>
                
                                                            </div>

                                                            <div class="">
                                                                <div class="form-group mb-1">
                                                                    <label for="meta_title_ua">{{ trans('admin.email') }}</label>
                                                                    <input type="text" wire:model="emails.{{ $index }}.item" name="emails.{{ $index }}.item" value="{{ $email['item'] }}" class="form-control">
                                                                </div>
                                                            </div>
                
                                                            <input type="hidden" name="email_id" value="{{ $this->emails[$index]['id'] }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                    <a wire:click="removeElementEmails('{{ $index }}')">
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

                        </div>
                        
                        <div class="row pt-3">
                            <div class="col-md-12 text-center">
                                <a wire:click="addElementEmails" class="btn mb-2 btn-secondary">
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