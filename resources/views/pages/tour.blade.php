@extends('layouts.app')

@section('title', 'Tour - LevelMinds')
@section('meta_title', 'Tour - LevelMinds')
@section('meta_description', 'Explore the LevelMinds platform that helps Educational Institutions and teachers move from application to offer without friction.')
@section('meta_keywords', 'LevelMinds tour, product walkthrough, hiring platform features')
@section('og_type', 'website')

@include('components.marketing.styles')

@section('content')
@php
    $tourSteps = [
        ['title' => 'Launch your workspace', 'copy' => 'Invite your leadership team, import open roles, and define scorecards rooted in classroom impact.'],
        ['title' => 'Share roles with educators', 'copy' => 'Publish opportunities and allow teachers to apply with evidence-rich portfolios.'],
        ['title' => 'Collaborate on interviews', 'copy' => 'Assign panelists, schedule interviews, and capture rubric-based feedback in one place.'],
        ['title' => 'Decide with confidence', 'copy' => 'Compare candidates, align on next steps, and close the loop with transparent offers.'],
    ];

    $tourBands = [
        [
            'title' => 'Unified pipelines',
            'copy' => 'Segment roles by subject, department, or location. Everyone sees the same truth, updated in real time.',
            'image' => marketing_asset('tour-1.jpg'),
            'alt' => 'Pipeline interface showing role stages and candidate cards',
        ],
        [
            'title' => 'Evidence-rich evaluations',
            'copy' => 'Scorecards surface teaching philosophy, videos, and lesson plans so feedback is consistent and contextual.',
            'image' => marketing_asset('tour-4.jpg'),
            'alt' => 'Scorecard view highlighting teacher evidence and rubric ratings',
            'reverse' => true,
        ],
        [
            'title' => 'Analytics that inform action',
            'copy' => 'Understand conversion rates, bottlenecks, and time-to-offer to keep teams moving at the right pace.',
            'image' => marketing_asset('tour-6.jpg'),
            'alt' => 'Analytics dashboard showing pipeline metrics and charts',
        ],
    ];

    $tourTabs = [
        'schools' => [
            ['title' => 'Configure hiring journeys', 'copy' => 'Tailor stages, forms, and approvals to match the way your Educational Institute evaluates talent.'],
            ['title' => 'Collaborate with context', 'copy' => 'Leave notes, upload documents, and track interview tasks so every stakeholder is aligned.'],
            ['title' => 'Keep compliance in check', 'copy' => 'Audit-ready logs capture every action, from shortlist decisions to offer approvals.'],
            ['title' => 'Onboard with momentum', 'copy' => 'Trigger onboarding workflows and share next steps as soon as a teacher accepts.'],
        ],
        'teachers' => [
            ['title' => 'Craft a standout profile', 'copy' => 'Showcase classroom projects, certifications, and reflections to highlight your impact.'],
            ['title' => 'Discover aligned roles', 'copy' => 'Filter by subject, preferred location, and Educational Institute philosophy to find the right fit.'],
            ['title' => 'Stay informed at every step', 'copy' => 'Automated updates and reminders keep you aware of interview schedules and feedback.'],
            ['title' => 'Grow with community support', 'copy' => 'Get tips, resources, and mentoring from the LevelMinds network to prepare for interviews.'],
        ],
    ];
@endphp

<div class="lm-marketing">
    <section class="lm-section" aria-labelledby="tourHeroTitle">
        <div class="container">
            <div class="lm-stack lm-center">
                <span class="lm-badge">Product tour</span>
                <h1 id="tourHeroTitle">See LevelMinds in action</h1>
                <p class="lm-lead">Walk through the spaces teachers and Educational Institute teams share to move from application to offer without friction.</p>
                <div class="lm-hero-actions justify-content-center" role="group" aria-label="Tour actions">
                    <a class="btn btn-primary" href="{{ url('/contact') }}">Request a live demo</a>
                    <a class="btn btn-outline-primary" href="https://lmap.in/signup" target="_blank" rel="noopener">Create an account</a>
                    <a class="btn btn-outline-primary" href="{{ url('/') }}">Return to home</a>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section" aria-labelledby="tourStepsTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">Step-by-step journey</span>
                <h2 id="tourStepsTitle">From role creation to accepted offer</h2>
                <p class="lm-lead">Every interaction is designed to be transparent, collaborative, and focused on classroom impact.</p>
            </div>
            <div class="lm-step-grid" role="list">
                @foreach ($tourSteps as $step)
                    <div class="lm-step-card" role="listitem">
                        <h3>{{ $step['title'] }}</h3>
                        <p>{{ $step['copy'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--light" aria-labelledby="tourScreenshotsTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">Product spotlight</span>
                <h2 id="tourScreenshotsTitle">Experience the LevelMinds dashboards</h2>
                <p class="lm-lead">Scroll through product views and explore how each feature supports hiring teams and educators.</p>
            </div>
            <div class="lm-product-slider carousel slide" id="tourSpotlight" data-bs-ride="carousel" aria-label="Platform screenshots">
                <div class="carousel-indicators">
                    @for ($i = 0; $i < 7; $i++)
                        <button type="button" data-bs-target="#tourSpotlight" data-bs-slide-to="{{ $i }}" @if($i === 0) class="active" aria-current="true" @endif aria-label="Slide {{ $i + 1 }}"></button>
                    @endfor
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ marketing_asset('tour-1.jpg') }}" class="d-block w-100" alt="Applicant pipeline dashboard overview">
                        <div class="lm-product-caption">Applicant pipeline: monitor every stage in one unified dashboard.</div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ marketing_asset('tour-2.jpg') }}" class="d-block w-100" alt="Teacher dashboard tracking applications">
                        <div class="lm-product-caption">Teacher dashboard: keep educators updated with real-time status changes.</div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ marketing_asset('tour-3.jpg') }}" class="d-block w-100" alt="Interview scheduling interface">
                        <div class="lm-product-caption">Scheduling: align interview panels and reminders without leaving LevelMinds.</div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ marketing_asset('tour-4.jpg') }}" class="d-block w-100" alt="Candidate profile with teaching evidence">
                        <div class="lm-product-caption">Candidate profile: review teaching evidence, lesson plans, and credentials.</div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ marketing_asset('tour-5.jpg') }}" class="d-block w-100" alt="Scorecard review and feedback screen">
                        <div class="lm-product-caption">Scorecards: capture rubric-aligned feedback from every panelist.</div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ marketing_asset('tour-6.jpg') }}" class="d-block w-100" alt="Hiring analytics snapshot">
                        <div class="lm-product-caption">Analytics: understand pipeline health and the sources bringing great teachers.</div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ marketing_asset('tour-7.jpg') }}" class="d-block w-100" alt="Team tasks and follow-up checklist">
                        <div class="lm-product-caption">Tasks: keep hiring teams aligned with task lists and follow-up nudges.</div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#tourSpotlight" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#tourSpotlight" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <section class="lm-section" aria-labelledby="tourBandsTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">Feature highlights</span>
                <h2 id="tourBandsTitle">Designed for collaboration and clarity</h2>
            </div>
            <div class="lm-stack">
                @foreach ($tourBands as $band)
                    <div class="lm-media-block @if(!empty($band['reverse'])) lm-media-block--reverse @endif">
                        <div class="lm-stack">
                            <span class="lm-pill">{{ $loop->iteration }}. Focus area</span>
                            <h3>{{ $band['title'] }}</h3>
                            <p class="lm-lead">{{ $band['copy'] }}</p>
                            <div class="lm-hero-actions" role="group" aria-label="{{ $band['title'] }} actions">
                                <a class="btn btn-primary" href="{{ url('/contact') }}">Talk to our team</a>
                                <a class="btn btn-outline-primary" href="https://lmap.in/signup" target="_blank" rel="noopener">Start exploring</a>
                            </div>
                        </div>
                        <figure>
                            <img src="{{ $band['image'] }}" alt="{{ $band['alt'] }}">
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted" aria-labelledby="tourTabsTitle">
        <div class="container">
            <div class="lm-tab-group" data-lm-tabs>
                <div class="lm-section__header lm-center">
                    <span class="lm-eyebrow">Built for everyone involved</span>
                    <h2 id="tourTabsTitle">Choose your journey</h2>
                    <p class="lm-lead">Switch between the Educational Institute and Teacher flow to see how LevelMinds keeps both sides aligned.</p>
                </div>
                <div class="lm-tab-buttons" role="tablist">
                    <button type="button" class="lm-tab-button active" role="tab" aria-selected="true" data-tab="schools">For Educational Institutes</button>
                    <button type="button" class="lm-tab-button" role="tab" aria-selected="false" data-tab="teachers">For teachers</button>
                </div>
                @foreach ($tourTabs as $key => $items)
                    <div class="lm-tab-panel @if ($loop->first) active @endif" id="tab-{{ $key }}" role="tabpanel">
                        <div class="lm-step-grid" role="list">
                            @foreach ($items as $item)
                                <div class="lm-step-card" role="listitem">
                                    <h3>{{ $item['title'] }}</h3>
                                    <p>{{ $item['copy'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted">
        <div class="container">
            <div class="lm-cta-banner">
                <div class="lm-stack">
                    <h2>See how LevelMinds fits your hiring workflow</h2>
                    <p class="lm-lead">Share your goals and we will tailor a walkthrough for your Educational Institute or teacher network.</p>
                </div>
                <div class="lm-cta-actions">
                    <a class="btn btn-primary" href="{{ url('/contact') }}">Book a demo</a>
                    <a class="btn btn-outline-primary" href="https://lmap.in/signup" target="_blank" rel="noopener">Sign up now</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-lm-tabs]').forEach(function (group) {
            const buttons = group.querySelectorAll('.lm-tab-button');
            const panels = group.querySelectorAll('.lm-tab-panel');

            buttons.forEach(function (button) {
                button.addEventListener('click', function () {
                    const target = button.getAttribute('data-tab');
                    buttons.forEach(function (btn) {
                        btn.classList.toggle('active', btn === button);
                        btn.setAttribute('aria-selected', btn === button ? 'true' : 'false');
                    });
                    panels.forEach(function (panel) {
                        panel.classList.toggle('active', panel.id === 'tab-' + target);
                    });
                });
            });
        });
    });
</script>
@endpush
