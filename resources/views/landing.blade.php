<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>teledermpeds — pediatric dermatology, online</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700&family=Fraunces:opsz,wght,SOFT@9..144,300..600,30..100&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet" />
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="lp-body">

<!-- NAV -->
<nav class="lp-nav">
  <div class="lp-nav__inner">
    <div class="brand">
      <div class="brand__mark">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 21s-7-4.5-7-11a5 5 0 0 1 7-4.5A5 5 0 0 1 19 10c0 6.5-7 11-7 11z" fill="currentColor" stroke="none" opacity="0.25"></path>
          <path d="M8 11.5h2.5l1.5-3 1.5 5 1-2H16"></path>
        </svg>
      </div>
      <span>teledermpeds</span>
    </div>
    <div class="lp-nav__links">
      <a href="#how">How it works</a>
      <a href="#conditions">What we treat</a>
      <a href="#pricing">Pricing</a>
      <a href="#faq">FAQ</a>
      <a href="#about">For doctors</a>
    </div>
    <div class="lp-nav__cta">
      <a href="{{ route('login') }}" class="lp-nav__signin">Sign in</a>
      <a href="{{ route('register') }}" class="btn btn--primary btn--sm">Start a consultation</a>
    </div>
  </div>
</nav>

<!-- HERO -->
<section class="lp-hero">
  <div class="lp-hero__bg"></div>
  <div class="lp-hero__inner">
    <div class="lp-hero__copy">
      <span class="lp-eyebrow">Pediatric dermatology, online</span>
      <h1 class="lp-hero__title">
        Expert care for your child's skin, <em>without the waiting room.</em>
      </h1>
      <p class="lp-hero__sub">
        Send photos and a few details. A board-certified pediatric dermatologist reviews
        the case and sends back a diagnosis and treatment plan — usually within 24 hours.
        No travel, no waiting list, no cold clinic chairs.
      </p>
      <div class="lp-hero__cta">
        <a href="{{ route('register') }}" class="btn btn--primary btn--lg">
          Start a consultation
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"></path></svg>
        </a>
        <a href="#how" class="btn btn--ghost btn--lg">See how it works</a>
      </div>
      <div class="lp-hero__trust">
        <div class="lp-trust-avatars">
          <div class="lp-trust-avatars__a" style="background:#c97a52">MO</div>
          <div class="lp-trust-avatars__a" style="background:#4a5fc8">SC</div>
          <div class="lp-trust-avatars__a" style="background:#5a8a5e">DR</div>
          <div class="lp-trust-avatars__a" style="background:#2f7a7a">AB</div>
          <div class="lp-trust-avatars__a" style="background:#8f4f30">+</div>
        </div>
        <span><strong>12,000+ families</strong> seen since 2024</span>
        <span style="display:inline-flex;align-items:center;gap:6px">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="#d2a046"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"></path></svg>
          <strong>4.9</strong> avg. rating
        </span>
      </div>
    </div>

    <!-- Hero phone visual -->
    <div class="lp-hero__visual">
      <div class="lp-float lp-float--a">
        <div class="lp-float__ico">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path></svg>
        </div>
        <div>
          <div class="lp-float__strong">Avg. 8 hours</div>
          <div class="lp-float__small">to diagnosis</div>
        </div>
      </div>

      <div class="lp-float lp-float--b">
        <div class="lp-float__ico" style="background:#e1f0e5;color:#2f7a4a">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg>
        </div>
        <div>
          <div class="lp-float__strong">Board-certified</div>
          <div class="lp-float__small">pediatric specialists</div>
        </div>
      </div>

      <div class="lp-float lp-float--c">
        <div class="lp-float__ico">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3 4 6v6c0 5 3.5 8.5 8 9 4.5-.5 8-4 8-9V6z"></path></svg>
        </div>
        <div>
          <div class="lp-float__strong">HIPAA secure</div>
          <div class="lp-float__small">End-to-end encrypted</div>
        </div>
      </div>

      <div class="lp-phone">
        <div class="lp-phone__screen">
          <div class="lp-phone__status">
            <span>9:41</span>
            <span style="display:flex;gap:5px;align-items:center">
              <svg width="14" height="10" viewBox="0 0 14 10" fill="currentColor"><rect x="0" y="6" width="2" height="4" rx="0.5"/><rect x="3.5" y="4" width="2" height="6" rx="0.5"/><rect x="7" y="2" width="2" height="8" rx="0.5"/><rect x="10.5" y="0" width="2" height="10" rx="0.5"/></svg>
              <svg width="16" height="10" viewBox="0 0 16 10" fill="none" stroke="currentColor" stroke-width="1"><rect x="0.5" y="0.5" width="13" height="9" rx="2"/><rect x="2" y="2" width="10" height="6" rx="1" fill="currentColor"/><rect x="14" y="3" width="1.5" height="4" rx="0.5" fill="currentColor"/></svg>
            </span>
          </div>
          <div class="lp-phone__head">
            <div class="lp-phone__head-avatar">LP</div>
            <div>
              <div class="lp-phone__head-title">Dr. Lin Patel</div>
              <div class="lp-phone__head-sub">Pediatric Dermatologist · sent your diagnosis</div>
            </div>
          </div>
          <div class="lp-phone__body">
            <div class="lp-phone__photo">
              <svg viewBox="0 0 300 200" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                <defs>
                  <radialGradient id="heroSkin" cx="50%" cy="40%" r="70%">
                    <stop offset="0%" stop-color="#e8b48a"/>
                    <stop offset="80%" stop-color="#c98e6c"/>
                    <stop offset="100%" stop-color="#a06848"/>
                  </radialGradient>
                </defs>
                <rect width="300" height="200" fill="url(#heroSkin)"/>
                <ellipse cx="150" cy="100" rx="45" ry="40" fill="none" stroke="#b65840" stroke-width="7" opacity="0.85"/>
                <ellipse cx="150" cy="100" rx="32" ry="28" fill="#c98e6c" opacity="0.9"/>
                <g opacity="0.18">
                  <circle cx="80" cy="60" r="1" fill="#774a30"/>
                  <circle cx="220" cy="80" r="0.8" fill="#774a30"/>
                  <circle cx="60" cy="150" r="1.2" fill="#774a30"/>
                  <circle cx="240" cy="160" r="0.9" fill="#774a30"/>
                  <circle cx="120" cy="40" r="0.7" fill="#774a30"/>
                </g>
              </svg>
            </div>
            <div class="lp-phone__diag">
              <div class="lp-phone__diag-h">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 3v6a4 4 0 0 0 8 0V3"></path></svg>
                Tinea corporis
                <span class="lp-phone__diag-icd">B35.4</span>
              </div>
              <p>This is ringworm — a common fungal skin infection often picked up from pets. Treatable, not dangerous.</p>
            </div>
            <div class="lp-phone__steps">
              <div class="lp-phone__steps-h">Treatment plan</div>
              <ol>
                <li>Apply clotrimazole 1% twice daily, 4 weeks</li>
                <li>Keep area clean and dry</li>
                <li>Have the cat seen by a vet</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PRESS -->
<section class="lp-press">
  <div class="lp-press__inner">
    <div class="lp-press__label">Featured in</div>
    <div class="lp-press__logos">
      <span class="lp-press__logo" style="font-style:italic">Parents</span>
      <span class="lp-press__logo">The New York Times</span>
      <span class="lp-press__logo">TechCrunch</span>
      <span class="lp-press__logo" style="font-weight:600">FAST COMPANY</span>
      <span class="lp-press__logo">Healthline</span>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="lp-section" id="how">
  <span class="lp-eyebrow">How it works</span>
  <h2 class="lp-h2">Three simple steps, one <em>peace of mind</em>.</h2>
  <p class="lp-lede">Most parents finish the form in under five minutes. From there, a specialist takes over.</p>

  <div class="lp-steps">
    <div class="lp-step">
      <div class="lp-step__visual">
        <div class="lp-svis-upload">
          <div class="lp-svis-upload__zone">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8a2 2 0 0 1 2-2h2l2-2h6l2 2h2a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
          </div>
          <div class="lp-svis-upload__thumbs">
            <div class="lp-svis-upload__thumb">
              <svg viewBox="0 0 300 200" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg"><rect width="300" height="200" fill="#e8b48a"/><ellipse cx="100" cy="90" rx="40" ry="30" fill="#c97a5a" opacity="0.6"/><ellipse cx="200" cy="120" rx="35" ry="25" fill="#c97a5a" opacity="0.55"/></svg>
            </div>
            <div class="lp-svis-upload__thumb">
              <svg viewBox="0 0 300 200" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg"><rect width="300" height="200" fill="#e8b48a"/><ellipse cx="160" cy="100" rx="50" ry="40" fill="#c97a5a" opacity="0.65"/></svg>
            </div>
            <div class="lp-svis-upload__thumb">
              <svg viewBox="0 0 300 200" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg"><rect width="300" height="200" fill="#e8b48a"/><ellipse cx="120" cy="80" rx="20" ry="16" fill="#c97a5a" opacity="0.7"/><ellipse cx="180" cy="110" rx="25" ry="18" fill="#c97a5a" opacity="0.6"/><ellipse cx="100" cy="140" rx="18" ry="14" fill="#c97a5a" opacity="0.5"/></svg>
            </div>
            <div class="lp-svis-upload__thumb" style="border:1.5px dashed var(--border-strong);background:transparent;display:grid;place-items:center;color:var(--ink-3)">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"></path></svg>
            </div>
          </div>
        </div>
      </div>
      <div class="lp-step__num">01</div>
      <h3 class="lp-step__h">Upload photos &amp; tell us about it</h3>
      <p class="lp-step__p">Snap 2–6 clear photos and answer a few questions about symptoms, history, and medications. We strip location data automatically.</p>
    </div>

    <div class="lp-step">
      <div class="lp-step__visual">
        <div class="lp-svis-review">
          <div class="lp-svis-review__photo">
            <svg viewBox="0 0 300 200" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg"><rect width="300" height="200" fill="#c98e6c"/><ellipse cx="180" cy="120" rx="50" ry="38" fill="#b8543e" opacity="0.6"/><ellipse cx="180" cy="115" rx="30" ry="22" fill="#a04030" opacity="0.5"/></svg>
            <div class="lp-svis-review__circle"></div>
          </div>
          <div class="lp-svis-review__field">
            <span class="lp-svis-review__field-tag">L20.9</span>
            <span style="color:var(--ink-2)">Atopic dermatitis</span>
          </div>
          <div class="lp-svis-review__field">
            <span style="color:var(--ink-3)">Severity</span>
            <span style="display:flex;gap:3px;margin-left:auto">
              <span style="width:14px;height:5px;border-radius:3px;background:#6ec07a"></span>
              <span style="width:14px;height:5px;border-radius:3px;background:#b5c067"></span>
              <span style="width:14px;height:5px;border-radius:3px;background:#cfa055"></span>
              <span style="width:14px;height:5px;border-radius:3px;background:var(--border)"></span>
              <span style="width:14px;height:5px;border-radius:3px;background:var(--border)"></span>
            </span>
          </div>
        </div>
      </div>
      <div class="lp-step__num">02</div>
      <h3 class="lp-step__h">A specialist reviews the case</h3>
      <p class="lp-step__p">A board-certified pediatric dermatologist examines the photos, weighs the history, and writes a personalized diagnosis.</p>
    </div>

    <div class="lp-step">
      <div class="lp-step__visual">
        <div class="lp-svis-plan">
          <div class="lp-svis-plan__head">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="m5 12 5 5L20 7"></path></svg>
            Diagnosis received
          </div>
          <div class="lp-svis-plan__line">
            <div class="lp-svis-plan__check"><svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><path d="m5 12 5 5L20 7"></path></svg></div>
            <span>Apply emollient twice daily after bathing</span>
          </div>
          <div class="lp-svis-plan__line">
            <div class="lp-svis-plan__check"><svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><path d="m5 12 5 5L20 7"></path></svg></div>
            <span>Hydrocortisone 1% on flares, max 7 days</span>
          </div>
          <div class="lp-svis-plan__line">
            <div class="lp-svis-plan__check"><svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><path d="m5 12 5 5L20 7"></path></svg></div>
            <span>Lukewarm baths, fragrance-free soap</span>
          </div>
        </div>
      </div>
      <div class="lp-step__num">03</div>
      <h3 class="lp-step__h">Receive a clear diagnosis &amp; plan</h3>
      <p class="lp-step__p">Usually within 24 hours. You'll get a written diagnosis, step-by-step treatment, and follow-up guidance — all saved in your account.</p>
    </div>
  </div>
</section>

<!-- CONDITIONS -->
<section class="lp-section" id="conditions" style="background:var(--bg-elev);max-width:none;border-block:1px solid var(--divider)">
  <div style="max-width:1240px;margin:0 auto">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:end;margin-bottom:8px">
      <div>
        <span class="lp-eyebrow">What we treat</span>
        <h2 class="lp-h2">From mystery rashes to <em>routine check-ins</em>.</h2>
      </div>
      <p class="lp-lede" style="margin-bottom:14px">
        Pediatric dermatology covers a wide range. Below are the conditions we see most often — but if you're not sure, send it anyway. We'll tell you if it needs in-person care.
      </p>
    </div>

    <div class="lp-conditions">
      <div class="lp-cond">
        <div class="lp-cond__photo">
          <svg viewBox="0 0 300 200" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <defs><radialGradient id="cE" cx="50%" cy="40%" r="70%"><stop offset="0%" stop-color="#f4d3b8"/><stop offset="80%" stop-color="#e8b48a"/><stop offset="100%" stop-color="#c98e6c"/></radialGradient></defs>
            <rect width="300" height="200" fill="url(#cE)"/>
            <ellipse cx="90" cy="80" rx="30" ry="22" fill="#c97a5a" opacity="0.55"/>
            <ellipse cx="200" cy="100" rx="40" ry="28" fill="#c97a5a" opacity="0.6"/>
            <ellipse cx="140" cy="150" rx="32" ry="22" fill="#c97a5a" opacity="0.5"/>
            <ellipse cx="240" cy="60" rx="20" ry="14" fill="#c97a5a" opacity="0.5"/>
          </svg>
        </div>
        <div class="lp-cond__body"><h3 class="lp-cond__name">Eczema</h3><p class="lp-cond__sub">Itchy, dry, recurring patches</p></div>
      </div>

      <div class="lp-cond">
        <div class="lp-cond__photo">
          <svg viewBox="0 0 300 200" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <defs><radialGradient id="cR" cx="50%" cy="40%" r="70%"><stop offset="0%" stop-color="#e8b48a"/><stop offset="80%" stop-color="#c98e6c"/><stop offset="100%" stop-color="#a06848"/></radialGradient></defs>
            <rect width="300" height="200" fill="url(#cR)"/>
            <ellipse cx="150" cy="100" rx="42" ry="36" fill="none" stroke="#b65840" stroke-width="7" opacity="0.85"/>
            <ellipse cx="150" cy="100" rx="30" ry="26" fill="#c98e6c" opacity="0.85"/>
          </svg>
        </div>
        <div class="lp-cond__body"><h3 class="lp-cond__name">Ringworm</h3><p class="lp-cond__sub">Ring-shaped scaly patches</p></div>
      </div>

      <div class="lp-cond">
        <div class="lp-cond__photo">
          <svg viewBox="0 0 300 200" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <defs><radialGradient id="cD" cx="50%" cy="40%" r="70%"><stop offset="0%" stop-color="#f4d3b8"/><stop offset="80%" stop-color="#e8b48a"/><stop offset="100%" stop-color="#c98e6c"/></radialGradient></defs>
            <rect width="300" height="200" fill="url(#cD)"/>
            <path d="M30 80 Q150 30 270 80 Q280 150 200 170 Q150 175 100 170 Q20 150 30 80 Z" fill="#d65f5f" opacity="0.45"/>
          </svg>
        </div>
        <div class="lp-cond__body"><h3 class="lp-cond__name">Diaper rash</h3><p class="lp-cond__sub">Persistent or unusual irritation</p></div>
      </div>

      <div class="lp-cond">
        <div class="lp-cond__photo">
          <svg viewBox="0 0 300 200" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <defs><radialGradient id="cM" cx="50%" cy="40%" r="70%"><stop offset="0%" stop-color="#e8b48a"/><stop offset="80%" stop-color="#c98e6c"/><stop offset="100%" stop-color="#a06848"/></radialGradient></defs>
            <rect width="300" height="200" fill="url(#cM)"/>
            <circle cx="80" cy="60" r="7" fill="#f0c9a3" stroke="#a06848" stroke-width="1.2"/>
            <circle cx="120" cy="90" r="8" fill="#f0c9a3" stroke="#a06848" stroke-width="1.2"/>
            <circle cx="170" cy="70" r="6.5" fill="#f0c9a3" stroke="#a06848" stroke-width="1.2"/>
            <circle cx="200" cy="120" r="9" fill="#f0c9a3" stroke="#a06848" stroke-width="1.2"/>
            <circle cx="240" cy="90" r="6" fill="#f0c9a3" stroke="#a06848" stroke-width="1.2"/>
            <circle cx="130" cy="140" r="7" fill="#f0c9a3" stroke="#a06848" stroke-width="1.2"/>
            <circle cx="220" cy="160" r="6" fill="#f0c9a3" stroke="#a06848" stroke-width="1.2"/>
            <circle cx="90" cy="130" r="5.5" fill="#f0c9a3" stroke="#a06848" stroke-width="1.2"/>
          </svg>
        </div>
        <div class="lp-cond__body"><h3 class="lp-cond__name">Molluscum &amp; warts</h3><p class="lp-cond__sub">Common pediatric skin growths</p></div>
      </div>

      <div class="lp-cond">
        <div class="lp-cond__photo">
          <svg viewBox="0 0 300 200" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <defs><radialGradient id="cA" cx="50%" cy="40%" r="70%"><stop offset="0%" stop-color="#f4d3b8"/><stop offset="80%" stop-color="#e8b48a"/><stop offset="100%" stop-color="#c98e6c"/></radialGradient></defs>
            <rect width="300" height="200" fill="url(#cA)"/>
            <circle cx="80" cy="60" r="4" fill="#c54e4e" opacity="0.8"/>
            <circle cx="110" cy="80" r="3.5" fill="#c54e4e" opacity="0.8"/>
            <circle cx="150" cy="60" r="4.5" fill="#c54e4e" opacity="0.8"/>
            <circle cx="180" cy="90" r="3" fill="#c54e4e" opacity="0.8"/>
            <circle cx="210" cy="70" r="4" fill="#c54e4e" opacity="0.8"/>
            <circle cx="100" cy="120" r="3" fill="#c54e4e" opacity="0.8"/>
            <circle cx="140" cy="140" r="4" fill="#c54e4e" opacity="0.8"/>
            <circle cx="190" cy="150" r="3.5" fill="#c54e4e" opacity="0.8"/>
            <circle cx="230" cy="130" r="3" fill="#c54e4e" opacity="0.8"/>
          </svg>
        </div>
        <div class="lp-cond__body"><h3 class="lp-cond__name">Teen acne</h3><p class="lp-cond__sub">From mild breakouts to cystic</p></div>
      </div>

      <div class="lp-cond">
        <div class="lp-cond__photo">
          <svg viewBox="0 0 300 200" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <defs><radialGradient id="cMo" cx="50%" cy="40%" r="70%"><stop offset="0%" stop-color="#f4d3b8"/><stop offset="80%" stop-color="#e8b48a"/><stop offset="100%" stop-color="#c98e6c"/></radialGradient></defs>
            <rect width="300" height="200" fill="url(#cMo)"/>
            <ellipse cx="150" cy="100" rx="32" ry="26" fill="#754725" opacity="0.85"/>
            <ellipse cx="148" cy="97" rx="26" ry="20" fill="#5a3418" opacity="0.7"/>
          </svg>
        </div>
        <div class="lp-cond__body"><h3 class="lp-cond__name">Moles &amp; birthmarks</h3><p class="lp-cond__sub">Check-ins and changes over time</p></div>
      </div>

      <div class="lp-cond">
        <div class="lp-cond__photo">
          <svg viewBox="0 0 300 200" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <defs><radialGradient id="cH" cx="50%" cy="40%" r="70%"><stop offset="0%" stop-color="#f4d3b8"/><stop offset="80%" stop-color="#e8b48a"/><stop offset="100%" stop-color="#c98e6c"/></radialGradient></defs>
            <rect width="300" height="200" fill="url(#cH)"/>
            <ellipse cx="80" cy="70" rx="28" ry="14" fill="#e08a8a" opacity="0.55"/>
            <ellipse cx="170" cy="60" rx="36" ry="18" fill="#e08a8a" opacity="0.5"/>
            <ellipse cx="240" cy="100" rx="26" ry="14" fill="#e08a8a" opacity="0.5"/>
            <ellipse cx="110" cy="130" rx="32" ry="16" fill="#e08a8a" opacity="0.55"/>
            <ellipse cx="200" cy="150" rx="28" ry="14" fill="#e08a8a" opacity="0.5"/>
          </svg>
        </div>
        <div class="lp-cond__body"><h3 class="lp-cond__name">Hives &amp; allergic rashes</h3><p class="lp-cond__sub">Welts that come and go</p></div>
      </div>

      <div class="lp-cond" style="display:flex;flex-direction:column;justify-content:center;align-items:flex-start;padding:24px;background:var(--brand-softer);border-color:var(--brand-soft)">
        <div style="width:48px;height:48px;border-radius:12px;background:var(--brand);color:white;display:grid;place-items:center;margin-bottom:14px">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"></path></svg>
        </div>
        <h3 class="lp-cond__name" style="margin-bottom:8px">Not sure what it is?</h3>
        <p class="lp-cond__sub" style="margin-bottom:16px;color:var(--ink-2)">Send it anyway. We see hundreds of conditions and we'll always tell you when in-person care is needed.</p>
        <a href="{{ route('register') }}" class="btn btn--subtle btn--sm">Start a consultation</a>
      </div>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section class="lp-section" id="why">
  <span class="lp-eyebrow">Why parents choose us</span>
  <h2 class="lp-h2">Built for parents. Reviewed by <em>specialists.</em></h2>

  <div class="lp-features">
    <div class="lp-feature">
      <div class="lp-feature__ico">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3v6a4 4 0 0 0 8 0V3M5 3h2M11 3h2M9 13v3a4 4 0 0 0 8 0v-2"></path><circle cx="17" cy="14" r="2"></circle></svg>
      </div>
      <h3 class="lp-feature__h">Only pediatric dermatologists</h3>
      <p class="lp-feature__p">Children's skin isn't adult skin scaled down. Every case is reviewed by a board-certified pediatric dermatologist with fellowship training in childhood conditions.</p>
    </div>

    <div class="lp-feature">
      <div class="lp-feature__ico">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path></svg>
      </div>
      <h3 class="lp-feature__h">24-hour turnaround</h3>
      <p class="lp-feature__p">Routine cases get a response within 24 hours. Urgent symptoms are flagged immediately and triaged ahead of the queue.</p>
    </div>

    <div class="lp-feature">
      <div class="lp-feature__ico">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3 4 6v6c0 5 3.5 8.5 8 9 4.5-.5 8-4 8-9V6z"></path></svg>
      </div>
      <h3 class="lp-feature__h">HIPAA-compliant &amp; private</h3>
      <p class="lp-feature__p">Photos and records are encrypted end-to-end. Image metadata is stripped on upload. We never sell or share your child's health data.</p>
    </div>

    <div class="lp-feature">
      <div class="lp-feature__ico">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="9" width="18" height="6" rx="3" transform="rotate(-45 12 12)"></rect><path d="m7.5 7.5 9 9"></path></svg>
      </div>
      <h3 class="lp-feature__h">Prescriptions when needed</h3>
      <p class="lp-feature__p">When a prescription is warranted, your doctor can send it directly to your local pharmacy in all 50 states.</p>
    </div>

    <div class="lp-feature">
      <div class="lp-feature__ico">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.4 8.4 0 0 1-1 4 8.5 8.5 0 0 1-7.6 4.5 8.4 8.4 0 0 1-4-1L3 21l1.9-5.4a8.4 8.4 0 0 1-1-4 8.5 8.5 0 0 1 4.5-7.6 8.4 8.4 0 0 1 4-1A8.5 8.5 0 0 1 21 11.5z"></path></svg>
      </div>
      <h3 class="lp-feature__h">Ask follow-up questions</h3>
      <p class="lp-feature__p">If anything in the diagnosis isn't clear, you can reply right inside the case. Your doctor responds within the same business day.</p>
    </div>

    <div class="lp-feature">
      <div class="lp-feature__ico">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><path d="M14 2v6h6M9 13h6M9 17h6"></path></svg>
      </div>
      <h3 class="lp-feature__h">Records, kept forever</h3>
      <p class="lp-feature__p">Every diagnosis, photo, and treatment plan is saved in your account. Download a PDF anytime to share with your pediatrician.</p>
    </div>
  </div>
</section>

<!-- SHOWCASE -->
<section class="lp-showcase">
  <div class="lp-showcase__inner">
    <div>
      <span class="lp-eyebrow">A real diagnosis</span>
      <h2 class="lp-h2">"My daughter scratched all night. By noon, we had <em>answers.</em>"</h2>
      <p class="lp-showcase__lede">
        Maya submitted photos of Zoe's flared eczema at 9pm on a Tuesday.
        By 8am Wednesday, Dr. Patel had reviewed the case, sent a diagnosis, and prescribed a steroid cream — all without a single office visit.
      </p>
      <div style="display:flex;gap:12px">
        <a href="{{ route('register') }}" class="btn btn--primary btn--lg" style="background:white;color:var(--brand-ink)">
          Start your consultation
        </a>
      </div>
    </div>

    <div class="lp-sample">
      <div class="lp-sample__row">
        <div class="lp-sample__avatar">LP</div>
        <div>
          <div class="lp-sample__name">Dr. Lin Patel, MD</div>
          <div class="lp-sample__time">Pediatric Dermatologist · Diagnosed in 11 hours</div>
        </div>
        <span class="badge badge--diagnosed" style="margin-left:auto">Diagnosed</span>
      </div>

      <div class="diagnosis-box" style="margin:0">
        <div class="diagnosis-box__head">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M5 3v6a4 4 0 0 0 8 0V3"></path></svg>
          <h2 class="diagnosis-box__title">Atopic dermatitis flare</h2>
          <span class="diagnosis-box__icd">L20.9</span>
        </div>
        <p style="color:var(--ink-2);margin:0 0 14px;line-height:1.55;font-size:14px">
          Classic flexural distribution and chronic-relapsing pattern with the family history of atopy — this is an eczema flare, not an infection. Below is a plan to settle the acute itch and prevent the next one.
        </p>
        <div class="card card--soft" style="padding:14px">
          <div class="fw-600 text-sm" style="margin-bottom:8px">Treatment plan</div>
          <ol style="margin:0;padding-left:18px;font-size:13px;color:var(--ink-2);display:flex;flex-direction:column;gap:6px">
            <li>Hydrocortisone 1% to affected areas twice daily for up to 7 days</li>
            <li>Thick fragrance-free emollient (CeraVe, Vanicream) within 3 min of bathing</li>
            <li>Lukewarm (not hot) baths, max 10 min, fragrance-free soap</li>
            <li>Return if no improvement in 7 days or if skin becomes weepy or crusted</li>
          </ol>
        </div>
      </div>

      <p class="lp-sample__quote">"Most reassuring 12 hours of my parenting life. Felt like a friend who's also a specialist."</p>
      <div class="lp-sample__row">
        <div class="lp-sample__avatar" style="background:#c97a52">MO</div>
        <div>
          <div class="lp-sample__name">Maya Okafor</div>
          <div class="lp-sample__time">Parent of Zoe, age 4 · Brooklyn, NY</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PRICING -->
