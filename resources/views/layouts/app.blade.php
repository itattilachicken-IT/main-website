
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Include default head partial --}}
    @include('partials.head')

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Allow custom styles from child templates --}}
    @stack('styles')
</head>

<body style="background-color: #f8f8f8;">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Search Form --}}
    @include('partials.search')

    {{-- Main Content --}}
    <main class>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Scripts --}}
    @include('partials.scripts')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Allow custom scripts from child templates --}}
    @stack('scripts')
    
    <script type="module">
    import mermaid from 'https://cdn.jsdelivr.net/npm/mermaid@10/dist/mermaid.esm.min.mjs';
    mermaid.initialize({ startOnLoad: true });
</script>
@php
    $cookiePreferences = null;
    if (request()->hasCookie('cookie_preferences')) {
        $cookiePreferences = json_decode(request()->cookie('cookie_preferences'), true);
    }
@endphp

@if(!$cookiePreferences)
<style>
    /* Box-sizing fix */
    #cookie-banner, #cookie-banner * {
        box-sizing: border-box;
    }

    /* Cookie Banner */
    #cookie-banner {
        background-color: var(--brand-black);
        color: #fff;
        z-index: 1100;
        padding: 0.75rem 1rem;
        font-size: 0.85rem;
        line-height: 1.4;
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        gap: 0.5rem;
        box-shadow: 0 -2px 8px rgba(0,0,0,0.2);
        width: 100vw;
        max-width: 100%;
        overflow: hidden;
        word-wrap: break-word;

        /* Slide-up animation */
        transform: translateY(100%);
        transition: transform 0.5s ease-in-out;
    }

    #cookie-banner.show {
        transform: translateY(0);
    }

    #cookie-banner p {
        margin: 0;
        flex-grow: 1;
        word-break: break-word;
        overflow-wrap: break-word;
    }

    #cookie-banner .d-flex {
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-left: auto;
    }

    #cookie-banner .btn {
        flex-shrink: 0;
        font-size: 0.85rem;
        padding: 0.375rem 0.75rem;
    }

    #cookie-banner .btn-accept {
        background-color: var(--brand-red);
        border-color: var(--brand-red);
        color: #fff;
    }
    #cookie-banner .btn-accept:hover {
        background-color: #cc0000;
        border-color: #cc0000;
    }

    #cookie-banner .btn-settings {
        background-color: var(--brand-yellow);
        border-color: var(--brand-yellow);
        color: #000;
    }
    #cookie-banner .btn-settings:hover {
        background-color: #e6b800;
        border-color: #e6b800;
        color: #000;
    }

    /* Close button visible */
    #cookie-banner .btn-close {
        filter: invert(1);
        width: 1rem;
        height: 1rem;
        padding: 0;
        margin-left: 0.5rem;
        align-self: start;
    }

    /* Modal Styles */
    #cookie-settings .modal-content {
        border-radius: 0.5rem;
    }
    #cookie-settings .modal-header {
        background-color: var(--brand-red);
        color: #fff;
    }
    #cookie-settings .modal-footer {
        background-color: var(--light-gray);
    }
    #cookie-settings .btn-primary {
        background-color: var(--brand-red);
        border-color: var(--brand-red);
        color: #fff;
    }
    #cookie-settings .btn-primary:hover {
        background-color: #cc0000;
        border-color: #cc0000;
    }
    #cookie-settings .btn-secondary {
        background-color: var(--brand-yellow);
        border-color: var(--brand-yellow);
        color: #000;
    }
    #cookie-settings .btn-secondary:hover {
        background-color: #e6b800;
        border-color: #e6b800;
        color: #000;
    }

    /* Mobile adjustments */
    @media (max-width: 575.98px) {
        #cookie-banner p {
            font-size: 0.8rem;
        }
        #cookie-banner .d-flex {
            flex-direction: column;
            width: 100%;
        }
        #cookie-banner .btn {
            width: 100%;
        }

        /* Prevent background jump when modal opens */
        body.modal-open {
            overflow: hidden;
            position: fixed;
            width: 100%;
            padding-right: 0 !important;
        }
    }
</style>

<!-- Cookie Banner -->
<div id="cookie-banner" class="position-fixed bottom-0 start-0">
    <p>
        We use cookies to improve your experience and support marketing. Accept all or manage your preferences.
    </p>

    <div class="d-flex">
        <button type="button" onclick="acceptAllCookies()" class="btn btn-accept btn-sm">Accept all</button>
        <button type="button" onclick="openCookieSettings()" class="btn btn-settings btn-sm">Settings</button>
    </div>

    <button type="button" id="cookie-banner-close" class="btn-close ms-2" aria-label="Close"></button>
