@extends('layouts.app')

@section('content')
<div class="page" style="max-width:860px">
    <div class="row" style="margin-bottom:16px">
        <a href="{{ route('cases.index') }}" class="btn btn--ghost btn--sm">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg>
            Back
        </a>
    </div>

    <div class="page__head">
        <div>
            <h1 class="page__title">New consultation</h1>
            <p class="page__sub">A few questions help our pediatric dermatologist review your case accurately.</p>
        </div>
    </div>

    <!-- Step indicator -->
    <ol class="steps" id="step-indicator">
        @foreach(['Photos', 'About this visit', 'Medical history', 'Review & submit'] as $i => $label)
        <li class="step {{ $i === 0 ? 'is-current' : '' }}" id="step-li-{{ $i }}">
            <span class="step__num" id="step-num-{{ $i }}">{{ $i + 1 }}</span>
            <span>{{ $label }}</span>
        </li>
        @endforeach
    </ol>

    <form method="POST" action="{{ route('cases.store') }}" enctype="multipart/form-data" id="intake-form">
        @csrf

        <!-- ===== STEP 0: Photos ===== -->
        <div class="card" id="step-panel-0" style="padding:28px">
            <div style="display:flex;flex-direction:column;gap:20px">
                <div>
                    <h3 class="section-h" style="margin-bottom:6px">Add photos</h3>
                    <p class="muted text-sm" style="margin:0">Add 1–6 clear, in-focus photos. Include both close-ups and a wider shot. Use natural light when possible.</p>
                </div>

                <label class="upload-zone" for="images" id="upload-label">
                    <div class="upload-zone__icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8a2 2 0 0 1 2-2h2l2-2h6l2 2h2a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="12" cy="13" r="4"/></svg>
                    </div>
                    <div class="upload-zone__title">Drop photos here or click to upload</div>
                    <div class="upload-zone__sub">JPEG or PNG, up to 10 MB each. We strip location metadata automatically.</div>
                    <input type="file" name="images[]" id="images" multiple accept="image/jpeg,image/png,image/jpg" style="display:none" onchange="previewImages(this)">
                </label>

                <div id="image-previews" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(110px,1fr));gap:10px;margin-top:4px"></div>

                <div class="callout">
                    <div class="callout__icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3 4 6v6c0 5 3.5 8.5 8 9 4.5-.5 8-4 8-9V6z"/></svg>
                    </div>
                    <div>Photos are encrypted, stored securely, and only visible to the reviewing doctor and you. We never sell or share your child's medical data.</div>
                </div>
            </div>
        </div>

        <!-- ===== STEP 1: About this visit ===== -->
        <div class="card" id="step-panel-1" style="padding:28px;display:none">
            <div style="display:flex;flex-direction:column;gap:18px">
                <h3 class="section-h" style="margin-bottom:0">Tell us about the visit</h3>

                <div class="field-row">
                    <div class="field">
                        <label class="label" for="child_name">Child's name</label>
                        <input class="input" type="text" name="child_name" id="child_name" value="{{ old('child_name') }}" placeholder="e.g. Zoe" required>
                    </div>
                    <div class="field-row" style="align-items:end">
                        <div class="field">
                            <label class="label" for="child_age">Age</label>
                            <input class="input" type="number" name="child_age" id="child_age" value="{{ old('child_age') }}" placeholder="4" min="0" max="18" required>
                        </div>
                        <div class="field">
                            <label class="label" for="child_age_unit">Unit</label>
                            <select class="select" name="child_age_unit" id="child_age_unit">
                                <option value="years" {{ old('child_age_unit') === 'years' ? 'selected' : '' }}>Years</option>
                                <option value="months" {{ old('child_age_unit') === 'months' ? 'selected' : '' }}>Months</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Sex assigned at birth</label>
                    <div class="row" style="gap:8px">
                        <label class="radio {{ old('sex') === 'F' ? 'is-on' : '' }}" style="flex:1;cursor:pointer" onclick="this.classList.toggle('is-on',true);document.getElementById('sex-m-label').classList.remove('is-on')">
                            <input type="radio" name="sex" value="F" {{ old('sex') === 'F' ? 'checked' : '' }}> Female
                        </label>
                        <label class="radio {{ old('sex') === 'M' ? 'is-on' : '' }}" id="sex-m-label" style="flex:1;cursor:pointer" onclick="this.classList.toggle('is-on',true);document.querySelector('[for]').classList.remove('is-on')">
                            <input type="radio" name="sex" value="M" {{ old('sex') === 'M' ? 'checked' : '' }}> Male
                        </label>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="title">What's going on?</label>
                    <input class="input" type="text" name="title" id="title" value="{{ old('title') }}" placeholder="e.g. Persistent itchy patches on inner elbows and behind knees" required>
                    <span class="hint">A short summary in your own words.</span>
                </div>

                <div class="field-row">
                    <div class="field">
                        <label class="label" for="body_location">Where on the body?</label>
                        <input class="input" type="text" name="body_location" id="body_location" value="{{ old('body_location') }}" placeholder="e.g. Inner elbows, behind knees">
                    </div>
                    <div class="field">
                        <label class="label" for="duration">How long has this been going on?</label>
                        <select class="select" name="duration" id="duration">
                            <option value="">Select…</option>
                            @foreach(['Less than 3 days','About a week','2–3 weeks','1–3 months','More than 3 months'] as $d)
                            <option value="{{ $d }}" {{ old('duration') === $d ? 'selected' : '' }}>{{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label class="label">What symptoms do you notice? <span class="muted" style="font-weight:400">(select all that apply)</span></label>
                    <div class="chip-group" id="symptom-chips">
                        @foreach(['Itching','Pain','Burning','Dryness','Bumps','Redness','Scaling','Bleeding','Pus / discharge','Swelling','Spreading','Fever'] as $s)
                        <button type="button" class="chip {{ in_array($s, old('symptoms', [])) ? 'is-on' : '' }}" onclick="toggleChip(this, '{{ $s }}')">{{ $s }}</button>
                        @endforeach
                    </div>
                    <div id="symptom-inputs"></div>
                </div>

                <div class="field">
                    <label class="label">How bothersome is it for your child?</label>
                    <div class="severity" id="severity-widget">
                        @for($i = 1; $i <= 5; $i++)
                        <button type="button" class="severity__dot" id="sev-dot-{{ $i }}" onclick="setSeverity({{ $i }})"></button>
                        @endfor
                        <span class="severity__label" id="sev-label"></span>
                    </div>
                    <input type="hidden" name="severity" id="severity-val" value="{{ old('severity', '') }}">
                </div>

                <div class="field">
                    <label class="label" for="additional_notes">Anything else?</label>
                    <textarea class="textarea" name="additional_notes" id="additional_notes" placeholder="What makes it better or worse? Anything you've already tried?">{{ old('additional_notes') }}</textarea>
                </div>
            </div>
        </div>

        <!-- ===== STEP 2: Medical history ===== -->
        <div class="card" id="step-panel-2" style="padding:28px;display:none">
            <div style="display:flex;flex-direction:column;gap:18px">
                <div>
                    <h3 class="section-h" style="margin-bottom:0">Medical history</h3>
                    <p class="muted text-sm" style="margin:0">Helps your doctor make a safer, more accurate diagnosis. Leave blank if nothing applies.</p>
                </div>

                <div class="field">
                    <label class="label" for="medications">Current medications</label>
                    <textarea class="textarea" name="medications" id="medications" placeholder="e.g. Cetirizine 5mg daily, vitamin D drops">{{ old('medications') }}</textarea>
                </div>
                <div class="field">
                    <label class="label" for="allergies">Allergies</label>
                    <textarea class="textarea" name="allergies" id="allergies" placeholder="Food, medication, environmental — and how severe.">{{ old('allergies') }}</textarea>
                </div>
                <div class="field">
                    <label class="label" for="prior_conditions">Other diagnosed conditions</label>
                    <textarea class="textarea" name="prior_conditions" id="prior_conditions" placeholder="e.g. Asthma, eczema history, congenital conditions">{{ old('prior_conditions') }}</textarea>
                </div>
                <div class="field">
                    <label class="label" for="family_history">Relevant family history</label>
                    <textarea class="textarea" name="family_history" id="family_history" placeholder="e.g. Atopic dermatitis (mother), psoriasis (uncle)">{{ old('family_history') }}</textarea>
                </div>
            </div>
        </div>

        <!-- ===== STEP 3: Review & submit ===== -->
        <div class="card" id="step-panel-3" style="padding:28px;display:none">
            <div style="display:flex;flex-direction:column;gap:18px">
                <h3 class="section-h" style="margin-bottom:0">Review and submit</h3>

                <div class="card card--soft" style="padding:16px">
                    <div class="row" style="margin-bottom:10px">
                        <span class="fw-600">Photos</span>
                        <span class="spacer"></span>
                        <button type="button" class="btn btn--ghost btn--sm" onclick="goToStep(0)">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17.5V21h3.5L17 10.5 13.5 7zM14.5 6 18 9.5"/></svg> Edit
                        </button>
                    </div>
                    <div id="review-photos" style="display:flex;gap:8px;flex-wrap:wrap"></div>
                    <p class="muted text-sm" id="review-no-photos">No photos added yet.</p>
                </div>

                <div class="card card--soft" style="padding:16px">
                    <div class="row" style="margin-bottom:12px">
                        <span class="fw-600">About the visit</span>
                        <span class="spacer"></span>
                        <button type="button" class="btn btn--ghost btn--sm" onclick="goToStep(1)">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17.5V21h3.5L17 10.5 13.5 7zM14.5 6 18 9.5"/></svg> Edit
                        </button>
                    </div>
                    <dl class="kv" id="review-visit"></dl>
                </div>

                <div class="card card--soft" style="padding:16px">
                    <div class="row" style="margin-bottom:12px">
                        <span class="fw-600">Medical history</span>
                        <span class="spacer"></span>
                        <button type="button" class="btn btn--ghost btn--sm" onclick="goToStep(2)">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17.5V21h3.5L17 10.5 13.5 7zM14.5 6 18 9.5"/></svg> Edit
                        </button>
                    </div>
                    <dl class="kv" id="review-history"></dl>
                </div>

                <label class="checkbox" id="consent-label" onclick="toggleConsent(this)">
                    <input type="checkbox" name="consent" id="consent" style="accent-color:var(--brand)">
                    <div>
                        <div class="fw-600 text-sm">I understand and consent</div>
                        <div class="text-sm muted">
                            This is a non-emergency consultation. If symptoms are severe or worsening rapidly, I will seek in-person care.
                            I authorize teledermpeds to share these photos and details with a licensed pediatric dermatologist for diagnosis and treatment.
                        </div>
                    </div>
                </label>
            </div>
        </div>

        <!-- Navigation footer -->
        <div class="row" style="margin-top:20px;padding-top:20px">
            <button type="button" class="btn btn--ghost" id="btn-back" onclick="goToStep(currentStep - 1)" style="visibility:hidden">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg> Back
            </button>
            <span class="muted text-sm" id="step-counter">Step 1 of 4</span>
            <span class="spacer"></span>
            <button type="button" class="btn btn--primary" id="btn-next" onclick="goToStep(currentStep + 1)">
                Continue
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
            </button>
            <button type="submit" class="btn btn--primary btn--lg" id="btn-submit" style="display:none" disabled>
                Submit consultation
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
            </button>
        </div>
    </form>
</div>

<script>
let currentStep = 0;
const TOTAL = 4;
const sevLabels = ['', 'Mild', 'Mild-Mod', 'Moderate', 'Mod-Severe', 'Severe'];
let selectedSymptoms = [];
let severity = 0;
let previewFiles = [];

function goToStep(n) {
    if (n < 0 || n >= TOTAL) return;
    document.getElementById('step-panel-' + currentStep).style.display = 'none';
    document.getElementById('step-li-' + currentStep).classList.remove('is-current');
    if (n > currentStep) document.getElementById('step-li-' + currentStep).classList.add('is-done');
    else document.getElementById('step-li-' + currentStep).classList.remove('is-done');

    currentStep = n;
    document.getElementById('step-panel-' + currentStep).style.display = '';
    document.getElementById('step-li-' + currentStep).classList.add('is-current');

    document.getElementById('btn-back').style.visibility = currentStep > 0 ? 'visible' : 'hidden';
    document.getElementById('btn-next').style.display = currentStep < TOTAL - 1 ? '' : 'none';
    document.getElementById('btn-submit').style.display = currentStep === TOTAL - 1 ? '' : 'none';
    document.getElementById('step-counter').textContent = 'Step ' + (currentStep + 1) + ' of ' + TOTAL;

    if (currentStep === TOTAL - 1) populateReview();
}

function toggleChip(el, name) {
    const idx = selectedSymptoms.indexOf(name);
    if (idx === -1) { selectedSymptoms.push(name); el.classList.add('is-on'); }
    else { selectedSymptoms.splice(idx, 1); el.classList.remove('is-on'); }
    syncSymptomInputs();
}
function syncSymptomInputs() {
    const c = document.getElementById('symptom-inputs');
    c.innerHTML = selectedSymptoms.map(s => `<input type="hidden" name="symptoms[]" value="${s}">`).join('');
}

function setSeverity(v) {
    severity = v;
    document.getElementById('severity-val').value = v;
    document.getElementById('sev-label').textContent = sevLabels[v] || '';
    for (let i = 1; i <= 5; i++) {
        const d = document.getElementById('sev-dot-' + i);
        d.className = 'severity__dot' + (i <= v ? ' active-' + v : '');
    }
}

function toggleConsent(label) {
    const cb = document.getElementById('consent');
    cb.checked = !cb.checked;
    label.classList.toggle('is-on', cb.checked);
    document.getElementById('btn-submit').disabled = !cb.checked;
}

function previewImages(input) {
    const container = document.getElementById('image-previews');
    container.innerHTML = '';
    previewFiles = Array.from(input.files);
    previewFiles.forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.style.cssText = 'aspect-ratio:1;border-radius:var(--r-md);overflow:hidden;background:var(--brand-softer)';
            div.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover">`;
            container.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

function populateReview() {
    // Photos
    const rp = document.getElementById('review-photos');
    const rnp = document.getElementById('review-no-photos');
    rp.innerHTML = '';
    if (previewFiles.length) {
        rnp.style.display = 'none';
        previewFiles.forEach(file => {
            const reader = new FileReader();
            reader.onload = e => {
                const d = document.createElement('div');
                d.style.cssText = 'width:64px;height:64px;border-radius:8px;overflow:hidden';
                d.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover">`;
                rp.appendChild(d);
            };
            reader.readAsDataURL(file);
        });
    } else { rnp.style.display = ''; }

    // Visit
    const rv = document.getElementById('review-visit');
    const val = id => document.getElementById(id)?.value || '—';
    rv.innerHTML = `
        <dt>Patient</dt><dd>${val('child_name')}, ${val('child_age')} ${val('child_age_unit')}</dd>
        <dt>Summary</dt><dd>${val('title') || '—'}</dd>
        <dt>Location</dt><dd>${val('body_location') || '—'}</dd>
        <dt>Duration</dt><dd>${val('duration') || '—'}</dd>
        <dt>Symptoms</dt><dd>${selectedSymptoms.join(', ') || '—'}</dd>
        <dt>Severity</dt><dd>${sevLabels[severity] || '—'}</dd>
    `;

    // History
    const rh = document.getElementById('review-history');
    rh.innerHTML = `
        <dt>Medications</dt><dd>${val('medications') || 'None'}</dd>
        <dt>Allergies</dt><dd>${val('allergies') || 'None'}</dd>
        <dt>Conditions</dt><dd>${val('prior_conditions') || 'None'}</dd>
        <dt>Family</dt><dd>${val('family_history') || 'None'}</dd>
    `;
}

// Init
goToStep(0);
</script>

<style>
.radio { display:flex;align-items:center;gap:10px;padding:10px 12px;border:1px solid var(--border);border-radius:var(--r-sm);background:var(--card);transition:border-color 0.12s,background 0.12s;font-size:14px; }
.radio.is-on { border-color:var(--brand);background:var(--brand-softer); }
.checkbox { display:flex;align-items:flex-start;gap:10px;padding:10px 12px;border:1px solid var(--border);border-radius:var(--r-sm);background:var(--card);transition:border-color 0.12s,background 0.12s;font-size:14px;cursor:pointer; }
.checkbox.is-on { border-color:var(--brand);background:var(--brand-softer); }
</style>
@endsection