<section class="lp-section" id="pricing">
  <div style="text-align:center;display:flex;flex-direction:column;align-items:center;gap:6px;margin-bottom:8px">
    <span class="lp-eyebrow">Pricing</span>
    <h2 class="lp-h2">Specialist care, <em>without specialist prices.</em></h2>
    <p class="lp-lede" style="text-align:center">Pay per visit, or skip the math with our family plan. Most major HSA / FSA cards accepted.</p>
  </div>

  <div class="lp-pricing">
    <div class="lp-price">
      <h3 class="lp-price__name">Single visit</h3>
      <p class="lp-price__desc">For a one-time question or concern.</p>
      <div class="lp-price__amount">
        <span class="lp-price__amount-big">$59</span>
        <span class="lp-price__amount-unit">/ consultation</span>
      </div>
      <ul class="lp-price__feats">
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg> One diagnosis with treatment plan</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg> Response within 24 hours</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg> Up to 3 follow-up questions</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg> Prescriptions when needed</li>
      </ul>
      <a href="{{ route('register') }}" class="btn btn--ghost btn--lg" style="width:100%">Start a visit</a>
    </div>

    <div class="lp-price lp-price--featured">
      <h3 class="lp-price__name">Family</h3>
      <p class="lp-price__desc">For families with kids of any age.</p>
      <div class="lp-price__amount">
        <span class="lp-price__amount-big">$19</span>
        <span class="lp-price__amount-unit">/ month</span>
      </div>
      <ul class="lp-price__feats">
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg> Unlimited consultations</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg> Up to 6 children on one account</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg> Priority queue (avg. 6h response)</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg> Annual skin check for every child</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg> Pediatrician-shareable records</li>
      </ul>
      <a href="{{ route('register') }}" class="btn btn--primary btn--lg" style="width:100%">Start free trial</a>
    </div>

    <div class="lp-price">
      <h3 class="lp-price__name">Clinic</h3>
      <p class="lp-price__desc">For pediatric practices referring out.</p>
      <div class="lp-price__amount">
        <span class="lp-price__amount-big">Custom</span>
      </div>
      <ul class="lp-price__feats">
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg> White-label referral portal</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg> EHR integration (Epic, Cerner)</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg> Dedicated specialist team</li>
        <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"></path></svg> Quarterly outcome reporting</li>
      </ul>
      <a href="mailto:partners@teledermpeds.com" class="btn btn--ghost btn--lg" style="width:100%">Talk to sales</a>
    </div>
  </div>

  <p style="text-align:center;margin-top:32px;color:var(--ink-3);font-size:14px">HSA / FSA accepted · Cancel anytime · No insurance required</p>
