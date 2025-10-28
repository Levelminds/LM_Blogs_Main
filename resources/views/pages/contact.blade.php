@extends('layouts.app')

@section('title', 'Contact - LevelMinds')
@section('meta_title', 'Contact - LevelMinds')
@section('meta_description', 'Connect with LevelMinds to learn how we help Educational Institutions and teachers build transparent hiring journeys.')
@section('meta_keywords', 'LevelMinds contact, education hiring support, teacher recruitment help')
@section('og_type', 'website')

@include('components.marketing.styles')

@section('content')
@php
    $contactFaqs = [
        ['question' => 'How quickly does the LevelMinds team respond?', 'answer' => 'We reply to all messages within two business days. Urgent product questions can also be sent through the in-app chat for faster support.'],
        ['question' => 'Do you offer onboarding support for Educational Institutes?', 'answer' => 'Yes. Our team provides onboarding workshops, hiring playbooks, and administrator training for every new Educational Institute.'],
        ['question' => 'Can teachers request product walkthroughs?', 'answer' => 'Absolutely. We host weekly group demos and can schedule a 1:1 orientation for teachers preparing applications.'],
    ];

    $contactHighlights = [
        ['value' => '1:1', 'label' => 'Implementation partner for every Educational Institute'],
        ['value' => '150+', 'label' => 'Support conversations resolved each month'],
        ['value' => '4.9/5', 'label' => 'Average rating for our support experience'],
    ];
@endphp

<div class="lm-marketing">
    <section class="lm-section" aria-labelledby="contactHeroTitle">
        <div class="container">
            <div class="lm-stack lm-center">
                <span class="lm-badge">Contact</span>
                <h1 id="contactHeroTitle">We would love to hear from you</h1>
                <p class="lm-lead">Whether you are an Educational Institute, teacher, or partner, reach out and we will respond within two business days.</p>
            </div>
        </div>
    </section>

    <section class="lm-section" aria-labelledby="contactFormTitle">
        <div class="container">
            <div class="lm-contact-panels">
                <div class="lm-card">
                    <span class="lm-eyebrow">Send a message</span>
                    <h2 id="contactFormTitle">Tell us how we can help</h2>
                    <p class="lm-lead">Share as much context as possible so our team can tailor the next steps. Fields marked with * are required.</p>
                    @include('components.flash-message')
                    <form method="post" action="{{ route('contact.submit') }}" class="lm-form" aria-label="Contact form">
                        @csrf
                        <input type="hidden" name="lm_contact" value="1" />
                        <div class="lm-field">
                            <label for="name">Full Name *</label>
                            <input id="name" name="name" type="text" required aria-required="true">
                        </div>
                        <div class="lm-field-group two">
                            <div class="lm-field">
                                <label for="email">Email *</label>
                                <input id="email" name="email" type="email" required aria-required="true" autocomplete="email">
                            </div>
                            <div class="lm-field">
                                <label for="contact-subject">Subject</label>
                                <input id="contact-subject" name="subject" type="text" value="{{ old('subject') }}" placeholder="General inquiry">
                                @error('subject')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="lm-field">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" rows="6" required aria-required="true" placeholder="Share how we can support your hiring goals"></textarea>
                        </div>
                        <div class="lm-field-group two">
                            <div class="lm-field">
                                <label for="org">Educational Institute / Organisation</label>
                                <input id="org" name="organisation" type="text" placeholder="School, college, or company name">
                            </div>
                            <div class="lm-field">
                                <label for="phone">Phone</label>
                                <input id="phone" name="phone" type="tel" placeholder="Optional contact number">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Send message</button>
                    </form>
                </div>
                <aside class="lm-contact-side" aria-labelledby="contactInfoTitle">
                    <div class="lm-card">
                        <h3 id="contactInfoTitle">Reach us directly</h3>
                        <address class="mb-3 lm-stack">
                            <span>Delhi, India</span>
                            <a class="fw-semibold text-decoration-none text-reset" href="mailto:support@levelminds.in">support@levelminds.in</a>
                            <a class="d-inline-flex align-items-center gap-2 fw-semibold text-decoration-none text-reset" href="tel:+917303835892">
                                <span class="lm-eyebrow">Phone</span>
                                <span>+91 73038 35892</span>
                            </a>
                            <span class="text-muted small">Support hours: 10 AM &ndash; 6 PM IST</span>
                        </address>
                    </div>
                    <div class="lm-card">
                        <h3>Program enquiries</h3>
                        <p>Interested in our campus ambassador program or collaborative pilots? Submit an application and our success team will reach out.</p>
                        <a class="btn btn-outline-primary btn-sm" href="{{ url('/careers') }}">Go to careers</a>
                    </div>
                    <div class="lm-card lm-card--outline">
                        <h3>Press and partnerships</h3>
                        <p>Write to <a href="mailto:support@levelminds.in">support@levelminds.in</a> for media, events, or collaboration opportunities.</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="lm-section lm-section--muted" aria-labelledby="contactSocialProofTitle">
        <div class="container">
            <div class="lm-split">
                <div class="lm-stack">
                    <span class="lm-eyebrow">Support highlights</span>
                    <h2 id="contactSocialProofTitle">We stay close to every conversation</h2>
                    <p class="lm-lead">Our team provides personalised support, onboarding, and follow-up guidance so Educational Institutes and teachers feel confident using LevelMinds.</p>
                    <div class="lm-highlight-grid" role="list">
                        @foreach ($contactHighlights as $highlight)
                            <div class="lm-highlight-card" role="listitem">
                                <strong>{{ $highlight['value'] }}</strong>
                                <span>{{ $highlight['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="lm-testimonial-grid" aria-label="Testimonials about support">
                    <article class="lm-testimonial-card">
                        <blockquote>&ldquo;The LevelMinds team guided us through every step of onboarding and responded quickly whenever we needed clarity.&rdquo;</blockquote>
                        <cite>Shweta Kapoor &mdash; Academic Director</cite>
                    </article>
                    <article class="lm-testimonial-card">
                        <blockquote>&ldquo;Even as a first-time user, I felt confident navigating the dashboard. The support notes were detailed and friendly.&rdquo;</blockquote>
                        <cite>Rohit Jain &mdash; Science Educator</cite>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="lm-section" aria-labelledby="contactFaqTitle">
        <div class="container">
            <div class="lm-section__header lm-center">
                <span class="lm-eyebrow">FAQs</span>
                <h2 id="contactFaqTitle">Answers to common questions</h2>
                <p class="lm-lead">Browse the questions below or reach out directly &mdash; we are always happy to help.</p>
            </div>
            <div class="lm-grid lm-grid-2">
                @foreach ($contactFaqs as $faq)
                    <details class="lm-faq-item">
                        <summary>{{ $faq['question'] }}</summary>
                        <div class="lm-faq-content">
                            <p>{{ $faq['answer'] }}</p>
                        </div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection
