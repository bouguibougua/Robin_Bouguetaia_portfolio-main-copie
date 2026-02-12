<?php
$pdo = require __DIR__ . '/models/connect.php';

$sql_home = 'SELECT * FROM home LIMIT 1';
$statement_home = $pdo->query($sql_home);
$data_home = $statement_home->fetch(PDO::FETCH_ASSOC);

$sql_navbar = 'SELECT * FROM navbar LIMIT 1';
$statement_navbar = $pdo->query($sql_navbar);
$data_navbar = $statement_navbar->fetch(PDO::FETCH_ASSOC);

$sql_projet = 'SELECT * FROM projet';
$statement_projet = $pdo->query($sql_projet);

$sql_contact = 'SELECT * FROM contact';
$statement_contact = $pdo->query($sql_contact);
$data_contact = $statement_contact->fetch(PDO::FETCH_ASSOC);

$sql_works = 'SELECT * FROM works';
$statement_works = $pdo->query($sql_works);

$sql_about = 'SELECT * FROM about LIMIT 1';
$statement_about = $pdo->query($sql_about);
$data_about = $statement_about->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portfolio de Robin</title>
  <link rel="stylesheet" href="index.css">
</head>

<body>

  <!-- ✅ FOND BEAMS (AJOUT) -->
  <canvas id="beams-bg" aria-hidden="true"></canvas>

  <header>
    <nav class="navbar">
      <div class="logo">
        <a href="login.php" class="lien" tabindex="0">
          <?= $data_navbar['grandtitre'] ?? 'NON DISPO' ?>
        </a>
      </div>

      <!-- BOUTON BURGER -->
      <div class="burger" onclick="toggleMenu()">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
      </div>

      <!-- LIENS DE NAVIGATION -->
      <ul class="nav-links">
        <li><a href="#hero"><?= $data_navbar['lien1'] ?? 'Portfolio Robin' ?></a></li>
        <li><a href="#projects"><?= $data_navbar['lien2'] ?? 'NON DISPO' ?></a></li>
        <li><a href="#about"><?= $data_navbar['lien3'] ?? 'NON DISPO' ?></a></li>
        <li><a href="#recent-works"><?= $data_navbar['lien4'] ?? 'NON DISPO' ?></a></li>
        <li><a href="#contact"><?= $data_navbar['lien5'] ?? 'NON DISPO' ?></a></li>
      </ul>
    </nav>
  </header>

  <!-- SCRIPT POUR LE MENU BURGER -->
  <script>
    function toggleMenu() {
      const navLinks = document.querySelector('.nav-links');
      navLinks.classList.toggle('active');
    }
  </script>

  <main>

    <section id="hero" class="hero">
      <div class="group-image">
        <div class="group-image-text">
          <h1><?= $data_home['title'] ?? 'NON DISPO' ?></h1>
          <p><?= $data_home['subtitle1'] ?? '' ?></p>
          <p><?= $data_home['subtitle2'] ?? 'NON DISPO' ?></p>
          <p><?= $data_home['subtitle3'] ?? 'NON DISPO' ?></p>

          <div class="bouton">
            <a href="#projects"><?= $data_home['bouton'] ?? 'NON DISPO' ?></a>
          </div>
        </div>

        <!-- ✅ TON IMAGE EST LÀ (inchangée) -->
        <div class="image">
          <img src="photo/<?= $data_home['image'] ?? 'NON DISPO' ?>" alt="photo de Robin">
        </div>
      </div>
    </section>

    <section id="projects" class="projects">
      <h1>Mes projets</h1>
      <div class="project-grid">
        <?php while ($data_projet = $statement_projet->fetch(PDO::FETCH_ASSOC)) : ?>
          <!-- ✅ AJOUT classe glare pour l'effet -->
          <div class="project-item glare-hover">
            <h2><?= htmlspecialchars($data_projet['titre'] ?? 'NON DISPO') ?></h2>

            <div class="image-container">
              <img src="<?= htmlspecialchars($data_projet['image'] ?? 'photo_non_dispo.jpg') ?>" alt="image du projet">
            </div>

            <p><?= htmlspecialchars($data_projet['description'] ?? 'NON DISPO') ?></p>

            <a href="projet.php?id=<?= (int)$data_projet['id'] ?>" class="btn-style">
              <?= htmlspecialchars($data_projet['bouton'] ?? 'Consulter') ?>
            </a>
          </div>
        <?php endwhile; ?>
      </div>
    </section>

    <section id="about" class="testimonials">
      <h1><?= $data_about['grandtitre'] ?? 'NON DISPO' ?></h1>
      <div class="about-summary">
        <p><?= $data_about['description'] ?? 'NON DISPO' ?></p>
      </div>

      <div class="skills">
        <h2><?= $data_about['titre'] ?? 'NON DISPO' ?></h2>

        <?php for ($i=1;$i<=5;$i++): ?>
          <div class="skill">
            <p><?= $data_about["texte$i"] ?? 'NON DISPO' ?></p>
            <div class="gauge">
              <div class="fill" style="<?= $data_about["gauge$i"] ?? '' ?>;"></div>
            </div>
          </div>
        <?php endfor; ?>
      </div>
    </section>

    <section id="recent-works" class="recent-works">
      <h1>Mes Réalisations</h1>
      <div class="works-grid">
        <?php while ($data_works = $statement_works->fetch(PDO::FETCH_ASSOC)) : ?>
          <!-- ✅ AJOUT classe electric-border pour l'effet -->
          <div class="work-item electric-border">
            <h2><?= htmlspecialchars($data_works['titre'] ?? 'NON DISPO') ?></h2>
            <img src="<?= htmlspecialchars($data_works['image'] ?? 'photo_non_dispo.jpg') ?>"
                 alt="<?= htmlspecialchars($data_works['titre'] ?? 'image') ?>"
                 class="work-item-img">
            <p><?= htmlspecialchars($data_works['description'] ?? 'NON DISPO') ?></p>

            <a href="realisation.php?id=<?= (int)($data_works['id'] ?? $data_works['ID'] ?? 0) ?>" class="btn-style">
              <?= htmlspecialchars($data_works['bouton'] ?? 'Consulter') ?>
            </a>
          </div>
        <?php endwhile; ?>
      </div>
    </section>

    <section id="contact" class="contact">
      <h1><?= $data_contact['titre'] ?? 'NON DISPO' ?></h1>
      <p><?= $data_contact['description'] ?? 'NON DISPO' ?></p>

      <form action="#" method="post" class="contact-form">
        <div class="form-group">
          <label for="name"><?= $data_contact['nom'] ?? 'NON DISPO' ?>:</label>
          <input type="text" id="name" name="name" placeholder="Votre nom" required>
        </div>

        <div class="form-group">
          <label for="email"><?= $data_contact['email'] ?? 'NON DISPO' ?> :</label>
          <input type="email" id="email" name="email" placeholder="Votre email" required>
        </div>

        <div class="form-group">
          <label for="subject"><?= $data_contact['sujet'] ?? 'NON DISPO' ?> :</label>
          <input type="text" id="subject" name="subject" placeholder="Sujet de votre message" required>
        </div>

        <div class="form-group">
          <label for="message"><?= $data_contact['message'] ?? 'NON DISPO' ?> :</label>
          <textarea id="message" name="message" rows="5" placeholder="Votre message" required></textarea>
        </div>

        <button type="submit" class="submit-button"><?= $data_contact['bouton'] ?? 'NON DISPO' ?></button>
      </form>
    </section>

    <script>
      // Défilement doux sur tous les liens d'ancrage
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) target.scrollIntoView({ behavior: 'smooth' });
        });
      });
    </script>

  </main>

  <footer>
    <p>&copy; 2024 Portfolio Robin Bouguetaïa. Tous droits réservés.</p>
  </footer>

  <!-- ==================== JS EFFETS (AJOUT) ==================== -->
  <script>
  /* ========= 1) BEAMS background (vanilla, subtil, non flashy) ========= */
  (() => {
    const canvas = document.getElementById("beams-bg");
    const ctx = canvas.getContext("2d");

    const CFG = {
      beamWidth: 3,
      beamNumber: 20,
      speed: 2,
      alpha: 0.06,            // ✅ subtil
      color: [119,187,65],    // #77bb41
      drift: 0.35
    };

    function resize(){
      const dpr = Math.min(2, window.devicePixelRatio || 1);
      canvas.width = Math.floor(innerWidth * dpr);
      canvas.height = Math.floor(innerHeight * dpr);
      canvas.style.width = "100%";
      canvas.style.height = "100%";
      ctx.setTransform(dpr,0,0,dpr,0,0);
    }
    addEventListener("resize", resize, {passive:true});
    resize();

    const beams = Array.from({length: CFG.beamNumber}, (_,i)=>({
      x: (i + 0.5) * (innerWidth / CFG.beamNumber),
      w: CFG.beamWidth + Math.random()*2,
      s: (0.6 + Math.random()*0.9) * CFG.speed,
      p: Math.random()*Math.PI*2
    }));

    function draw(t){
      ctx.clearRect(0,0,innerWidth,innerHeight);

      for(const b of beams){
        b.p += 0.0025 * b.s;
        const x = b.x + Math.sin(b.p) * 80 * CFG.drift;

        const grad = ctx.createLinearGradient(0,0,0,innerHeight);
        grad.addColorStop(0, `rgba(${CFG.color[0]},${CFG.color[1]},${CFG.color[2]},0)`);
        grad.addColorStop(0.5, `rgba(${CFG.color[0]},${CFG.color[1]},${CFG.color[2]},${CFG.alpha})`);
        grad.addColorStop(1, `rgba(${CFG.color[0]},${CFG.color[1]},${CFG.color[2]},0)`);

        ctx.fillStyle = grad;
        ctx.fillRect(x - b.w/2, 0, b.w, innerHeight);
      }

      requestAnimationFrame(draw);
    }
    requestAnimationFrame(draw);
  })();

  /* ========= 2) GLARE HOVER (Mes Projets) ========= */
  (() => {
    const cards = document.querySelectorAll(".glare-hover");
    cards.forEach(card => {
      card.addEventListener("mousemove", (e) => {
        const r = card.getBoundingClientRect();
        const mx = (e.clientX - r.left) / r.width;
        const my = (e.clientY - r.top) / r.height;
        card.style.setProperty("--mx", mx);
        card.style.setProperty("--my", my);
      });
    });
  })();

  /* ========= 3) ELECTRIC BORDER (Mes Réalisations) ========= */
  (() => {
    const els = document.querySelectorAll(".electric-border");
    if (!els.length) return;

    els.forEach(el => {
      // inject canvas wrapper once
      if (el.querySelector(".eb-wrap")) return;

      const wrap = document.createElement("div");
      wrap.className = "eb-wrap";
      const c = document.createElement("canvas");
      c.className = "eb-canvas";
      wrap.appendChild(c);
      el.appendChild(wrap);

      const ctx = c.getContext("2d");
      let raf = null;

      const color = [56, 87, 26]; // #38571a
      const speed = 1.0;
      const chaos = 0.04;
      const thickness = 2;

      function resize(){
        const r = el.getBoundingClientRect();
        const pad = 60;
        const dpr = Math.min(2, window.devicePixelRatio || 1);
        c.width = Math.floor((r.width + pad*2) * dpr);
        c.height = Math.floor((r.height + pad*2) * dpr);
        c.style.width = `${r.width + pad*2}px`;
        c.style.height = `${r.height + pad*2}px`;
        ctx.setTransform(dpr,0,0,dpr,0,0);
      }
      const ro = new ResizeObserver(resize);
      ro.observe(el);
      resize();

      const rand = (x)=> (Math.sin(x*12.9898)*43758.5453)%1;
      const noise2D = (x,y)=>{
        const i=Math.floor(x), j=Math.floor(y);
        const fx=x-i, fy=y-j;
        const a=rand(i+j*57), b=rand(i+1+j*57), c=rand(i+(j+1)*57), d=rand(i+1+(j+1)*57);
        const ux=fx*fx*(3-2*fx), uy=fy*fy*(3-2*fy);
        return a*(1-ux)*(1-uy) + b*ux*(1-uy) + c*(1-ux)*uy + d*ux*uy;
      };
      const oct = (x, time, seed)=>{
        let y=0, amp=chaos, freq=10;
        for(let o=0;o<8;o++){
          y += amp * noise2D(freq*x + seed*100, time*freq*0.3);
          freq *= 1.6;
          amp *= 0.7;
        }
        return y;
      };
      const rrPoint = (t,left,top,w,h,rad)=>{
        const sw=w-2*rad, sh=h-2*rad, ca=(Math.PI*rad)/2;
        const per=2*sw+2*sh+4*ca;
        const dist=t*per;
        let acc=0;

        if(dist<=acc+sw){ const p=(dist-acc)/sw; return {x:left+rad+p*sw,y:top}; }
        acc+=sw;
        if(dist<=acc+ca){ const p=(dist-acc)/ca; const a=-Math.PI/2+p*(Math.PI/2); return {x:left+w-rad+rad*Math.cos(a),y:top+rad+rad*Math.sin(a)}; }
        acc+=ca;
        if(dist<=acc+sh){ const p=(dist-acc)/sh; return {x:left+w,y:top+rad+p*sh}; }
        acc+=sh;
        if(dist<=acc+ca){ const p=(dist-acc)/ca; const a=0+p*(Math.PI/2); return {x:left+w-rad+rad*Math.cos(a),y:top+h-rad+rad*Math.sin(a)}; }
        acc+=ca;
        if(dist<=acc+sw){ const p=(dist-acc)/sw; return {x:left+w-rad-p*sw,y:top+h}; }
        acc+=sw;
        if(dist<=acc+ca){ const p=(dist-acc)/ca; const a=Math.PI/2+p*(Math.PI/2); return {x:left+rad+rad*Math.cos(a),y:top+h-rad+rad*Math.sin(a)}; }
        acc+=ca;
        if(dist<=acc+sh){ const p=(dist-acc)/sh; return {x:left,y:top+h-rad-p*sh}; }
        acc+=sh;
        const p=(dist-acc)/ca; const a=Math.PI+p*(Math.PI/2);
        return {x:left+rad+rad*Math.cos(a),y:top+rad+rad*Math.sin(a)};
      };

      let time = 0;
      function frame(now){
        time += (speed * 0.016);

        const pad = 60;
        const w = parseFloat(c.style.width);
        const h = parseFloat(c.style.height);

        ctx.clearRect(0,0,w,h);
        ctx.lineWidth = thickness;
        ctx.lineCap = "round";
        ctx.lineJoin = "round";
        ctx.shadowColor = `rgba(${color[0]},${color[1]},${color[2]},0.6)`;
        ctx.shadowBlur = 14;

        const left = pad, top = pad;
        const bw = w - pad*2, bh = h - pad*2;
        const rad = 16;

        const per = 2*(bw+bh) + 2*Math.PI*rad;
        const samples = Math.floor(per/2);

        ctx.beginPath();
        for(let i=0;i<=samples;i++){
          const p = i/samples;
          const pt = rrPoint(p,left,top,bw,bh,rad);
          const nx = oct(p*8,time,0) * 60;
          const ny = oct(p*8,time,1) * 60;
          const dx = pt.x + nx;
          const dy = pt.y + ny;
          if(i===0) ctx.moveTo(dx,dy); else ctx.lineTo(dx,dy);
        }
        ctx.closePath();

        ctx.strokeStyle = `rgba(${color[0]},${color[1]},${color[2]},0.95)`;
        ctx.stroke();

        ctx.shadowBlur = 26;
        ctx.strokeStyle = `rgba(${119},${187},${65},0.25)`;
        ctx.stroke();

        raf = requestAnimationFrame(frame);
      }
      raf = requestAnimationFrame(frame);
    });
  })();
  </script>

</body>
</html>
