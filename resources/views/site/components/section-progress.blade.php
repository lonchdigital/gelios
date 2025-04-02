<section class="section-progress text-white mb-24">
    <div class="container">
        <div class="row flex-column flex-lg-row">
            <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                <div class="section-progress--item position-relative h-100 rounded overflow-hidden">
                    <div class="wrap-img">
                        @if(!empty($page->pageBlocks->where('block', $block)->where('key', 'image')->first()->image))
                            <img class="bg-down" src="{{ $page->pageBlocks->where('block', $block)->where('key', 'image')->first()->imageUrl }}" alt="img">
                        @else
                            <img class="bg-down" src="{{ asset('static_images/img-251.jpeg') }}" alt="img">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="row">
                    <div class="col-6 mb-3 mb-sm-4 mb-lg-5">
                        <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                            <div class="quantity h2 font-m font-weight-bolder mb-2">
                                {!! $page->pageBlocks->where('block', $block)->where('key', 'first')->first()->title ?? '2&nbsp;640' !!}
                            </div>
                            <div class="h5">
                                {!! $page->pageBlocks->where('block', $block)->where('key', 'first')->first()->description ?? 'Проведено операцій' !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-3 mb-sm-4 mb-lg-5">
                        <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                            <div class="quantity h2 font-m font-weight-bolder mb-2">
                                {!! $page->pageBlocks->where('block', $block)->where('key', 'second')->first()->title ?? '14' !!}
                            </div>
                            <div class="h5">
                                {!! $page->pageBlocks->where('block', $block)->where('key', 'second')->first()->description ?? 'Років досвіду' !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                            <div class="quantity h2 font-m font-weight-bolder mb-2">
                                {!! $page->pageBlocks->where('block', $block)->where('key', 'third')->first()->title ?? '24/7' !!}
                            </div>
                            <div class="h5">
                                {!! $page->pageBlocks->where('block', $block)->where('key', 'third')->first()->description ?? 'Ми поряд' !!}
                                </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="section-progress--item item-small bg-blue p-2 p-lg-3 p-xl-6 rounded">
                            <div class="quantity h2 font-m font-weight-bolder mb-2">
                                {!! $page->pageBlocks->where('block', $block)->where('key', 'fourth')->first()->title ?? '100 000' !!}
                                </div>
                            <div class="h5">
                                {!! $page->pageBlocks->where('block', $block)->where('key', 'fourth')->first()->description ?? 'Відвідувань щороку' !!}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>