</div>

<!-- Cookie Modal -->
<div class="modal fade" id="cookie-settings" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cookie & Privacy Preferences</h5>
        <button type="button" class="btn-close" onclick="closeCookieSettings()"></button>
      </div>
      <div class="modal-body">
        <form id="cookie-form">
          <h6>Cookies</h6>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" checked disabled id="necessaryCookies">
            <label class="form-check-label" for="necessaryCookies">Necessary cookies (required)</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="analytics" id="analyticsCookies">
            <label class="form-check-label" for="analyticsCookies">Analytics cookies</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="marketing" id="marketingCookies">
            <label class="form-check-label" for="marketingCookies">Marketing cookies</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="preferences" id="preferenceCookies">
            <label class="form-check-label" for="preferenceCookies">Preference cookies</label>
          </div>

          <hr>

          <h6>Privacy</h6>
         <div class="form-check">
    <input class="form-check-input" type="checkbox" name="email_marketing" id="emailMarketing">
    <label class="form-check-label" for="emailMarketing">
        Receive emails about new products, promotions, and special offers from Attila Chicken
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" name="personalization" id="personalization">
    <label class="form-check-label" for="personalization">
        Allow Attila Chicken to personalize your website experience and recommendations
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" name="data_sharing" id="dataSharing">
    <label class="form-check-label" for="dataSharing">
        Share anonymized data with trusted partners to improve products and services
    </label>
</div>

        </form>
      </div>
      <div class="modal-footer" id="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeCookieSettings()">Close</button>
        <button type="submit" class="btn btn-primary" form="cookie-form">Save Preferences</button>
      </div>
    </div>
  </div>
</div>

<script>
// Fix banner width and slide-up animation
function fixBannerWidth() {
    const banner = document.getElementById('cookie-banner');
    if (banner) {
        banner.style.width = document.body.clientWidth + 'px';
        setTimeout(() => banner.classList.add('show'), 100);
    }
}
window.addEventListener('DOMContentLoaded', fixBannerWidth);
window.addEventListener('resize', fixBannerWidth);

// Modal offset adjustment (top and bottom)
function adjustModalMargin() {
    const banner = document.getElementById('cookie-banner');
    const modalDialog = document.querySelector('#cookie-settings .modal-dialog');
    if (banner && modalDialog) {
        const bannerHeight = banner.offsetHeight;
        modalDialog.style.marginBottom = bannerHeight + 16 + 'px';
        modalDialog.style.marginTop = bannerHeight + 16 + 'px';
    }
}

// Open and close modal
function openCookieSettings() {
    adjustModalMargin();
    const modalEl = document.getElementById('cookie-settings');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
}
function closeCookieSettings() {
    const modalEl = document.getElementById('cookie-settings');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.hide();
}
window.addEventListener('resize', adjustModalMargin);

// Accept all cookies
function acceptAllCookies() {
    saveCookiePreferences({
        analytics: true,
        marketing: true,
        preferences: true,
        email_marketing: true,
        personalization: true,
        data_sharing: true
    });
}

// Save preferences from form
document.getElementById('cookie-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    saveCookiePreferences({
        analytics: this.analytics?.checked || false,
        marketing: this.marketing?.checked || false,
        preferences: this.preferences?.checked || false,
        email_marketing: this.email_marketing?.checked || false,
        personalization: this.personalization?.checked || false,
        data_sharing: this.data_sharing?.checked || false
    });
});

// Save preferences via POST
function saveCookiePreferences(data) {
    fetch("{{ route('cookie.consent') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    }).finally(() => location.reload());
}

// Close banner with slide-down animation
document.getElementById('cookie-banner-close').addEventListener('click', function() {
    const banner = document.getElementById('cookie-banner');
    banner.style.transition = 'transform 0.5s ease-in-out, opacity 0.5s ease-in-out';
    banner.style.transform = 'translateY(100%)';
    banner.style.opacity = '0';
    fetch("{{ route('cookie.consent') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ dismissed: true })
    });
    setTimeout(() => banner.style.display = 'none', 500);
});
</script>
@endif

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.3/dist/signature_pad.umd.min.js"></script>

</body>
</html>
