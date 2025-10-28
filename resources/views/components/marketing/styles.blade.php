@once
    @push('styles')
        <style>
            .lm-marketing {
                --lm-brand-900: #182764;
                --lm-brand-800: #22317d;
                --lm-brand-700: #3248ad;
                --lm-brand-600: #3f97d5;
                --lm-brand-400: rgba(63, 151, 213, 0.18);
                --lm-surface-tint: #f3f6ff;
                --lm-surface-tint-strong: #e3edff;
                --lm-neutral-950: #0b142d;
                --lm-neutral-900: #121c36;
                --lm-neutral-700: #2c3852;
                --lm-neutral-600: #445068;
                --lm-neutral-400: #818ca3;
                --lm-neutral-200: #d7deef;
                --lm-neutral-150: #e6ebf7;
                --lm-neutral-100: #f5f7fc;
                --lm-surface: #ffffff;
                --lm-radius-lg: 24px;
                --lm-radius-md: 16px;
                --lm-radius-sm: 12px;
                --lm-shadow-lg: 0 32px 80px -46px rgba(13, 20, 36, 0.35);
                --lm-shadow-md: 0 18px 48px -32px rgba(13, 20, 36, 0.28);
                --lm-shadow-sm: 0 10px 28px -18px rgba(13, 20, 36, 0.22);
                font-family: 'Manrope', 'Public Sans', 'Segoe UI', Tahoma, sans-serif;
                color: var(--lm-neutral-900);
            }

            .lm-marketing h1,
            .lm-marketing h2,
            .lm-marketing h3,
            .lm-marketing h4,
            .lm-marketing h5,
            .lm-marketing h6 {
                font-weight: 700;
                color: var(--lm-neutral-900);
            }

            .lm-marketing p {
                color: var(--lm-neutral-600);
                margin-bottom: 1rem;
            }

            .lm-section {
                padding: clamp(3.5rem, 8vw, 5.5rem) 0;
            }

            .lm-section--muted {
                background-color: var(--lm-neutral-100);
            }

            .lm-section--light {
                background-color: var(--lm-neutral-150);
            }

            .lm-section--dark {
                background: linear-gradient(135deg, var(--lm-brand-900), var(--lm-brand-700));
                color: #fff;
            }

            .lm-section--dark h2,
            .lm-section--dark h3,
            .lm-section--dark p,
            .lm-section--dark span,
            .lm-section--dark li,
            .lm-section--dark blockquote,
            .lm-section--dark cite {
                color: #fff;
            }

            .lm-stack {
                display: grid;
                gap: clamp(1.5rem, 4vw, 2.75rem);
            }

            .lm-grid {
                display: grid;
                gap: clamp(1.5rem, 4vw, 2.5rem);
            }

            .lm-grid-2 {
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            }

            .lm-grid-3 {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            }

            .lm-grid-4 {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .lm-section__header {
                display: grid;
                gap: 0.8rem;
                margin-bottom: clamp(2rem, 5vw, 3rem);
            }

            .lm-section__header.lm-center {
                text-align: center;
                justify-items: center;
            }

            .lm-center {
                text-align: center;
            }

            .lm-lead {
                font-size: 1.05rem;
                color: var(--lm-neutral-600);
                max-width: 62ch;
            }

            .lm-badge,
            .lm-eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 0.35rem;
                font-size: 0.78rem;
                font-weight: 700;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--lm-brand-700);
            }

            .lm-badge {
                background: var(--lm-brand-400);
                padding: 0.4rem 0.85rem;
                border-radius: 999px;
                color: var(--lm-brand-700);
            }

            .lm-badge--light {
                background: rgba(255, 255, 255, 0.28);
                color: #fff;
            }

            .lm-eyebrow {
                color: var(--lm-brand-600);
            }

            .lm-hero {
                display: grid;
                gap: clamp(2rem, 5vw, 3rem);
            }

            .lm-hero .lm-hero-stats {
                display: grid;
                gap: 1rem;
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            }

            .lm-hero-stat {
                background: var(--lm-surface);
                border-radius: var(--lm-radius-md);
                padding: 1.5rem;
                box-shadow: var(--lm-shadow-sm);
                display: grid;
                gap: 0.35rem;
            }

            .lm-hero-stat strong {
                font-size: clamp(1.75rem, 4vw, 2.4rem);
                font-weight: 800;
                color: var(--lm-brand-700);
            }

            .lm-hero-stat span {
                font-size: 0.9rem;
                color: var(--lm-neutral-600);
            }

            @media (min-width: 992px) {
                .lm-hero.lm-hero-grid {
                    grid-template-columns: minmax(0, 1fr) minmax(0, 0.95fr);
                    align-items: center;
                }
            }

            .lm-hero-actions,
            .lm-cta-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75rem;
            }

            .lm-pill {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                padding: 0.35rem 0.9rem;
                border-radius: 999px;
                background: rgba(50, 72, 173, 0.1);
                color: var(--lm-brand-700);
                font-weight: 600;
                font-size: 0.8rem;
                letter-spacing: 0.04em;
                text-transform: uppercase;
            }

            .lm-gradient-text {
                background: linear-gradient(120deg, var(--lm-brand-700), var(--lm-brand-600));
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
            }

            .lm-metric-grid {
                display: grid;
                gap: 1rem;
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
                margin-top: 2.5rem;
            }

            .lm-metric {
                background: rgba(255, 255, 255, 0.12);
                border: 1px solid rgba(255, 255, 255, 0.18);
                border-radius: var(--lm-radius-md);
                padding: 1.25rem 1.5rem;
                backdrop-filter: blur(6px);
                color: #fff;
            }

            .lm-metric dt {
                font-size: 0.85rem;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                margin-bottom: 0.5rem;
                color: rgba(255, 255, 255, 0.8);
            }

            .lm-metric dd {
                font-size: 1.9rem;
                font-weight: 700;
                margin: 0;
                color: #fff;
            }

            .lm-card {
                background: var(--lm-surface);
                border-radius: var(--lm-radius-md);
                padding: 2rem;
                box-shadow: var(--lm-shadow-sm);
                height: 100%;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }

            .lm-card--dark {
                background: rgba(255, 255, 255, 0.08);
                border: 1px solid rgba(255, 255, 255, 0.18);
                color: #fff;
                box-shadow: none;
            }

            .lm-card--outline {
                border: 1px solid var(--lm-neutral-200);
                box-shadow: none;
            }

            .lm-card--raised {
                box-shadow: var(--lm-shadow-lg);
            }

            .lm-card:hover,
            .lm-team-card:hover,
            .lm-profile-card:hover,
            .lm-job-card[open] {
                box-shadow: var(--lm-shadow-md);
                transform: translateY(-4px);
            }

            .lm-feature-grid,
            .lm-team-grid {
                display: grid;
                gap: 1.75rem;
            }

            @media (min-width: 992px) {
                .lm-feature-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
                .lm-team-grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }
            }

            .lm-team-card {
                display: grid;
                gap: 1.25rem;
                background: var(--lm-surface);
                border-radius: var(--lm-radius-md);
                overflow: hidden;
                box-shadow: var(--lm-shadow-sm);
                height: 100%;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }

            .lm-team-card img {
                width: 100%;
                height: 280px;
                object-fit: cover;
            }

            .lm-team-card-body {
                padding: 1.5rem;
                display: grid;
                gap: 0.75rem;
            }

            .lm-profile-card {
                background: var(--lm-surface);
                border-radius: var(--lm-radius-md);
                padding: 2rem;
                box-shadow: var(--lm-shadow-sm);
                display: grid;
                gap: 1.25rem;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
                position: relative;
            }

            .lm-profile-card::after {
                content: '';
                position: absolute;
                inset: 0;
                border-radius: inherit;
                border: 1px solid rgba(63, 151, 213, 0.18);
                pointer-events: none;
            }

            .lm-profile-card .lm-avatar {
                width: 64px;
                height: 64px;
                border-radius: 50%;
                overflow: hidden;
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-profile-card .lm-avatar img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .lm-profile-meta {
                font-size: 0.9rem;
                color: var(--lm-neutral-600);
            }

            .lm-team-role {
                font-size: 0.85rem;
                font-weight: 600;
                letter-spacing: 0.04em;
                text-transform: uppercase;
                color: var(--lm-brand-600);
            }

            .lm-list-check {
                list-style: none;
                padding: 0;
                margin: 0;
                display: grid;
                gap: 0.65rem;
            }

            .lm-list-check li {
                display: flex;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .lm-list-check li::before {
                content: '✔';
                color: var(--lm-brand-600);
                font-weight: 700;
                line-height: 1.2;
                flex-shrink: 0;
            }

            .lm-list-steps {
                list-style: none;
                padding: 0;
                margin: 0;
                counter-reset: step;
                display: grid;
                gap: 1.75rem;
            }

            .lm-list-steps li {
                counter-increment: step;
                background: var(--lm-surface);
                border-radius: var(--lm-radius-md);
                padding: 1.5rem;
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-list-steps li::before {
                content: counter(step, decimal-leading-zero);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 2.25rem;
                height: 2.25rem;
                margin-bottom: 0.75rem;
                border-radius: 999px;
                background: var(--lm-brand-700);
                color: #fff;
                font-weight: 700;
                font-size: 0.95rem;
            }

            .lm-step-grid {
                display: grid;
                gap: 1.5rem;
            }

            @media (min-width: 768px) {
                .lm-step-grid {
                    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                }
            }

            .lm-step-card {
                position: relative;
                background: var(--lm-surface);
                border-radius: var(--lm-radius-md);
                padding: 2rem;
                box-shadow: var(--lm-shadow-sm);
                display: grid;
                gap: 0.75rem;
                counter-increment: lmstep;
            }

            .lm-step-card::before {
                content: counter(lmstep, decimal-leading-zero);
                position: absolute;
                inset: 1.25rem auto auto 1.5rem;
                width: 2.5rem;
                height: 2.5rem;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border-radius: 999px;
                background: var(--lm-brand-700);
                color: #fff;
                font-weight: 700;
            }

            .lm-step-card h3 {
                margin-top: 2.5rem;
            }

            .lm-split {
                display: grid;
                gap: 2.5rem;
            }

            @media (min-width: 992px) {
                .lm-split {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    align-items: center;
                }
            }

            .lm-product-slider {
                position: relative;
                overflow: hidden;
                border-radius: var(--lm-radius-md);
                box-shadow: var(--lm-shadow-lg);
                background: radial-gradient(circle at top right, rgba(63, 151, 213, 0.16), transparent 60%);
            }

            .lm-product-slider .carousel-inner {
                border-radius: inherit;
            }

            .lm-product-caption {
                background: rgba(17, 28, 77, 0.72);
                color: #fff;
                padding: 1rem 1.25rem;
                font-size: 0.95rem;
            }

            .lm-product-slider .carousel-indicators [data-bs-target] {
                background-color: rgba(255, 255, 255, 0.65);
            }

            .lm-product-slider .carousel-indicators .active {
                background-color: #fff;
            }

            .lm-quote-card {
                background: rgba(255, 255, 255, 0.12);
                border-radius: var(--lm-radius-md);
                padding: 2.25rem;
                color: #fff;
                box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.22);
            }

            .lm-quote-card blockquote {
                font-size: 1.4rem;
                font-weight: 600;
                margin-bottom: 1.25rem;
            }

            .lm-timeline {
                display: grid;
                gap: 1.75rem;
                position: relative;
            }

            .lm-timeline::before {
                content: '';
                position: absolute;
                left: 1rem;
                top: 0;
                bottom: 0;
                width: 2px;
                background: var(--lm-neutral-200);
            }

            .lm-timeline-item {
                position: relative;
                padding-left: 2.75rem;
                display: grid;
                gap: 0.75rem;
            }

            .lm-timeline-year {
                display: inline-flex;
                align-self: start;
                background: var(--lm-brand-700);
                color: #fff;
                font-weight: 700;
                font-size: 0.85rem;
                padding: 0.35rem 0.75rem;
                border-radius: 999px;
                letter-spacing: 0.04em;
                text-transform: uppercase;
                position: relative;
                z-index: 1;
            }

            .lm-timeline-body {
                display: grid;
                gap: 0.5rem;
            }

            .lm-timeline-body h3 {
                margin-bottom: 0;
            }

            .lm-cta-banner {
                display: grid;
                gap: 1.5rem;
                background: var(--lm-surface);
                border-radius: var(--lm-radius-lg);
                padding: clamp(2rem, 4vw, 3rem);
                align-items: center;
                box-shadow: var(--lm-shadow-md);
            }

            @media (min-width: 992px) {
                .lm-cta-banner {
                    grid-template-columns: minmax(0, 1.75fr) minmax(0, 1fr);
                }
            }

            .lm-tab-group {
                display: grid;
                gap: 2.5rem;
            }

            .lm-tab-buttons {
                display: inline-flex;
                background: var(--lm-surface);
                border-radius: 999px;
                padding: 0.35rem;
                box-shadow: var(--lm-shadow-sm);
                gap: 0.35rem;
                justify-self: center;
            }

            .lm-tab-button {
                border: none;
                background: transparent;
                padding: 0.65rem 1.4rem;
                border-radius: 999px;
                font-weight: 600;
                color: var(--lm-neutral-600);
                cursor: pointer;
                transition: all 0.25s ease;
            }

            .lm-tab-button.active {
                background: var(--lm-brand-700);
                color: #fff;
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-tab-panel {
                display: none;
            }

            .lm-tab-panel.active {
                display: block;
            }

            .lm-product-frame {
                border-radius: var(--lm-radius-lg);
                overflow: hidden;
                box-shadow: var(--lm-shadow-lg);
                background: var(--lm-surface);
            }

            .lm-product-frame img {
                width: 100%;
                height: auto;
                display: block;
            }

            .lm-contact-panels {
                display: grid;
                gap: 2rem;
            }

            @media (min-width: 992px) {
                .lm-contact-panels {
                    grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
                }
            }

            .lm-form .lm-field {
                display: grid;
                gap: 0.75rem;
            }

            .lm-field-group {
                display: grid;
                gap: 1rem;
            }

            @media (min-width: 768px) {
                .lm-field-group.two {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            .lm-form label {
                font-weight: 600;
                color: var(--lm-neutral-700);
            }

            .lm-form input,
            .lm-form textarea,
            .lm-form select {
                width: 100%;
                border-radius: 12px;
                border: 1px solid var(--lm-neutral-200);
                padding: 0.75rem 1rem;
                font-size: 1rem;
                color: var(--lm-neutral-900);
                background-color: #fff;
                transition: border-color 0.2s ease, box-shadow 0.2s ease;
            }

            .lm-form input:focus,
            .lm-form textarea:focus,
            .lm-form select:focus {
                outline: none;
                border-color: var(--lm-brand-600);
                box-shadow: 0 0 0 0.25rem rgba(50, 72, 173, 0.15);
            }

            .lm-form textarea {
                resize: vertical;
            }

            .lm-hero-slabs {
                display: grid;
                gap: 1.25rem;
            }

            .lm-hero-slab {
                background: var(--lm-surface);
                border-radius: var(--lm-radius-md);
                padding: 1.6rem;
                box-shadow: var(--lm-shadow-sm);
                display: grid;
                gap: 1.25rem;
            }

            .lm-hero-slab.lm-hero-slab-dark {
                background: rgba(255, 255, 255, 0.1);
                color: #fff;
                box-shadow: none;
                border: 1px solid rgba(255, 255, 255, 0.18);
            }

            .lm-hero-media {
                position: relative;
            }

            .lm-hero-ring {
                position: absolute;
                inset: -12%;
                border-radius: 50%;
                background: radial-gradient(circle at center, rgba(255, 255, 255, 0.12), transparent 70%);
                z-index: 0;
            }

            .lm-hero-media > * {
                position: relative;
                z-index: 1;
            }

            .lm-quote-card cite {
                font-weight: 600;
                opacity: 0.8;
            }

            .lm-testimonial-grid {
                display: grid;
                gap: 1.5rem;
            }

            @media (min-width: 768px) {
                .lm-testimonial-grid {
                    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                }
            }

            .lm-testimonial-card {
                background: var(--lm-surface);
                border-radius: var(--lm-radius-md);
                padding: 2rem;
                box-shadow: var(--lm-shadow-sm);
                display: grid;
                gap: 1rem;
                position: relative;
            }

            .lm-testimonial-card::before {
                content: '“';
                font-size: 3rem;
                color: var(--lm-brand-600);
                opacity: 0.25;
                position: absolute;
                top: 1rem;
                left: 1.5rem;
            }

            .lm-testimonial-card blockquote {
                margin: 0;
                font-weight: 600;
                color: var(--lm-neutral-900);
            }

            .lm-testimonial-card cite {
                font-style: normal;
                font-weight: 600;
                color: var(--lm-neutral-600);
            }

            .lm-card h3 {
                margin-bottom: 0.5rem;
            }

            .lm-card p:last-child,
            .lm-team-card-body p:last-child {
                margin-bottom: 0;
            }

            .lm-badge + h1,
            .lm-badge + h2,
            .lm-badge + h3 {
                margin-top: 1rem;
            }

            .lm-hero-actions .btn,
            .lm-cta-actions .btn {
                border-radius: 999px;
                padding-inline: 1.6rem;
            }

            .lm-tab-panel .lm-list-steps li {
                background: var(--lm-surface);
            }

            .lm-contact-side {
                display: grid;
                gap: 1.5rem;
            }

            .lm-contact-side .lm-card {
                box-shadow: var(--lm-shadow-sm);
            }

            .lm-contact-side .lm-card.card-outline {
                border: 1px solid var(--lm-neutral-200);
                box-shadow: none;
            }

            .lm-surface-note {
                color: rgba(255, 255, 255, 0.7);
            }

            .lm-media-block {
                display: grid;
                gap: 2rem;
                align-items: center;
            }

            .lm-media-block--align-start {
                align-items: start;
            }

            @media (min-width: 992px) {
                .lm-media-block {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .lm-media-block.lm-media-block--reverse > :first-child {
                    order: 2;
                }
            }

            .lm-media-block figure {
                margin: 0;
                border-radius: var(--lm-radius-lg);
                overflow: hidden;
                box-shadow: var(--lm-shadow-md);
            }

            .lm-media-block img {
                display: block;
                width: 100%;
                height: auto;
            }

            .lm-icon-circle {
                width: 3rem;
                height: 3rem;
                border-radius: 999px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: rgba(50, 72, 173, 0.12);
                color: var(--lm-brand-700);
                font-weight: 700;
                font-size: 1.2rem;
            }

            .lm-partner-logos {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                gap: 1.5rem;
                align-items: center;
                opacity: 0.8;
            }

            .lm-partner-logos img,
            .lm-partner-logos span {
                filter: grayscale(1);
                text-align: center;
            }

            details.lm-job-card,
            details.lm-faq-item {
                border-radius: var(--lm-radius-md);
                border: 1px solid var(--lm-neutral-200);
                background: var(--lm-surface);
                box-shadow: var(--lm-shadow-sm);
                padding: 1.25rem 1.5rem;
                transition: transform 0.25s ease, box-shadow 0.25s ease;
            }

            details.lm-job-card summary,
            details.lm-faq-item summary {
                list-style: none;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                font-weight: 600;
                color: var(--lm-neutral-900);
            }

            details.lm-job-card summary > div {
                display: grid;
                gap: 0.45rem;
            }

            details.lm-job-card summary::-webkit-details-marker,
            details.lm-faq-item summary::-webkit-details-marker {
                display: none;
            }

            details.lm-job-card[open],
            details.lm-faq-item[open] {
                transform: translateY(-3px);
                box-shadow: var(--lm-shadow-md);
                border-color: rgba(63, 151, 213, 0.35);
            }

            .lm-job-card-content,
            .lm-faq-content {
                margin-top: 1rem;
                display: grid;
                gap: 0.75rem;
                color: var(--lm-neutral-600);
            }

            .lm-job-meta {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
                font-size: 0.85rem;
                color: var(--lm-neutral-600);
            }

            .lm-job-list {
                align-items: start;
            }

            details.lm-job-card summary span[aria-hidden="true"] {
                font-size: 1.5rem;
                line-height: 1;
                color: var(--lm-brand-600);
                transition: transform 0.25s ease;
            }

            details.lm-job-card[open] summary span[aria-hidden="true"] {
                transform: rotate(45deg);
            }

            .lm-tag {
                display: inline-flex;
                align-items: center;
                padding: 0.35rem 0.75rem;
                border-radius: 999px;
                background: rgba(63, 151, 213, 0.14);
                color: var(--lm-brand-700);
                font-weight: 600;
                font-size: 0.78rem;
            }

            .lm-map-embed {
                border-radius: var(--lm-radius-md);
                overflow: hidden;
                box-shadow: var(--lm-shadow-md);
                min-height: 260px;
            }

            .lm-map-embed iframe,
            .lm-map-embed img {
                border: 0;
                width: 100%;
                height: 100%;
            }

            .lm-value-grid {
                display: grid;
                gap: 1.5rem;
            }

            @media (min-width: 768px) {
                .lm-value-grid {
                    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                }
            }

            .lm-value-card {
                background: var(--lm-surface);
                border-radius: var(--lm-radius-md);
                padding: 1.75rem;
                box-shadow: var(--lm-shadow-sm);
                display: grid;
                gap: 0.8rem;
            }

            .lm-value-card p {
                margin: 0;
            }

            .lm-highlight-grid {
                display: grid;
                gap: 1.25rem;
            }

            @media (min-width: 768px) {
                .lm-highlight-grid {
                    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                }
            }

            .lm-highlight-card {
                background: rgba(63, 151, 213, 0.12);
                border-radius: var(--lm-radius-md);
                padding: 1.25rem;
                display: grid;
                gap: 0.35rem;
                text-align: center;
            }

            .lm-highlight-card strong {
                font-size: 1.4rem;
                color: var(--lm-brand-700);
            }

            .lm-job-empty {
                text-align: center;
                padding: 2.5rem;
                border-radius: var(--lm-radius-md);
                border: 1px dashed var(--lm-neutral-200);
                background: var(--lm-neutral-100);
                color: var(--lm-neutral-600);
            }
        </style>
    @endpush
@endonce