</section>

<!-- TESTIMONIALS -->
<section class="lp-section" style="background:var(--bg-elev);max-width:none;border-block:1px solid var(--divider)">
  <div style="max-width:1240px;margin:0 auto">
    <span class="lp-eyebrow">From parents</span>
    <h2 class="lp-h2">A waiting room, but for <em>nobody.</em></h2>

    <div class="lp-testimonials">
      <div class="lp-testimonial">
        <div class="lp-testimonial__stars">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
        </div>
        <p class="lp-testimonial__quote">The nearest pediatric dermatologist had a four-month waiting list. We got an answer overnight, and the treatment cleared in five days. Genuinely don't know what we would have done otherwise.</p>
        <div class="lp-testimonial__author">
          <div class="lp-testimonial__avatar" style="background:#4a5fc8">SC</div>
          <div>
            <div class="lp-testimonial__name">Sarah Chen</div>
            <div class="lp-testimonial__role">Parent of Olivia, age 11</div>
          </div>
        </div>
      </div>

      <div class="lp-testimonial">
        <div class="lp-testimonial__stars">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
        </div>
        <p class="lp-testimonial__quote">As a single dad, I've sent in maybe a dozen things. Half the time the answer is "it'll resolve on its own." That's worth $59 of peace of mind every time.</p>
        <div class="lp-testimonial__author">
          <div class="lp-testimonial__avatar" style="background:#c97a52">DR</div>
          <div>
            <div class="lp-testimonial__name">Daniel Reyes</div>
            <div class="lp-testimonial__role">Parent of Mateo, 8mo</div>
          </div>
        </div>
      </div>

      <div class="lp-testimonial">
        <div class="lp-testimonial__stars">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7 7 .5-5.5 5L18 22l-6-4-6 4 1.5-7.5L2 9.5 9 9z"/></svg>
        </div>
        <p class="lp-testimonial__quote">Dr. Patel caught that what I thought was ringworm was actually from our new cat — and recommended a vet visit alongside the cream. Holistic in the best way.</p>
        <div class="lp-testimonial__author">
          <div class="lp-testimonial__avatar" style="background:#5a8a5e">AB</div>
          <div>
            <div class="lp-testimonial__name">Aisha Bello</div>
            <div class="lp-testimonial__role">Parent of Ifeoma, age 6</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="lp-section lp-section--narrow" id="faq">
  <div style="display:grid;grid-template-columns:1fr 1.4fr;gap:48px;align-items:start">
    <div>
      <span class="lp-eyebrow">FAQ</span>
      <h2 class="lp-h2">Common <em>questions.</em></h2>
      <p class="lp-lede" style="font-size:15px">
        Still wondering? Email us at <a href="mailto:hello@teledermpeds.com" style="color:var(--brand-ink);font-weight:600">hello@teledermpeds.com</a> — we usually reply within an hour.
      </p>
    </div>

    <div class="lp-faq">
      <details class="lp-faq__item" open>
        <summary class="lp-faq__q">Is this a replacement for an in-person dermatologist?<span class="lp-faq__q-ico"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"></path></svg></span></summary>
        <div class="lp-faq__a">For most pediatric skin concerns — rashes, mild infections, eczema, acne, mole checks — yes. For anything requiring a biopsy, procedure, or hands-on exam, we'll tell you directly and help you find local care. About 8% of our cases get referred to in-person.</div>
      </details>

      <details class="lp-faq__item">
        <summary class="lp-faq__q">What ages do you see?<span class="lp-faq__q-ico"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"></path></svg></span></summary>
        <div class="lp-faq__a">Birth through age 18. Our specialists train in pediatric dermatology specifically — newborn skin, toddler rashes, and teen acne all look and behave differently.</div>
      </details>

      <details class="lp-faq__item">
        <summary class="lp-faq__q">How do photos work? Do I need a fancy camera?<span class="lp-faq__q-ico"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"></path></svg></span></summary>
        <div class="lp-faq__a">Any modern smartphone works. We ask for 2–6 photos: a wide shot showing location on the body, close-ups in focus, and ideally one with natural light. The intake form walks you through it.</div>
      </details>

      <details class="lp-faq__item">
        <summary class="lp-faq__q">Do you accept insurance?<span class="lp-faq__q-ico"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"></path></svg></span></summary>
        <div class="lp-faq__a">We're cash-pay for now, but we accept HSA and FSA cards and provide a receipt you can submit to your insurer for out-of-network reimbursement. Most families find the flat $59 cheaper than their copay anyway.</div>
      </details>

      <details class="lp-faq__item">
        <summary class="lp-faq__q">What if it's urgent?<span class="lp-faq__q-ico"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"></path></svg></span></summary>
        <div class="lp-faq__a">Our intake flags urgent symptoms (rapid spread, fever with rash, breathing or swallowing issues) and routes them to the front of the queue. That said: for life-threatening symptoms — breathing difficulty, severe swelling, signs of sepsis — please call 911 or go to the ER. We aren't a substitute for emergency care.</div>
      </details>

      <details class="lp-faq__item">
        <summary class="lp-faq__q">What states do you operate in?<span class="lp-faq__q-ico"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"></path></svg></span></summary>
        <div class="lp-faq__a">All 50 states and D.C. Our specialists hold licenses in every state we serve, and prescriptions are routed to your local pharmacy.</div>
      </details>

      <details class="lp-faq__item">
        <summary class="lp-faq__q">Is my child's data safe?<span class="lp-faq__q-ico"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"></path></svg></span></summary>
        <div class="lp-faq__a">Yes. We're HIPAA-compliant. Photos are encrypted in transit and at rest, location metadata is stripped on upload, and access is limited to the reviewing physician and you. We never sell or share health data with advertisers or third parties.</div>
      </details>
    </div>
  </div>
