<?php include_once 'pill_nav.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contact - The Dream Hotel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
      :root {
  --pointer-x: 50%;
  --pointer-y: 50%;
  --pointer-from-center: 0;
  --pointer-from-top: 0.5;
  --pointer-from-left: 0.5;
  --card-opacity: 0;
  --rotate-x: 0deg;
  --rotate-y: 0deg;
  --background-x: 50%;
  --background-y: 50%;
  --grain: none;
  --icon: none;
  --behind-gradient: radial-gradient(1200px 400px at 10% 10%, rgba(255,255,255,0.06), transparent), linear-gradient(180deg,#05102a,#082e5b);
  --inner-gradient: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
  --sunpillar-1: hsl(2, 100%, 73%);
  --sunpillar-2: hsl(53, 100%, 69%);
  --sunpillar-3: hsl(93, 100%, 69%);
  --sunpillar-4: hsl(176, 100%, 76%);
  --sunpillar-5: hsl(228, 100%, 74%);
  --sunpillar-6: hsl(283, 100%, 73%);
  --sunpillar-clr-1: var(--sunpillar-1);
  --sunpillar-clr-2: var(--sunpillar-2);
  --sunpillar-clr-3: var(--sunpillar-3);
  --sunpillar-clr-4: var(--sunpillar-4);
  --sunpillar-clr-5: var(--sunpillar-5);
  --sunpillar-clr-6: var(--sunpillar-6);
  --card-radius: 28px;
}

body{font-family:'Poppins',sans-serif;margin:0;background:linear-gradient(180deg,#071430,#071a36);color:#fff}
.page{max-width:1100px;margin:36px auto;padding:20px;text-align:center}
.pc-card-wrapper{perspective:800px;display:inline-block}
.pc-card{height:78svh;max-height:640px;display:grid;aspect-ratio:0.718;border-radius:var(--card-radius);position:relative;background-size:100% 100%;overflow:hidden;margin:auto;max-width:480px}
.pc-inside{inset:1px;position:absolute;background-image:var(--inner-gradient);background-color:transparent}
.pc-shine{position:absolute;inset:0;z-index:3}
.pc-glare{position:absolute;inset:0;z-index:4}
.pc-avatar-content{position:absolute;left:50%;transform:translateX(-50%);bottom:90px;width:260px;height:260px;border-radius:18px;overflow:hidden}
.pc-avatar-content .avatar{width:100%;height:100%;object-fit:cover;border-radius:18px;display:block}
.pc-content{position:relative;z-index:5;pointer-events:auto}
.pc-details{position:absolute;top:34px;left:0;right:0;text-align:center;padding:0 18px}
.pc-details h3{font-weight:700;margin:0;font-size:clamp(20px,5svh,36px);background-image:linear-gradient(to bottom,#fff,#8ea0ff);-webkit-background-clip:text;background-clip:text;color:transparent}
.pc-details p{margin:6px 0 0;color:rgba(255,255,255,0.85);font-weight:600}
.pc-user-info{position:absolute;bottom:18px;left:16px;right:16px;display:flex;align-items:center;justify-content:space-between;background:rgba(255,255,255,0.06);backdrop-filter:blur(8px);border-radius:12px;padding:10px}
.pc-mini-avatar{width:46px;height:46px;border-radius:50%;overflow:hidden;border:1px solid rgba(255,255,255,0.08)}
.pc-mini-avatar img{width:100%;height:100%;object-fit:cover}
.pc-user-text{display:flex;flex-direction:column;align-items:flex-start;margin-left:12px}
.pc-handle{font-weight:700}
.pc-status{font-size:13px;opacity:0.85}
.pc-contact-btn{background:transparent;border:1px solid rgba(255,255,255,0.12);color:#fff;padding:8px 12px;border-radius:10px;cursor:pointer}
.pc-contact-btn:hover{transform:translateY(-2px);border-color:rgba(255,255,255,0.28)}

@media (max-width:880px){.pc-card{max-width:420px}.pc-avatar-content{width:200px;height:200px;bottom:78px}}
@media (max-width:480px){.pc-card{max-width:360px}.pc-avatar-content{width:160px;height:160px;bottom:70px}}

/* small accessibility tweaks */
.sr-only{position:absolute;left:-9999px}

/* Electric border styles */
.electric-border{--electric-border-color:#2ef0ff;--electric-light-color:#8ff;--eb-border-width:2px;position:relative;border-radius:var(--card-radius);overflow:visible;isolation:isolate}
.electric-border .eb-svg{position:absolute;left:0;top:0;width:100%;height:100%;opacity:1;pointer-events:none}
.electric-border .eb-layers{position:absolute;inset:0;border-radius:inherit;pointer-events:none;z-index:2}
.eb-stroke,.eb-glow-1,.eb-glow-2,.eb-background-glow{position:absolute;inset:0;border-radius:inherit;pointer-events:none;box-sizing:border-box}
.eb-stroke{border:var(--eb-border-width) solid var(--electric-border-color);mix-blend-mode:screen}
.eb-glow-1{border:var(--eb-border-width) solid rgba(46,240,255,0.6);opacity:0.6;filter:blur(calc(0.5px + (var(--eb-border-width) * 0.25)))}
.eb-glow-2{border:var(--eb-border-width) solid var(--electric-light-color);opacity:0.6;filter:blur(calc(2px + (var(--eb-border-width) * 0.5)))}
.eb-background-glow{z-index:-1;transform:scale(1.08);filter:blur(32px);opacity:0.28;background:linear-gradient(-30deg,var(--electric-light-color),transparent,var(--electric-border-color))}

@keyframes eb-flicker{0%{opacity:0.85;filter:blur(3px)}50%{opacity:1;filter:blur(6px)}100%{opacity:0.9;filter:blur(4px)}}
.eb-glow-2{animation:eb-flicker 2.6s ease-in-out infinite}
    </style>
  </head>
  <body>
    <?php pill_nav(); ?>
    <main class="page">
      <div style="color:#fff;margin-bottom:12px;font-weight:700">Founder • The Deluxe Hotel</div>

      <div class="pc-card-wrapper" id="pcWrapper">
        <div class="electric-border" style="--electric-border-color:#2ef0ff;">
          <div class="eb-svg" aria-hidden="true"></div>
          <div class="eb-layers">
            <div class="eb-background-glow"></div>
            <div class="eb-glow-2"></div>
            <div class="eb-glow-1"></div>
            <div class="eb-stroke"></div>
          </div>
          <div class="eb-content">
            <div class="pc-card" id="pcCard" style="--behind-gradient: radial-gradient(1200px 400px at 10% 10%, rgba(255,255,255,0.06), transparent), linear-gradient(180deg,#05102a,#082e5b); --inner-gradient: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));">
              <div class="pc-inside">
                <div class="pc-shine" aria-hidden="true"></div>
                <div class="pc-glare" aria-hidden="true"></div>
                <div class="pc-avatar-content">
                  <img class="avatar" src="Images/My_Avatar.jpg" onerror="this.onerror=null;this.src='Images/A1.jpg'" alt="avatar" />
                </div>
                <div class="pc-content">
                  <div class="pc-details">
                    <h3>Jammael Magallanes</h3>
                    <p>Developer — bookings & partnerships</p>
                  </div>

                  <div class="pc-user-info" role="group" aria-label="contact">
                    <div style="display:flex;align-items:center">
                      <div class="pc-mini-avatar"><img src="Images/A1.jpg" alt="mini avatar"/></div>
                      <div class="pc-user-text">
                        <div class="pc-handle">Jammael Magallanes</div>
                        <div class="pc-status">Available</div>
                      </div>
                    </div>
                    <div>
                      <button class="pc-contact-btn" onclick="location.href='mailto:Jammaelmagallanesph552022@gmail.com'">Contact Me</button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div style="margin-top:22px; color:#ffd86b; font-weight:700">Email: <a href="mailto:Jammaelmagallanesph552022@gmail.com" style="color:#ffd86b;text-decoration:none">Jammaelmagallanesph552022@gmail.com</a></div>
    </main>

    <script>
      (function(){
        const wrapper = document.getElementById('pcWrapper');
        const card = document.getElementById('pcCard');
        if(!wrapper || !card) return;

        // Smooth follow variables
        let targetX = 50, targetY = 50;
        let curX = 50, curY = 50;

        function applyVars(xPct, yPct){
          card.style.setProperty('--pointer-x', xPct + '%');
          card.style.setProperty('--pointer-y', yPct + '%');
          const fx = (xPct - 50)/50; // -1..1
          const fy = (yPct - 50)/50; // -1..1
          card.style.setProperty('--pointer-from-center', Math.hypot(fx,fy).toFixed(3));
          card.style.setProperty('--pointer-from-top', (yPct/100).toFixed(3));
          card.style.setProperty('--pointer-from-left', (xPct/100).toFixed(3));
          const rx = (fy * 10).toFixed(2) + 'deg';
          const ry = (fx * -12).toFixed(2) + 'deg';
          card.style.setProperty('--rotate-x', rx);
          card.style.setProperty('--rotate-y', ry);
          // subtle translate for depth
          const ty = (Math.hypot(fx,fy) * -8).toFixed(2) + 'px';
          card.style.transform = `translate3d(0, ${ty}, 0) rotateX(${card.style.getPropertyValue('--rotate-y')}) rotateY(${card.style.getPropertyValue('--rotate-x')})`;
          // avatar parallax
          const avatar = card.querySelector('.pc-avatar-content');
          if(avatar){
            const ax = (fx * -10).toFixed(2) + 'px';
            const ay = (fy * -8).toFixed(2) + 'px';
            avatar.style.transform = `translateX(-50%) translate3d(${ax}, ${ay}, 0)`;
          }
        }

        function onPointer(e){
          const r = card.getBoundingClientRect();
          const clientX = (e.clientX !== undefined) ? e.clientX : (e.touches && e.touches[0].clientX);
          const clientY = (e.clientY !== undefined) ? e.clientY : (e.touches && e.touches[0].clientY);
          const x = ((clientX) - r.left) / r.width * 100;
          const y = ((clientY) - r.top) / r.height * 100;
          targetX = Math.max(0, Math.min(100, x));
          targetY = Math.max(0, Math.min(100, y));
        }

        wrapper.addEventListener('pointermove', onPointer, {passive:true});
        wrapper.addEventListener('touchmove', onPointer, {passive:true});
        wrapper.addEventListener('pointerenter', ()=> card.classList.add('active'));
        wrapper.addEventListener('pointerleave', ()=>{ card.classList.remove('active'); targetX = 50; targetY = 50; });

        // animation loop - lerp towards target for smooth motion
        function raf(){
          curX += (targetX - curX) * 0.12;
          curY += (targetY - curY) * 0.12;
          applyVars(curX, curY);
          requestAnimationFrame(raf);
        }

        // start
        applyVars(50,50);
        requestAnimationFrame(raf);
      })();
    </script>
  </body>
</html>
