@extends('layouts.app')

@section('title', 'Careers - LevelMinds')
@section('meta_title', 'Careers - LevelMinds')
@section('meta_description', 'Join the LevelMinds campus ambassador program and help teachers discover new opportunities while gaining leadership experience.')
@section('meta_keywords', 'LevelMinds careers, campus ambassador program, education jobs')
@section('og_type', 'website')

@include('components.marketing.styles')

@section('content')
@php
    $careerBenefits = [
        ['title' => 'Hybrid-first collaboration', 'items' => ['Flexible schedules with async rituals', 'Quarterly in-person team weeks', 'Workspace stipend for remote setups']],
        ['title' => 'Grow with mentors', 'items' => ['Executive coaching budget', 'Access to education leaders network', 'Learning allowance for courses']],
        ['title' => 'Meaningful impact', 'items' => ['Shape equitable hiring journeys', 'Co-create with teachers and Educational Institutes', 'Build tools that celebrate classroom excellence']],
    ];

    $careerPillars = [
        ['title' => 'Mission obsessed', 'copy' => 'We prioritise transparent hiring outcomes for teachers and Educational Institutes in everything we ship.'],
        ['title' => 'Craft with empathy', 'copy' => 'We listen first, prototype fast, and make sure our decisions consider diverse classrooms.'],
        ['title' => 'Own the outcome', 'copy' => 'We celebrate autonomy, thoughtful experimentation, and accountability end to end.'],
    ];

@endphp

<div class="lm-marketing">
    <section class="lm-section" aria-labelledby="careersHeroTitle">
        <div class="container">
            <div class="lm-split">
                <div class="lm-stack">
                    <span class="lm-badge">Careers at LevelMinds</span>
                    <h1 id="careersHeroTitle">Join a mission-first team building equitable hiring</h1>
                    <p class="lm-lead">We combine product craft, hiring expertise, and community partnerships to help teachers and Educational Institutes find the perfect match.</p>
                    <div class="lm-hero-actions" role="group" aria-label="Career actions">
                        <a class="btn btn-primary" href="#apply">Apply now</a>
                        <a class="btn btn-outline-primary" href="{{ url('/contact') }}">Talk to our team</a>
                    </div>
                </div>
                <div class="lm-product-frame">
                    <img src="{{ marketing_asset('careers1.png') }}" alt="LevelMinds team collaborating in a modern workspace">
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--light" aria-labelledby="careersBenefitsTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">Why LevelMinds</span>
                <h2 id="careersBenefitsTitle">Benefits designed for impact</h2>
                <p class="lm-lead">We invest in growth, wellbeing, and community so you can do your best work supporting educators.</p>
            </div>
            <div class="lm-grid lm-grid-3">
                @foreach ($careerBenefits as $benefit)
                    <article class="lm-card">
                        <h3>{{ $benefit['title'] }}</h3>
                        <ul class="lm-list-check">
                            @foreach ($benefit['items'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lm-section" aria-labelledby="careersPillarsTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">How we work</span>
                <h2 id="careersPillarsTitle">Our hiring pillars</h2>
                <p class="lm-lead">We look for team members who share our commitment to transparency, empathy, and action.</p>
            </div>
            <div class="lm-grid lm-grid-3">
                @foreach ($careerPillars as $pillar)
                    <article class="lm-value-card">
                        <div class="lm-icon-circle" aria-hidden="true">{{ $loop->iteration }}</div>
                        <h3>{{ $pillar['title'] }}</h3>
                        <p>{{ $pillar['copy'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted" id="apply" aria-labelledby="careersApplyTitle">
        <div class="container">
            <div class="lm-contact-panels">
                <div class="lm-card lm-card--raised">
                    <span class="lm-eyebrow">Campus ambassador snapshot</span>
                    <h2 id="careersApplyTitle">Champion LevelMinds on your campus</h2>
                    <p class="lm-lead">Help teachers discover opportunities while gaining leadership experience and building a network across Educational Institutes.</p>
                    <ul class="lm-list-check">
                        <li>Applications reviewed weekly</li>
                        <li>Support from the LevelMinds team</li>
                        <li>Opportunities to co-host future programs</li>
                    </ul>
                </div>
                <div class="lm-card">
                    @include('components.flash-message')
                    <form method="post" action="{{ route('careers.submit') }}" class="lm-form" aria-label="Campus ambassador application form">
                        @csrf
                        <input type="hidden" name="lm_career" value="1" />
                        <div class="lm-field-group two">
                            <div class="lm-field">
                                <label for="fullname">Full Name *</label>
                                <input id="fullname" name="fullname" type="text" required aria-required="true">
                            </div>
                            <div class="lm-field">
                                <label for="email">Email *</label>
                                <input id="email" name="email" type="email" required aria-required="true">
                            </div>
                        </div>
                        <div class="lm-field-group two">
                            <div class="lm-field">
                                <label for="career-phone">Phone / WhatsApp</label>
                                <input id="career-phone" name="phone" type="text" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="lm-field">
                                <label for="college">College / University *</label>
                                <input id="college" name="college" type="text" required aria-required="true">
                            </div>
                        </div>
                        <div class="lm-field">
                            <label for="career-linkedin">LinkedIn Profile</label>
                            <input id="career-linkedin" name="linkedin" type="url" value="{{ old('linkedin') }}" placeholder="https://linkedin.com/in/you">
                            @error('linkedin')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="lm-field">
                            <label for="career-plan">How will you help teachers find opportunities?</label>
                            <textarea id="career-plan" name="plan" rows="5" placeholder="Share your plan, student communities, or past experience">{{ old('plan') }}</textarea>
                            @error('plan')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Submit application</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