</section>

<!-- FINAL CTA -->
<section class="lp-cta-final">
  <div class="lp-cta-card">
    <div>
      <h2 class="lp-cta-card__h">Your child's next rash doesn't need to mean <em>a half-day off work.</em></h2>
      <p class="lp-cta-card__sub">Get started in five minutes. Most parents have answers before bedtime tomorrow.</p>
    </div>
    <div style="display:flex;gap:12px;flex-direction:column">
      <a href="{{ route('register') }}" class="btn btn--primary btn--lg">
        Start a consultation
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"></path></svg>
      </a>
      <a href="{{ route('login') }}" class="btn btn--ghost">Sign in to existing account</a>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="lp-footer">
  <div class="lp-footer__inner">
    <div class="lp-footer__brand">
      <div class="brand">
        <div class="brand__mark">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 21s-7-4.5-7-11a5 5 0 0 1 7-4.5A5 5 0 0 1 19 10c0 6.5-7 11-7 11z" fill="currentColor" stroke="none" opacity="0.25"></path>
            <path d="M8 11.5h2.5l1.5-3 1.5 5 1-2H16"></path>
          </svg>
        </div>
        <span>teledermpeds</span>
      </div>
      <p class="lp-footer__tag">Expert pediatric dermatology, delivered online by board-certified specialists across all 50 states.</p>
    </div>
    <div class="lp-footer__col">
      <h4>Product</h4>
      <ul>
        <li><a href="#how">How it works</a></li>
        <li><a href="#conditions">What we treat</a></li>
        <li><a href="#pricing">Pricing</a></li>
        <li><a href="{{ route('login') }}">Sign in</a></li>
      </ul>
    </div>
    <div class="lp-footer__col">
      <h4>Company</h4>
      <ul>
        <li><a href="#">About us</a></li>
        <li><a href="#">Our specialists</a></li>
        <li><a href="#about">For doctors</a></li>
        <li><a href="#">Careers</a></li>
        <li><a href="#">Press</a></li>
      </ul>
    </div>
    <div class="lp-footer__col">
      <h4>Support</h4>
      <ul>
        <li><a href="#faq">FAQ</a></li>
        <li><a href="mailto:hello@teledermpeds.com">Contact us</a></li>
        <li><a href="#">Insurance &amp; HSA</a></li>
        <li><a href="#">Refund policy</a></li>
        <li><a href="#">Status</a></li>
      </ul>
    </div>
  </div>
  <div class="lp-footer__legal">
    <span>&copy; {{ date('Y') }} teledermpeds, inc. — Made with care for kids.</span>
    <div class="lp-footer__legal-links">
      <a href="#">Privacy</a>
      <a href="#">Terms</a>
      <a href="#">HIPAA notice</a>
      <a href="#">Accessibility</a>
    </div>
  </div>
</footer>

<script>
  document.querySelectorAll('.lp-faq__item').forEach(d => {
    d.addEventListener('toggle', () => {
      if (d.open) {
        d.classList.add('is-open');
        document.querySelectorAll('.lp-faq__item').forEach(other => {
          if (other !== d && other.open) {
            other.open = false;
            other.classList.remove('is-open');
          }
        });
      } else {
        d.classList.remove('is-open');
      }
    });
    if (d.open) d.classList.add('is-open');
  });
</script>

</body>
</html>
