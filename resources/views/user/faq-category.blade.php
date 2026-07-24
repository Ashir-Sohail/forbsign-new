@extends('layouts.app')
@section('title')
    Faqs
@endsection
@section('content')
    {{-- <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('user.home') }}">Home</a> </li>
                        <li class="separator"></li>
                        <li>Faq</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}
    <!--faq start there -->
    <section id="faqs" class="my-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @if ($faq_categories->isEmpty())
                        <div class="alert alert-info text-center">
                            No FAQ categories found.
                        </div>
                        @else
                        <div class="nav flex nav-pills gap-3" id="faqs_tab" role="tablist" aria-orientation="vertical">
                            @foreach ($faq_categories as $category)
                                <button class="nav-link w-100 {{ $loop->first ? 'active' : '' }}"
                                    id="v-pills-{{ $category->id }}-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-{{ $category->id }}" type="button" role="tab"
                                    aria-controls="v-pills-{{ $category->id }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {{ $category->name }}
                                </button>
                            @endforeach
                        </div>
                        @endif
                </div>
                <div class="col-lg-8">
                    <div class="tab-content p-0" id="v-pills-tabContent">
                        @foreach ($faq_categories as $category)
                            {{-- @dump($category->id) --}}
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="v-pills-{{ $category->id }}" role="tabpanel"
                                aria-labelledby="v-pills-{{ $category->id }}-tab">
                                <h2 class="header30_gray text-capitalize text-dark">{{ $category->name }}</h2>
                                <div class="accordion mt-3" id="accordionExample">
                                    @if ($category->faqs->isEmpty())
                                        <p class="text-center">No FAQs available for this category.</p>
                                    @else
                                        @foreach ($category->faqs as $faq)
                                            <div class="accordion-item border-end-0 border-start-0 rounded-0">
                                                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false"
                                                        aria-controls="collapse{{ $faq->id }}">
                                                        {{ $faq->title }}
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                                                    aria-labelledby="heading{{ $faq->id }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body px-2 py-2">
                                                        <p>{!! $faq->details !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--faqs end there -->



    <div id="qualityhelpinstall" class="store_footer_top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="qhi col-md-4">
                    <img src="./assets/imgs/QualityMaterial.svg" alt="" loading="lazy">
                    <h6>Quality Material</h6>
                    <p>
                        The best materials make for the best job. It’s that simple. Every sign is 100% weatherproof
                        &amp;
                        resistant so they’re as durable as they are brilliantly designed.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="./assets/imgs/Help&amp;Support.svg" alt="Help and Support" loading="lazy">
                    <h6>Help and Support</h6>
                    <p>
                        We’re all about happy customers. If you need help purchasing your sign please contact us during
                        office hours on 01795 505850, or why not try our&nbsp;live chat.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="./assets/imgs/Quick&amp;Install.svg" alt="Quick &amp; easy to install" loading="lazy">
                    <h6>Quick &amp; easy to install</h6>
                    <p>
                        The best materials make for the best job. It’s that simple. Every sign is 100% weatherproof
                        &amp;
                        resistant so they’re as durable as they are brilliantly designed.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
