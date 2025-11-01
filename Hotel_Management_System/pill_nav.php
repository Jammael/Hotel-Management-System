<?php
// Simple PHP Pill Navigation component
// Usage: include 'pill_nav.php'; pill_nav([['label'=>'Home','href'=>'index.php'], ...]);
function pill_nav($items = [], $logoText = 'THE DELUXE HOTEL', $activeHref = '') {
    if(empty($items)){
        $items = [
            ['label'=>'Home','href'=>'index.php'],
            ['label'=>'Admin Login','href'=>'admin_login.php'],
            ['label'=>'User Login','href'=>'user_login.php'],
            ['label'=>'Rooms','href'=>'index.php#rooms'],
            ['label'=>'Gallery','href'=>'image_gallery.php'],
            ['label'=>'Contact','href'=>'contact.php']
        ];
    }
    // determine active href if not provided
    if(empty($activeHref)){
        $activeHref = basename($_SERVER['PHP_SELF']);
    }
    ?>
    <style>
    /* Gooey pill nav styles */
    .pill-wrap{position:sticky;top:0;overflow:visible;padding:12px 22px;background:linear-gradient(90deg,#092962,#063a8f);display:flex;align-items:center;justify-content:space-between;color:#fff;z-index:9999;box-shadow:0 2px 8px rgba(2,6,23,0.12)}
    .pill-brand{font-weight:800;font-size:20px;letter-spacing:0.6px}
    .pill-list{position:relative;display:flex;gap:12px;align-items:center;padding:6px}

    /* The moving goo blob */
    .pill-blob{position:absolute;top:50%;left:0;transform:translateY(-50%);width:120px;height:44px;border-radius:999px;background:linear-gradient(90deg,#ffd84d,#f0a500);z-index:0;transition:transform .32s cubic-bezier(.2,.9,.3,1),width .25s;pointer-events:none}
    .pill-list svg{position:absolute;left:0;top:0;width:0;height:0}

    .pill-item{position:relative;z-index:2;padding:10px 16px;border-radius:999px;background:transparent;color:#fff;font-weight:700;border:0;cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:color .18s,transform .18s}
    .pill-item .label{pointer-events:none}
    .pill-item:hover{color:#061124;transform:translateY(-4px)}
    .pill-item.active{color:#061124}

    /* Make active item text bold and add subtle shadow for contrast when blob is behind */
    .pill-item.active, .pill-item:focus{font-weight:800}

    /* Small responsive tweaks */
    @media (max-width:720px){
        .pill-list{gap:8px}
        .pill-blob{display:none}
        .pill-item{padding:8px 10px}
    }
    /* Effect area used for particle bursts */
    .effect.filter{position:absolute;pointer-events:none;overflow:visible;z-index:1;left:0;top:0;width:0;height:0}
    .effect.filter .particle{position:absolute;left:0;top:0;transform:translate(var(--start-x),var(--start-y)) scale(var(--scale));animation:particleMove var(--time) cubic-bezier(.2,.9,.3,1) forwards}
    .effect.filter .particle .point{display:block;width:10px;height:10px;border-radius:999px;background:var(--color,#fff);box-shadow:0 6px 18px rgba(0,0,0,0.18);filter:drop-shadow(0 6px 12px rgba(0,0,0,0.2))}
    @keyframes particleMove{to{transform:translate(var(--end-x),var(--end-y)) scale(.2) rotate(var(--rotate)) ; opacity:0}}

    /* Animated text overlay */
    .effect.text{position:absolute;pointer-events:none;display:flex;align-items:center;justify-content:center;z-index:2;color:#061124;font-weight:800;background:linear-gradient(90deg,#ffd84d,#f0a500);padding:6px 12px;border-radius:10px;opacity:0;transform:scale(.98);transition:opacity .22s,transform .22s}
    .effect.text.active{opacity:1;transform:scale(1)}
    </style>

    <!-- SVG filter used to create the gooey effect -->
    <svg aria-hidden="true" style="position:absolute;width:0;height:0;overflow:hidden">
      <defs>
        <filter id="goo">
          <feGaussianBlur in="SourceGraphic" stdDeviation="8" result="blur" />
          <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
          <feBlend in="SourceGraphic" in2="goo" />
        </filter>
      </defs>
    </svg>

    <div class="pill-wrap">
        <div class="pill-brand"><?php echo htmlspecialchars($logoText); ?></div>
        <div class="pill-list" id="pillList" style="filter:url(#goo);">
            <div class="pill-blob" id="pillBlob"></div>
            <?php foreach($items as $it):
                $isActive = ($activeHref === basename($it['href']));
                $safeLabel = htmlspecialchars($it['label']);
                $safeHref = htmlspecialchars($it['href']);
            ?>
                <a class="pill-item<?php echo $isActive ? ' active' : ''; ?>" href="<?php echo $safeHref; ?>" data-label="<?php echo $safeLabel; ?>"><?php echo $safeLabel; ?></a>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    (function(){
        const list = document.getElementById('pillList');
        const blob = document.getElementById('pillBlob');
        if(!list || !blob) return;

        const filterEl = document.createElement('span');
        filterEl.className = 'effect filter';
        list.appendChild(filterEl);

        const textEl = document.createElement('span');
        textEl.className = 'effect text';
        list.appendChild(textEl);

        const items = Array.from(list.querySelectorAll('.pill-item'));

        // Particle helpers (adapted)
        const noise = (n=1) => n/2 - Math.random()*n;
        const getXY = (distance, pointIndex, totalPoints) => {
            const angle = ((360 + noise(8)) / totalPoints) * pointIndex * (Math.PI/180);
            return [Math.round(distance * Math.cos(angle)), Math.round(distance * Math.sin(angle))];
        };

        function makeParticles(container){
            const particleCount = 12;
            const particleDistances = [90, 8];
            const particleR = 100;
            const animationTime = 600;
            const timeVariance = 260;

            const bubbleTime = animationTime * 2 + timeVariance;
            container.style.setProperty('--time', `${bubbleTime}ms`);

            for(let i=0;i<particleCount;i++){
                const t = animationTime*2 + noise(timeVariance*2);
                const p = {
                    start: getXY(particleDistances[0], particleCount - i, particleCount),
                    end: getXY(particleDistances[1] + noise(7), particleCount - i, particleCount),
                    time: t,
                    scale: 1 + noise(0.2),
                    color: `rgba(${50+Math.random()*200},${50+Math.random()*200},${50+Math.random()*200},1)`,
                    rotate: (noise(particleR/10) > 0 ? (noise(particleR/10) + particleR/20) * 10 : (noise(particleR/10) - particleR/20) * 10)
                };

                setTimeout(()=>{
                    const particle = document.createElement('span');
                    const point = document.createElement('span');
                    particle.className = 'particle';
                    particle.style.setProperty('--start-x', `${p.start[0]}px`);
                    particle.style.setProperty('--start-y', `${p.start[1]}px`);
                    particle.style.setProperty('--end-x', `${p.end[0]}px`);
                    particle.style.setProperty('--end-y', `${p.end[1]}px`);
                    particle.style.setProperty('--time', `${p.time}ms`);
                    particle.style.setProperty('--scale', `${p.scale}`);
                    particle.style.setProperty('--color', `${p.color}`);
                    particle.style.setProperty('--rotate', `${p.rotate}deg`);

                    point.className = 'point';
                    particle.appendChild(point);
                    container.appendChild(particle);
                    requestAnimationFrame(()=> container.classList.add('active'));
                    setTimeout(()=> { try{ container.removeChild(particle); }catch(e){} }, p.time);
                }, 30*i);
            }
        }

        function placeBlob(target){
            if(!target) return;
            const r = target.getBoundingClientRect();
            const parentR = list.getBoundingClientRect();
            const width = Math.max(r.width + 10, 90);
            const left = (r.left - parentR.left) + (r.width/2) - (width/2);
            blob.style.width = width + 'px';
            blob.style.transform = `translateX(${left}px) translateY(-50%)`;

            // position filter (particles) and text overlay
            const styles = {
                left: `${r.x - parentR.x}px`,
                top: `${r.y - parentR.y}px`,
                width: `${r.width}px`,
                height: `${r.height}px`
            };
            Object.assign(filterEl.style, styles);
            Object.assign(textEl.style, styles);
            textEl.textContent = target.textContent.trim();
        }

        // init to active
        const active = items.find(i=>i.classList.contains('active')) || items[0];
        placeBlob(active);

        items.forEach((it, idx)=>{
            it.addEventListener('mouseenter', ()=> placeBlob(it));
            it.addEventListener('focus', ()=> placeBlob(it));
            it.addEventListener('click', (e)=>{
                // mark active visually
                items.forEach(x=>x.classList.remove('active'));
                it.classList.add('active');
                placeBlob(it);
                // particle burst (visual only) - do not block navigation
                try{ makeParticles(filterEl); } catch(e){}
                // allow the browser to follow the link immediately (no preventDefault)
            });

            // keyboard activate
            it.addEventListener('keydown', (e)=>{
                if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); it.click(); }
            });
        });

        list.addEventListener('mouseleave', ()=> placeBlob(items.find(i=>i.classList.contains('active')) || items[0]));
        window.addEventListener('resize', ()=> placeBlob(items.find(i=>i.classList.contains('active')) || items[0]));
    })();
    </script>
    <?php
}
?>
