@extends('EventInvitations::layout')

@section('invite-content')


<canvas id="fireworks-bg"
        style="position: fixed; inset: 0; width: 100%; height: 100%; z-index: 0; pointer-events: none;"></canvas>


<div class="invitation-wrapper d-flex justify-content-center align-items-center py-2"
     style="position: relative; z-index: 2; min-height: 100vh;">
    <div id="invitation-container" class="invitation-container mx-auto" style="max-width:960px;">

       
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

            <div class="card-body text-center px-2 py-2 position-relative invitation-text" 
                 style="z-index: 4; background-color: var(--light-gray);">

                
                <div id="countdown" class="countdown-flip mb-3"></div>

                
                <div class="invitation-greeting mt-1">
                    <p>Dear <strong>{{ $invite->guest_name }}</strong>,</p>
                    <p>
                        You are cordially invited to the grand launch of <strong>Attila Chicken</strong> — 
                        a celebration of innovation, growth, fun, excellence, and a taste of its menu.
                    </p>
                </div>

                
                <a href="{{ route('rsvp.show', $invite->token) }}"
                   class="btn btn-lg fw-semibold px-2 py-2"
                   style="background: var(--brand-yellow); color: var(--brand-black); border-radius: 10px;">
                   RSVP Now
                </a>

                <div class="mt-1">
                    <hr style="border-top: 2px solid var(--brand-yellow); width: 60px; margin: 0 auto;">
                </div>

               
                <p class="invitation-signoff mt-1 mb-0">
                    Warm regards,<br><strong>Attila</strong>
                </p>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link href="https://fonts.cdnfonts.com/css/mileast" rel="stylesheet">

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
    min-height: 100vh;
}


.invitation-text {
    font-family: 'Mileast', sans-serif; !important;
    color: var(--brand-black);
}


.invitation-greeting p, 
.invitation-signoff {
    font-family: 'Great Vibes', cursive !important;
    font-size: 1.7rem;
    color: var(--brand-black);
    line-height: 1.7;
}
.invitation-greeting strong, 
.invitation-signoff strong {
    color: var(--brand-red);
    font-weight: 700;
    text-transform: capitalize;
}



.countdown-flip {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
    align-items: center;
}

.flip-card {
    background: linear-gradient(145deg, #FFD84C, #F6C90E);
    color: var(--brand-black);
    border-radius: 16px;
    box-shadow: 0 8px 18px rgba(0,0,0,0.18);
    width: 120px;
    height: 120px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 2.6rem;
    font-weight: 700;
}
.flip-label {
    font-family: 'Pacifico', cursive !important;
    font-size: 0.95rem;
    margin-top: 0.35rem;
}


.fade-in {
    animation: fadeInUp 1s ease-out;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}


@media (max-width: 768px) {
  .invitation-wrapper {
    align-items: flex-start !important;
    padding-top: 0.5rem !important;
  }
  .banner-wrapper {
    margin-top: 0;
  }
  .flip-card {
    width: 85px;
    height: 85px;
    font-size: 1.8rem;
    border-radius: 12px;
  }
  .flip-label {
    font-size: 0.8rem;
  }
  .countdown-flip {
    overflow-x: auto;
    flex-wrap: nowrap;
    justify-content: flex-start;
    padding: 0 0.5rem;
    gap: 0.6rem;
    scroll-snap-type: x mandatory;
  }
  .flip-card {
    flex: 0 0 auto;
    scroll-snap-align: center;
  }
  .card {
    box-shadow: 0 6px 14px rgba(0,0,0,0.18);
  }
}

@media (max-width: 480px) {
  .flip-card {
    width: 70px;
    height: 70px;
    font-size: 1.6rem;
  }
  .flip-label {
    font-size: 0.7rem;
  }
  .invitation-greeting p, 
  .invitation-signoff {
    font-size: 1.3rem;
  }
}
</style>
@endpush

@push('scripts')
<script>

const countdownEl = document.getElementById('countdown');
const eventDate = new Date("{{ $event->start_date->format('Y-m-d H:i:s') }}").getTime();
const units = ['Days','Hours','Minutes','Seconds'];
const elements = {};
units.forEach(unit => {
  const card = document.createElement('div');
  card.className = 'flip-card';
  card.innerHTML = `<div class="flip-value">0</div><div class="flip-label">${unit}</div>`;
  countdownEl.appendChild(card);
  elements[unit] = card.querySelector('.flip-value');
});
function updateCountdown() {
  const now = Date.now();
  const distance = eventDate - now;
  if (distance <= 0) {
    countdownEl.innerHTML = "🎉 The event is live!";
    clearInterval(timer);
    return;
  }
  const days = Math.floor(distance / (1000 * 60 * 60 * 24));
  const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((distance % (1000 * 60)) / 1000);
  const values = { Days: days, Hours: hours, Minutes: minutes, Seconds: seconds };
  for (let key in values) elements[key].textContent = values[key];
}
updateCountdown();
const timer = setInterval(updateCountdown, 1000);


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
        : window.innerWidth * 0.75 + Math.random() * window.innerWidth * 0.25;
      burst(x, y);
    }
    requestAnimationFrame(animate);
  }
  animate();
})();
</script>
@endpush

@endsection
