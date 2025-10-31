@extends('layouts.app')

@section('title', 'Team - LevelMinds')
@section('meta_title', 'Team - LevelMinds')
@section('meta_description', 'Meet the LevelMinds leadership team building transparent, skill-first hiring journeys for educators and Educational Institutions.')
@section('meta_keywords', 'LevelMinds team, leadership, founders, advisors')
@section('og_type', 'website')

@include('components.marketing.styles')

@section('content')
@php
    $timeline = [
        ['year' => '2024', 'title' => 'Idea sparks in Delhi', 'copy' => 'Varun Chamoli and Amrit Raj Verma mapped hiring frustrations with principals and teachers across Educational Institutes.'],
        ['year' => '2024', 'title' => 'Co-designing the journey', 'copy' => 'Shadowing administrators and educators, we shaped transparent workflows that keep both sides aligned.'],
        ['year' => '2025', 'title' => 'Product leadership joins', 'copy' => 'Rahul Sharma turned playbooks into a secure, collaborative platform for hiring teams.'],
    ];

    $leadership = [
        [
            'name' => 'Varun Chamoli',
            'role' => 'Founder &amp; Chief Executive Officer',
            'bio' => 'Varun sets the strategic direction for LevelMinds, partnering with Educational Institutes and investors to scale a hiring platform built for impact.',
            'image' => marketing_asset('varun.jpeg'),
            'link' => 'https://www.linkedin.com/in/varun-chamoli-429518ba/',
        ],
        [
            'name' => 'Amrit Raj Verma',
            'role' => 'Co-founder &amp; Chief Operating Officer',
            'bio' => 'Amrit designs operating playbooks that keep Educational Institutes and teachers in sync, leading delivery, customer success, and partnerships.',
            'image' => marketing_asset('amrit.jpeg'),
            'link' => 'https://www.linkedin.com/in/amrit-verma-a3777b202/',
        ],
        [
            'name' => 'Rahul Sharma',
            'role' => 'Chief Technology Officer',
            'bio' => 'Rahul leads engineering and product, architecting secure, scalable systems and AI-assisted workflows for the LevelMinds platform.',
            'image' => marketing_asset('rahul.jpeg'),
            'link' => 'https://www.linkedin.com/in/knownfreak/',
        ],
    ];

    $values = [
        ['title' => 'Celebrate teachers', 'copy' => 'We amplify authentic classroom stories and create hiring journeys that honour educators.'],
        ['title' => 'Build with empathy', 'copy' => 'We co-create every feature with Educational Institutes and teachers, ensuring clarity and trust.'],
        ['title' => 'Move with integrity', 'copy' => 'We champion transparent communication, equitable evaluation, and data stewardship.'],
        ['title' => 'Learn in public', 'copy' => 'We measure impact, share learnings with our community, and adapt quickly together.'],
    ];
@endphp

<div class="lm-marketing">
    <section class="lm-section lm-section--dark" aria-labelledby="teamHeroTitle">
        <div class="container">
            <div class="lm-hero">
                <div class="lm-stack">
                    <span class="lm-badge lm-badge--light">Team</span>
                    <h1 id="teamHeroTitle">Meet the minds building LevelMinds</h1>
                    <p class="lm-lead lm-surface-note">Based in Delhi, we are educators, operators, and technologists shaping transparent hiring journeys that honour great teaching.</p>
                    <div class="lm-hero-actions" role="group" aria-label="Team actions">
                        <a class="btn btn-primary" href="{{ url('/careers') }}">Explore careers</a>
                        <a class="btn btn-outline-light" href="{{ url('/contact') }}">Partner with us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--light" aria-labelledby="teamStoryTitle">
        <div class="container">
            <div class="lm-media-block lm-media-block--align-start">
                <div class="lm-stack">
                    <span class="lm-eyebrow">Our story</span>
                    <h2 id="teamStoryTitle">We started with a classroom problem</h2>
                    <p class="lm-lead">LevelMinds began when Educational Institute leaders and teachers shared how opaque hiring slowed down great matches. We built a system that keeps context, trust, and collaboration at the centre of every step.</p>
                    <ul class="lm-list-check">
                        <li>Designing equitable evaluations with principals</li>
                        <li>Supporting teachers with transparent status updates</li>
                        <li>Helping hiring teams move quickly with clarity</li>
                    </ul>
                </div>
                <div class="lm-timeline" aria-label="LevelMinds milestones">
                    @foreach ($timeline as $item)
                        <div class="lm-timeline-item">
                            <span class="lm-timeline-year">{{ $item['year'] }}</span>
                            <div class="lm-timeline-body">
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['copy'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section" aria-labelledby="teamLeadershipTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">Leadership</span>
                <h2 id="teamLeadershipTitle">The people growing LevelMinds</h2>
                <p class="lm-lead">We blend Educational Institute leadership, technology, and experience design to help every teacher find the right classroom.</p>
            </div>
            <div class="lm-grid lm-grid-3" aria-label="Leadership profiles">
                @foreach ($leadership as $person)
                    <article class="lm-profile-card">
                        <div class="lm-avatar" aria-hidden="true">
                            <img src="{{ $person['image'] }}" alt="Portrait of {{ strip_tags($person['name']) }}">
                        </div>
                        <div class="lm-profile-meta">
                            <span class="lm-team-role">{{ $person['role'] }}</span>
                        </div>
                        <h3>{{ $person['name'] }}</h3>
                        <p>{{ $person['bio'] }}</p>
                        <a class="btn btn-outline-primary btn-sm align-self-start" href="{{ $person['link'] }}" target="_blank" rel="noopener">LinkedIn</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted" aria-labelledby="teamValuesTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">Culture</span>
                <h2 id="teamValuesTitle">Values that guide our work</h2>
                <p class="lm-lead">We believe great classrooms start with empowered teachers, supportive Educational Institutes, and hiring journeys built on trust.</p>
            </div>
            <div class="lm-value-grid">
                @foreach ($values as $value)
                    <article class="lm-value-card">
                        <div class="lm-icon-circle" aria-hidden="true">{{ $loop->iteration }}</div>
                        <h3>{{ $value['title'] }}</h3>
                        <p>{{ $value['copy'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted">
        <div class="container">
            <div class="lm-cta-banner">
                <div class="lm-stack">
                    <h2>Work with the team shaping skill-first hiring</h2>
                    <p class="lm-lead">Whether you are an Educational Institute leader or an educator, we would love to co-create the next chapter of LevelMinds with you.</p>
                </div>
                <div class="lm-cta-actions">
                    <a class="btn btn-primary" href="{{ url('/contact') }}">Start a conversation</a>
                    <a class="btn btn-outline-primary" href="{{ url('/careers') }}">Join our programs</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
