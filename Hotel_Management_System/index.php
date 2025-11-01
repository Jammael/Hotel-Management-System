<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			<title>The Dream Hotel</title>
			<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
			<style>
				/* Consolidated site CSS */
				:root{--accent:#e6b800;--nav:#092962;--glass:rgba(255,255,255,0.08);--glass-2:rgba(255,255,255,0.12)}
				*{box-sizing:border-box}
				body{font-family:'Poppins',system-ui,Arial;margin:0;color:#0f1724;background:#f3f6fb}
				a{color:inherit;text-decoration:none}
				.nav{position:sticky;top:0;z-index:50;background:linear-gradient(90deg,var(--nav),#063a8f);padding:10px 24px;display:flex;align-items:center;justify-content:space-between;color:#fff}
				.pill-list a{padding:8px 14px;border-radius:8px;color:#fff;font-weight:600}
				.hero{position:relative;min-height:62vh;display:flex;align-items:center;justify-content:center;overflow:hidden}
				.hero .bg{position:absolute;inset:0;background-image:linear-gradient(120deg,rgba(9,41,98,0.6),rgba(7,28,56,0.45)),url('Images/2.jpg');background-size:cover;background-position:center;filter:contrast(1.02)}
				#particles-js{position:absolute;inset:0;pointer-events:none}
				/* Galaxy background container (full page) */
				.galaxy-container{position:fixed;inset:0;z-index:-1;pointer-events:none;background:#020213;overflow:hidden}
				.galaxy-container canvas{width:100%;height:100%;display:block}
				.hero .hero-content{position:relative;z-index:10;max-width:1100px;padding:40px;color:#fff;display:flex;gap:40px;align-items:center}
				.kicker{display:inline-block;background:rgba(255,255,255,0.08);padding:6px 12px;border-radius:999px;font-weight:600;margin-bottom:18px}
				h1.hero-title{font-size:44px;line-height:1.02;margin:0 0 12px}
				p.lead{margin:0 0 22px;color:rgba(255,255,255,0.9);font-size:18px}
				.btn{display:inline-block;padding:12px 22px;border-radius:10px;font-weight:700;cursor:pointer}
				.btn-primary{background:linear-gradient(90deg,var(--accent),#ffd84d);color:#061124}
				.btn-ghost{background:transparent;border:1px solid rgba(255,255,255,0.14);color:#fff}
				/* Booking button used on room cards */
				.btn-book{display:block;background:#d97706;color:#fff;padding:14px 18px;border-radius:10px;text-align:center;font-weight:700;box-shadow:0 8px 20px rgba(217,119,6,0.14);border:none}
				.btn-book:hover{background:#c86b04}
				.glass-card{background:linear-gradient(180deg,var(--glass),var(--glass-2));backdrop-filter:blur(6px);border-radius:14px;padding:18px;color:#fff;box-shadow:0 10px 30px rgba(2,6,23,0.35);width:300px}
				.section{max-width:1100px;margin:48px auto;padding:0 20px}
				/* Light panel variants for improved readability on dark backgrounds */
				#rooms, .features-panel{background:linear-gradient(180deg,#ffffff,#fbfdff);padding:28px;border-radius:14px;box-shadow:0 10px 30px rgba(2,6,23,0.08);color:#071430}
				/* Section headings when on light panels */
				#rooms > h2, .features-panel > h2{color:#071430;font-weight:800;margin-top:0;margin-bottom:18px}
				/* Ensure room cards keep their white look */
				.rooms-grid .room{background:#fff}
				/* Make feature tiles clearly visible */
				.features-panel .features{gap:18px}
				.features-panel .feature{background:#fff}
				.rooms-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px}
				.room{border-radius:12px;overflow:hidden;background:#fff;box-shadow:0 8px 26px rgba(16,24,40,0.08);transition:transform .28s,box-shadow .28s;transform:translateY(0)}
				.room img{width:100%;height:160px;object-fit:cover;transition:transform .28s ease}

				/* Hover / focus lift for room cards (only on hover-capable devices) */
				@media (hover: hover) {
					.room:hover, .room:focus-within { transform: translateY(-12px); box-shadow:0 18px 40px rgba(11,22,47,0.12); }
					.room:hover img, .room:focus-within img { transform: translateY(-6px) scale(1.02); }
				}

				/* Keyboard accessibility: show lift when focused via keyboard */
				.room:focus-within { outline: 3px solid rgba(230,184,0,0.12); }
				.room-body{padding:14px}
				.room-title{font-weight:700;margin:0 0 6px}
				.room-sub{color:#546170;font-size:14px;margin-bottom:10px}
				.price{font-weight:700;color:var(--nav)}
				.features{display:flex;flex-wrap:wrap;gap:12px}
				.feature{flex:1 1 180px;background:#fff;padding:14px;border-radius:12px;display:flex;gap:12px;align-items:center;box-shadow:0 6px 18px rgba(11,22,47,0.06)}
				/* Rolling gallery styles (from React Bits, adapted) */
				.gallery-container{position:relative;height:420px;width:100%;overflow:hidden;margin-top:36px}
				.gallery-panel{overflow:hidden}
				.gallery-gradient{position:absolute;top:0;height:100%;width:72px;z-index:20;pointer-events:none}
				.gallery-gradient-left{left:0;background:linear-gradient(to left, rgba(0,0,0,0) 0%, rgba(9,41,98,1) 100%)}
				.gallery-gradient-right{right:0;background:linear-gradient(to right, rgba(0,0,0,0) 0%, rgba(9,41,98,1) 100%)}
				.gallery-content{display:flex;height:100%;align-items:center;justify-content:center;perspective:1200px;transform-style:preserve-3d}
				.gallery-track{position:relative;display:block;height:100%;min-height:200px;justify-content:center;align-items:center;cursor:grab;transform-style:preserve-3d;width:100%;overflow:visible}
				.gallery-item{position:absolute;display:flex;height:fit-content;align-items:center;justify-content:center;padding:8%;backface-visibility:hidden;transition:transform .45s cubic-bezier(.2,.9,.3,1),opacity .45s}
				.gallery-img{pointer-events:none;height:160px;width:300px;border-radius:18px;border:6px solid #fff;object-fit:cover;box-shadow:0 18px 40px rgba(2,6,23,0.18);transition:transform .3s ease}
				.gallery-item:hover .gallery-img{transform:scale(1.05)}
				@media (max-width: 880px){
					.gallery-container{height:320px}
					.gallery-img{height:120px;width:220px}
				}
				/* Footer sits over the galaxy background now */
				footer{background:transparent;color:#e6f7ff;padding:40px 20px;margin-top:40px}
				.footer-inner{max-width:1100px;margin:0 auto;display:flex;flex-direction:column;align-items:center;gap:10px;background:transparent}
				/* small translucent card so profile is readable on the galaxy */
				.profile-card{background:linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));padding:18px;border-radius:14px;text-align:center;backdrop-filter:blur(6px)}
				.avatar{width:110px;height:110px;border-radius:12px;object-fit:cover;border:6px solid rgba(255,255,255,0.08)}
				@media (max-width:880px){.hero .hero-content{flex-direction:column;align-items:flex-start}.hero .hero-media{width:100%;max-width:100%}h1.hero-title{font-size:30px}}
			</style>
		</head>
		<body>
			<?php include_once 'pill_nav.php'; pill_nav(); ?>

			<div class="galaxy-container" id="galaxyContainer"><canvas id="galaxyCanvas"></canvas></div>

			<main>
				<section class="hero">
					<div class="bg" aria-hidden="true"></div>
					<div id="particles-js"></div>
					<div class="hero-content">
						<div class="hero-copy" style="max-width:560px">
							<div class="kicker">WELCOME TO THE DREAM HOTEL </div>
							<h1 class="hero-title">Relax in comfort — Luxury stays made simple</h1>
							<p class="lead">Experience modern rooms, world-class service, and unbeatable offers. Book directly for the best prices and instant confirmation.</p>
							<div style="display:flex;gap:12px">
								<a class="btn btn-primary" href="user_login.php">Reserve a Room</a>
								<a class="btn btn-ghost" href="#rooms">Explore Rooms</a>
							</div>
						</div>

						<div class="hero-media">
							<div class="glass-card">
								<h3 style="margin:0 0 8px">Quick search</h3>
								  <form action="ensure_login.php" method="get">
									<div style="display:flex;gap:8px;margin-bottom:8px">
										<input name="checkin" type="date" style="flex:1;padding:8px;border-radius:8px;border:0" />
										<input name="checkout" type="date" style="flex:1;padding:8px;border-radius:8px;border:0" />
									</div>
									<div style="display:flex;gap:8px;margin-bottom:12px">
										<select name="guests" style="flex:1;padding:9px;border-radius:8px;border:0">
											<option>1 guest</option>
											<option>2 guests</option>
											<option>3 guests</option>
											<option>4 guests</option>
										</select>
										<select name="room" style="flex:1;padding:9px;border-radius:8px;border:0">
											<option>Any room</option>
											<option>Deluxe Room</option>
											<option>Executive Room</option>
											<option>Standard Room</option>
										</select>
									</div>
									<div style="display:flex;gap:8px">
										<button class="btn btn-primary" type="submit" style="width:100%">Search Availability</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</section>

				<section id="rooms" class="section">
					<div class="rooms-panel">
					<h2>Our Rooms</h2>
					<div class="rooms-grid">
						<div class="room">
							<img src="Images/1.jpg" alt="Deluxe Room">
							<div class="room-body">
								<div class="room-title">Deluxe Room</div>
								<div class="room-sub">Spacious room with king bed, city view, and complimentary breakfast.</div>
								<div style="display:flex;flex-direction:column;gap:10px;">
								<div style="display:flex;justify-content:space-between;align-items:center">
									<div class="price">₱2,500 / night</div>
								</div>
								<a class="btn-book" href="user_login.php?next=bookroom.php&room=Deluxe%20Room">Login to Book</a>
							</div>
							</div>
						</div>

						<div class="room">
							<img src="Images/3.jpg" alt="Executive Room">
							<div class="room-body">
								<div class="room-title">Executive Room</div>
								<div class="room-sub">Work-friendly space with desk, faster wifi, and luxury amenities.</div>
								<div style="display:flex;flex-direction:column;gap:10px;">
								<div style="display:flex;justify-content:space-between;align-items:center">
									<div class="price">₱3,200 / night</div>
								</div>
								<a class="btn-book" href="user_login.php?next=bookroom.php&room=Executive%20Room">Login to Book</a>
							</div>
							</div>
						</div>

						<div class="room">
							<img src="Images/4.jpg" alt="Standard Room">
							<div class="room-body">
								<div class="room-title">Standard Room</div>
								<div class="room-sub">Comfortable and affordable — perfect for short stays.</div>
								<div style="display:flex;flex-direction:column;gap:10px;">
								<div style="display:flex;justify-content:space-between;align-items:center">
									<div class="price">₱1,550 / night</div>
								</div>
								<a class="btn-book" href="user_login.php?next=bookroom.php&room=Standard%20Room">Login to Book</a>
							</div>
							</div>
						</div>

						<div class="room">
							<img src="Images/5.jpg" alt="Family Suite">
							<div class="room-body">
								<div class="room-title">Family Suite</div>
								<div class="room-sub">Extra space and comfort for families — adjoining rooms available.</div>
								<div style="display:flex;flex-direction:column;gap:10px;">
								<div style="display:flex;justify-content:space-between;align-items:center">
									<div class="price">₱4,200 / night</div>
								</div>
								<a class="btn-book" href="user_login.php?next=bookroom.php&room=Family%20Suite">Login to Book</a>
							</div>
							</div>
						</div>
					</div>
				</section>

				<section class="section features-panel">
					<h2>Why choose us</h2>
					<div class="features">
						<div class="feature"><strong>Free Breakfast</strong><div style="margin-left:auto" class="muted">Included</div></div>
						<div class="feature"><strong>24/7 Reception</strong><div style="margin-left:auto" class="muted">Always ready</div></div>
						<div class="feature"><strong>Secure Payments</strong><div style="margin-left:auto" class="muted">GCash / PayMaya</div></div>
						<div class="feature"><strong>Easy Cancellation</strong><div style="margin-left:auto" class="muted">Flexible</div></div>
					</div>
				</section>

				<!-- Rolling gallery start -->
				<section class="section">
					<div class="gallery-panel" style="background:linear-gradient(180deg,#ffffff,#fbfdff);padding:28px;border-radius:14px;box-shadow:0 10px 30px rgba(2,6,23,0.08);">
						<h2 style="margin-bottom:18px;color:#071430">Featured moments</h2>
						<div class="gallery-container" style="background:transparent">
							<div class="gallery-gradient gallery-gradient-left"></div>
							<div class="gallery-gradient gallery-gradient-right"></div>
							<div class="gallery-content">
								<div id="galleryTrack" class="gallery-track"></div>
							</div>
						</div>
					</div>
				</section>
				<!-- Rolling gallery end -->
			</main>

			<footer>
				<div class="footer-inner">
					<div style="text-align:center;">
						<div style="font-weight:700">Jammael Magallanes</div>
						<div style="font-size:12px;opacity:0.9">Founder • The Dream Hotel</div>
					</div>

					<div class="profile-card">
						<img class="avatar" src="Images/My_Avatar.jpg" onerror="this.onerror=null;this.src='Images/A1.jpg';" alt="Founder avatar">
						<div style="margin-top:8px;color:#dff7ff;font-weight:600">Jammael Magallanes</div>
						<div style="font-size:12px;color:#dff7ff;opacity:0.9">Developer • Contact for bookings & partnerships</div>
					</div>

					<div style="font-size:12px;opacity:0.9">&copy; <span id="year"></span> The Dream Hotel</div>
				</div>
			</footer>


			<!-- particles.js CDN -->
			<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
			<script>
			  // update copyright year
			  document.getElementById('year').textContent = new Date().getFullYear();

			  // particles config (subtle)
			  if(window.particlesJS){
				particlesJS('particles-js', {
				  particles: {
					number: { value: 40, density: { enable: true, value_area: 800 } },
					color: { value: '#ffffff' },
					opacity: { value: 0.06 },
					size: { value: 3 },
					move: { enable: true, speed: 1, direction: 'none', out_mode: 'out' },
					line_linked: { enable: true, distance: 140, color: '#ffffff', opacity: 0.03, width: 1 }
				  },
				  interactivity: { detect_on: 'canvas', events: { onhover: { enable: false }, onclick: { enable: false } } },
				  retina_detect: true
				});
			  }
			</script>

		<!-- Rolling gallery script -->
		<script>
		(function(){
			const images = ['Images/1.jpg','Images/2.jpg','Images/3.jpg','Images/4.jpg','Images/5.jpg','Images/6.jpg','Images/7.jpg'];
			const track = document.getElementById('galleryTrack');
			const radius = 380; // radius for circular layout
			let theta = 0;
			let autoRotate = true;
			let speed = 0.002; // auto rotate speed

			// create items
			images.forEach((src,i)=>{
				const item = document.createElement('div');
				item.className = 'gallery-item';
				const img = document.createElement('img');
				img.className = 'gallery-img';
				img.src = src;
				img.alt = 'gallery-'+i;
				item.appendChild(img);
				track.appendChild(item);
			});

			const items = Array.from(track.children);
			const count = items.length;

			function positionItems(offset=0){
				items.forEach((el, i)=>{
					const angle = (i / count) * Math.PI * 2 + offset;
					const x = Math.sin(angle) * radius;
					const z = Math.cos(angle) * radius;
					const scale = 0.55 + ( (z + radius) / (radius * 2) ) * 0.9; // size by depth
					el.style.transform = `translateX(${x}px) translateZ(${z}px) scale(${scale})`;
					el.style.left = '50%';
					el.style.opacity = (z > -radius/1.1) ? 1 : 0.15;
					el.style.zIndex = Math.round(z + radius);
				});
			}

			let lastTime = performance.now();
			function animate(t){
				const dt = t - lastTime;
				lastTime = t;
				if(autoRotate){
					theta += speed * dt;
				}
				positionItems(theta);
				requestAnimationFrame(animate);
			}
			requestAnimationFrame(animate);

			// drag support
			let dragging = false, startX=0, startTheta=0;
			track.addEventListener('pointerdown', (e)=>{
				dragging = true; startX = e.clientX; startTheta = theta; track.style.cursor = 'grabbing'; autoRotate = false;
			});
			window.addEventListener('pointermove', (e)=>{
				if(!dragging) return; const dx = e.clientX - startX; theta = startTheta + dx * 0.008; positionItems(theta);
			});
			window.addEventListener('pointerup', ()=>{ dragging=false; track.style.cursor='grab'; autoRotate = true; });

			// pause on hover
			track.addEventListener('mouseenter', ()=>autoRotate=false);
			track.addEventListener('mouseleave', ()=>autoRotate=true);
		})();
		</script>

		<!-- Galaxy background script -->
		<script>
		(function(){
			const canvas = document.getElementById('galaxyCanvas');
			if(!canvas) return;
			const ctx = canvas.getContext('2d');
			let width = canvas.width = window.innerWidth;
			let height = canvas.height = window.innerHeight;

			const stars = [];
			const STAR_COUNT = Math.floor((width * height) / 9000);

			function rand(min,max){return Math.random()*(max-min)+min}

			for(let i=0;i<STAR_COUNT;i++){
				stars.push({
					x: Math.random()*width,
					y: Math.random()*height,
					r: Math.random()*1.8 + 0.4,
					alpha: Math.random()*0.9 + 0.1,
					phase: Math.random()*Math.PI*2
				});
			}

			let mouseX = width/2, mouseY = height/2;
			window.addEventListener('mousemove', (e)=>{ mouseX = e.clientX; mouseY = e.clientY });

			function resize(){ width = canvas.width = window.innerWidth; height = canvas.height = window.innerHeight; }
			window.addEventListener('resize', resize);

			function draw(){
				ctx.clearRect(0,0,width,height);
				// gentle nebula gradient
				const g = ctx.createRadialGradient(width*0.2, height*0.2, 0, width*0.6, height*0.6, Math.max(width,height));
				g.addColorStop(0, 'rgba(24,18,49,0.35)');
				g.addColorStop(0.4, 'rgba(15,25,48,0.20)');
				g.addColorStop(1, 'rgba(2,2,6,0.6)');
				ctx.fillStyle = g; ctx.fillRect(0,0,width,height);

				// stars
				for(let s of stars){
					s.phase += 0.01 + Math.random()*0.015;
					const tw = (Math.sin(s.phase)+1)/2;
					const px = s.x + (mouseX - width/2)*0.01*tw;
					const py = s.y + (mouseY - height/2)*0.01*tw;
					ctx.beginPath();
					ctx.fillStyle = `rgba(255,255,255,${s.alpha* (0.6 + tw*0.8)})`;
					ctx.arc(px,py,s.r * (0.8 + tw*0.8), 0, Math.PI*2);
					ctx.fill();
				}

				requestAnimationFrame(draw);
			}

			requestAnimationFrame(draw);
		})();
		</script>
		</body>
	</html> -->