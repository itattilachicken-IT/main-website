@extends('EventInvitations::layout')

@section('invite-content')

<canvas id="fireworks-bg"
        style="position: fixed; inset: 0; width: 100%; height: 100%; z-index: 0; pointer-events: none;"></canvas>

<div class="rsvp-wrapper d-flex justify-content-center align-items-center py-4"
     style="position: relative; z-index: 2; min-height: 100vh;">
    <div class="rsvp-container mx-auto" style="max-width:960px;">

        <div class="banner-wrapper mb-2 fade-in">
            <img src="{{ asset('images/attilalaunch.webp') }}" 
                 alt="Event Banner" 
                 class="event-banner" 
                 style="width:100%; height:auto; max-height:300px; object-fit:cover; border-radius:5px;">
        </div>

        <div class="card border-0 mx-auto fade-in"
             style="max-width: 800px; border-radius: 16px; overflow: hidden; background: #fff;
                    position: relative; box-shadow: 0 10px 28px rgba(0,0,0,0.25);">
            <div style="position: absolute; inset: 0; background: url('/images/attila-logo-watermark.png') center/250px no-repeat; opacity: 0.06; z-index: 0;"></div>

            <div class="card-body px-3 py-4 position-relative invitation-text" 
                 style="z-index: 4; background-color: var(--light-gray);">

                <div class="text-center mb-3">
                    <h2 style="font-family:'Mileast', sans-serif; font-size:2rem; color:var(--brand-red);">
                        RSVP for {{ $event->name }}
                    </h2>
                    <p style="font-family:'Great Vibes', cursive; font-size:1.6rem; color:var(--brand-black);">
                        Hello <strong>{{ $invite->guest_name }}</strong>, please confirm your attendance below.
                    </p>
                </div>

                <form method="POST" action="{{ route('rsvp.submit', $invite->token) }}" class="rsvp-form mx-auto" style="max-width:500px;">
                    @csrf

<div class="mb-3">
    <style>
        /* Make radio buttons bigger with a colored border */
        .form-check-input {
            width: 28px;
            height: 28px;
            cursor: pointer;
            border: 3px solid #C21807; /* Red border */
            border-radius: 50%;         /* Circle shape */
            background-color: #fff;
            transition: all 0.2s ease-in-out;
        }

        /* Highlight when selected */
        .form-check-input:checked {
            background-color: #C21807;
            border-color: #C21807;
        }

        /* Make labels bigger and clickable */
        .form-check-label {
            font-size: 1.4rem;
            font-weight: 600;
            cursor: pointer;
            margin-left: 12px;
        }

        /* Optional: add hover effect on the radio button itself */
        .form-check-input:hover {
            border-color: #FFD84C;  /* yellow highlight on hover */
        }
    </style>

    <div class="form-check mb-2">
        <input class="form-check-input" type="radio" name="status" id="attend" value="accepted" required
            {{ old('status', $invitation->status ?? '') == 'accepted' ? 'checked' : '' }}>
        <label class="form-check-label" for="attend">
            ✅ I’ll Attend
        </label>
    </div>

    <div class="form-check mb-2">
        <input class="form-check-input" type="radio" name="status" id="decline" value="declined"
            {{ old('status', $invitation->status ?? '') == 'declined' ? 'checked' : '' }}>
        <label class="form-check-label" for="decline">
            ❌ I can’t make it
        </label>
    </div>
</div>



                    <div id="rsvp-details" class="fade-section hidden">
                        <div class="form-group" id="date-section">
                            <label class="section-title text-center d-block mb-2" style="font-size:1.4rem; color:var(--brand-red); font-family:'Mileast',sans-serif;">Select Event Date(s)</label>

                            <div class="event-day mb-3">
                                <h4 class="event-day-title d-flex justify-content-between align-items-center"
                                    style="background:linear-gradient(90deg,#fff8e1,#fff);border-left:4px solid var(--brand-yellow);
                                           padding:0.6rem 1rem;border-radius:8px;margin-bottom:0.8rem;">
                                    <span class="event-date" style="font-weight:700;color:var(--brand-red);">Friday, November 28</span>
                                    <span class="event-ribbon" style="background:var(--brand-yellow);color:var(--brand-black);
                                            font-weight:600;padding:0.25rem 0.6rem;border-radius:6px;font-size:0.8rem;">Day 1</span>
                                </h4>

                                <div class="event-card position-relative p-3 rounded" 
                                     style="background:var(--light-gray);border:1px solid #eee;box-shadow:0 2px 6px rgba(0,0,0,0.05);transition:all 0.3s ease;">
                                    <input type="checkbox" class="event-checkbox position-absolute" 
                                           style="top:1rem;right:1rem;width:1.1rem;height:1.1rem;cursor:pointer;accent-color:var(--brand-yellow);"
                                           id="date_28" name="event_dates[]" value="October 28">
                                    <label for="date_28" class="event-label d-block">
                                        <div class="event-header d-flex align-items-center gap-2 mb-1">
                                            <i class="fa-solid fa-utensils event-icon" style="color:var(--brand-red);"></i>
                                            <h5 class="event-name mb-0" style="font-weight:700;font-size:1.05rem;">Attila Menu Tasting</h5>
                                        </div>
                                        <p class="event-desc ms-4 mb-2" style="font-size:0.95rem;color:#444;">
                                            A fine-dining showcase featuring chef-led tasting sessions and curated wine pairings.
                                        </p>
                                        <div class="event-header d-flex align-items-center gap-2 mb-1">
                                            <i class="fa-solid fa-golf-ball-tee event-icon" style="color:var(--brand-red);"></i>
                                            <h5 class="event-name mb-0" style="font-weight:700;font-size:1.05rem;">Golf Tournament</h5>
                                        </div>
                                        <p class="event-desc ms-4 mb-0" style="font-size:0.95rem;color:#444;">
                                            A friendly golf tournament sponsored by <strong>Attila Chicken</strong>.
                                        </p>
                                    </label>
                                </div>
                            </div>

                            <div class="event-day">
                                <h4 class="event-day-title d-flex justify-content-between align-items-center"
                                    style="background:linear-gradient(90deg,#fff8e1,#fff);border-left:4px solid var(--brand-yellow);
                                           padding:0.6rem 1rem;border-radius:8px;margin-bottom:0.8rem;">
                                    <span class="event-date" style="font-weight:700;color:var(--brand-red);">Saturday, November 29</span>
                                    <span class="event-ribbon" style="background:linear-gradient(45deg,#ffe066,#fff0b3);color:var(--brand-black);
                                            font-weight:600;padding:0.25rem 0.6rem;border-radius:6px;font-size:0.8rem;">Day 2</span>
                                </h4>

                                <div class="event-card position-relative p-3 rounded" 
                                     style="background:var(--light-gray);border:1px solid #eee;box-shadow:0 2px 6px rgba(0,0,0,0.05);transition:all 0.3s ease;">
                                    <input type="checkbox" class="event-checkbox position-absolute" 
                                           style="top:1rem;right:1rem;width:1.1rem;height:1.1rem;cursor:pointer;accent-color:var(--brand-yellow);"
                                           id="date_29" name="event_dates[]" value="October 29">
                                    <label for="date_29" class="event-label d-block">
                                        <div class="event-header d-flex align-items-center gap-2 mb-1">
                                            <i class="fa-solid fa-champagne-glasses event-icon" style="color:var(--brand-red);"></i>
                                            <h5 class="event-name mb-0" style="font-weight:700;font-size:1.05rem;">Investors’ Attila Chicken Launch Event</h5>
                                        </div>
                                        <p class="event-desc ms-4 mb-0" style="font-size:0.95rem;color:#444;">
                                            Celebrate the official Attila Chicken Launch — an exclusive evening for investors, media, and partners.
                                        </p>
                                    </label>
                                </div>
                            </div>

                            <div class="text-danger mt-2" id="event-error" style="display:none;font-size:0.95rem;">Please select at least one event date.</div>
                        </div>

                        <div class="form-group mt-3">
                            <label style="font-family:'Mileast',sans-serif;font-weight:500;">Will you attend alone or with a group?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="attendance_type" id="alone" value="alone" checked>
                                <label class="form-check-label" for="alone">Alone</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="attendance_type" id="group" value="group">
                                <label class="form-check-label" for="group">With a group</label>
                            </div>
                        </div>

                        <div class="form-group hidden fade-section mt-2" id="group-size-section">
                            <label for="group_size" style="font-family:'Mileast',sans-serif;font-weight:500;">How many people (including you)?</label>
                            <input type="number" name="group_size" id="group_size" min="2" max="20" placeholder="e.g. 5"
                                   style="width:100%;padding:0.5rem;border-radius:6px;border:1px solid #ccc;font-size:1rem;">
                            <div class="text-danger mt-1" id="group-error" style="display:none;font-size:0.95rem;">Please enter a valid group size (2 or more).</div>
                        </div>
                    </div>

                    <button type="submit"
                            class="btn btn-lg fw-semibold mt-4 w-100"
                            style="background: var(--brand-yellow); color: var(--brand-black);
                                   border-radius: 10px; padding:0.8rem 1.5rem; font-size:1.1rem; transition: all 0.3s ease;">
                        Submit RSVP
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link href="https://fonts.cdnfonts.com/css/mileast" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root {
    --brand-red: #C21807;
    --brand-yellow: #FFD84C;
    --brand-black: #222;
    --light-gray: #fdfdfd;
}
body {
    background: radial-gradient(circle at center, #fdfdfd 30%, #f8f8f8 100%);
    margin: 0;
    overflow-x: hidden;
}
.fade-in {
    animation: fadeInUp 1s ease-out;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.hidden { display: none; }
.fade-section { transition: opacity 0.4s ease; opacity: 1; }
.fade-section.hidden { opacity: 0; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const attend = document.getElementById('attend');
    const decline = document.getElementById('decline');
    const details = document.getElementById('rsvp-details');
    const group = document.getElementById('group');
    const alone = document.getElementById('alone');
    const groupSec = document.getElementById('group-size-section');

    attend.addEventListener('change', () => details.classList.remove('hidden'));
    decline.addEventListener('change', () => {
        details.classList.add('hidden');
        groupSec.classList.add('hidden');
        document.getElementById('event-error').style.display = 'none';
        document.getElementById('group-error').style.display = 'none';
    });
    group.addEventListener('change', () => groupSec.classList.remove('hidden'));
    alone.addEventListener('change', () => groupSec.classList.add('hidden'));

    // Form validation
    const form = document.querySelector('.rsvp-form');
    form.addEventListener('submit', function(e) {
        let valid = true;

        // Reset errors
        document.getElementById('event-error').style.display = 'none';
        document.getElementById('group-error').style.display = 'none';

        if (attend.checked) {
            const selectedEvents = document.querySelectorAll('input[name="event_dates[]"]:checked');
            if (selectedEvents.length === 0) {
                document.getElementById('event-error').style.display = 'block';
                valid = false;
            }

            if (group.checked) {
                const groupSize = document.getElementById('group_size').value;
                if (!groupSize || parseInt(groupSize) < 2) {
                    document.getElementById('group-error').style.display = 'block';
                    valid = false;
                }
            }
        }

        if (!valid) e.preventDefault();
    });
});

// Fireworks canvas animation
(function(){
  const canvas = document.getElementById('fireworks-bg');
  const ctx = canvas.getContext('2d');

  function fitCanvas() {
    canvas.width = window.innerWidth * devicePixelRatio;
    canvas.height = window.innerHeight * devicePixelRatio;
    ctx.setTransform(devicePixelRatio, 0, 0, devicePixelRatio, 0, 0);
  }
  window.addEventListener('resize', fitCanvas);
  fitCanvas();

  class Particle {
    constructor(x, y, color) {
      this.x = x; this.y = y;
      this.vx = (Math.random()-0.5)*5;
      this.vy = (Math.random()-1)*5;
      this.alpha = 1;
      this.size = Math.random()*3+1;
      this.color = color;
    }
    update() {
      this.vy += 0.05;
      this.x += this.vx;
      this.y += this.vy;
      this.alpha -= 0.012;
    }
    draw() {
      ctx.globalAlpha = Math.max(0, this.alpha);
      ctx.fillStyle = this.color;
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.size, 0, Math.PI*2);
      ctx.fill();
      ctx.globalAlpha = 1;
    }
  }

  let particles = [];
  function burst(x, y) {
    const hue = Math.floor(Math.random()*360);
    for (let i=0; i<35; i++) {
      const color = `hsl(${hue+Math.random()*30-15}, 100%, ${50+Math.random()*10}%)`;
      particles.push(new Particle(x, y, color));
    }
  }

  function animate() {
    ctx.clearRect(0,0,canvas.width,canvas.height);
    particles.forEach((p,i)=>{
      p.update(); p.draw();
      if (p.alpha<=0) particles.splice(i,1);
    });

    if (Math.random()<0.03) {
      const y = Math.random() * canvas.height / devicePixelRatio;
      const x = Math.random() < 0.5
        ? Math.random() * window.innerWidth * 0.25
        : Math.random() * window.innerWidth * 0.25 + window.innerWidth*0.75;
      burst(x, y);
    }
    requestAnimationFrame(animate);
  }
  animate();
})();
</script>
@endpush

@endsection
