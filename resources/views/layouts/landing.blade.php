<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tempuh ID — Sewa Mobil, Jalan Terus</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --aspal:#18181A;
    --aspal-soft:#242427;
    --kapur:#F7F4EE;
    --kapur-dim:#EDE8DE;
    --merah:#D93A2B;
    --merah-deep:#B22A1E;
    --perak:#B8BCC2;
    --marka:#F2B705;
    --teks:#242224;
    --teks-mute:#6b6763;
    --radius:2px;
  }
  *{box-sizing:border-box; margin:0; padding:0;}
  html{scroll-behavior:smooth;}
  body{
    background:var(--kapur);
    color:var(--teks);
    font-family:'Plus Jakarta Sans', sans-serif;
    line-height:1.5;
    -webkit-font-smoothing:antialiased;
  }
  @media (prefers-reduced-motion: reduce){
    html{scroll-behavior:auto;}
    *{animation:none !important; transition:none !important;}
  }
  h1,h2,h3, .display{
    font-family:'Big Shoulders Display', sans-serif;
    text-transform:uppercase;
    letter-spacing:0.01em;
    line-height:0.92;
    font-weight:800;
  }
  .mono{font-family:'JetBrains Mono', monospace;}
  a{color:inherit; text-decoration:none;}
  img{max-width:100%; display:block;}
  .wrap{max-width:1180px; margin:0 auto; padding:0 32px;}
  .eyebrow{
    font-family:'JetBrains Mono', monospace;
    font-size:12px;
    letter-spacing:0.16em;
    text-transform:uppercase;
    color:var(--merah);
    display:flex;
    align-items:center;
    gap:10px;
    font-weight:600;
  }
  .eyebrow::before{
    content:"";
    width:22px; height:2px;
    background:var(--merah);
    display:inline-block;
  }
  button{font-family:inherit; cursor:pointer; border:none;}

  /* ===== BUTTONS ===== */
  .btn{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:15px 28px;
    font-weight:700;
    font-size:15px;
    border-radius:var(--radius);
    transition:transform .15s ease, box-shadow .15s ease;
  }
  .btn-primary{
    background:var(--merah);
    color:var(--kapur);
    box-shadow:4px 4px 0 var(--aspal);
  }
  .btn-primary:hover{transform:translate(-2px,-2px); box-shadow:6px 6px 0 var(--aspal);}
  .btn-ghost{
    background:transparent;
    color:var(--aspal);
    border:1.5px solid var(--aspal);
  }
  .btn-ghost:hover{background:var(--aspal); color:var(--kapur);}
  .btn-light{
    background:var(--kapur);
    color:var(--aspal);
    box-shadow:4px 4px 0 var(--merah);
  }
  .btn-light:hover{transform:translate(-2px,-2px); box-shadow:6px 6px 0 var(--merah);}

  /* ===== NAV ===== */
  header{
    position:sticky; top:0; z-index:50;
    background:rgba(247,244,238,0.92);
    backdrop-filter:blur(8px);
    border-bottom:1px solid rgba(0,0,0,0.08);
  }
  nav{
    display:flex; align-items:center; justify-content:space-between;
    padding:18px 32px;
    max-width:1180px; margin:0 auto;
  }
  .logo{
    font-family:'Big Shoulders Display', sans-serif;
    font-weight:900;
    font-size:26px;
    letter-spacing:0.02em;
    display:flex;
    align-items:center;
    gap:8px;
  }
  .logo .dot{width:9px; height:9px; background:var(--merah); border-radius:50%; display:inline-block;}
  .navlinks{display:flex; gap:36px; font-size:14.5px; font-weight:600;}
  .navlinks a{position:relative; padding:4px 0;}
  .navlinks a::after{
    content:""; position:absolute; left:0; bottom:0; width:0; height:2px; background:var(--merah);
    transition:width .2s ease;
  }
  .navlinks a:hover::after{width:100%;}
  .navcta{display:flex; align-items:center; gap:20px;}
  .navcta .tel{font-family:'JetBrains Mono',monospace; font-size:13.5px; color:var(--teks-mute); display:flex; align-items:center; gap:6px;}
  @media (max-width:900px){ .navlinks, .navcta .tel{display:none;} }

  /* ===== ROUTE SPINE (signature element) ===== */
  .route-spine{
    position:absolute;
    left:50%;
    top:0;
    bottom:0;
    width:2px;
    background:repeating-linear-gradient(to bottom, var(--marka) 0 14px, transparent 14px 26px);
    transform:translateX(-50%);
    z-index:0;
    opacity:0.55;
  }

  /* ===== HERO ===== */
  .hero{
    position:relative;
    overflow:hidden;
    padding:88px 0 60px;
    background:
      radial-gradient(circle at 85% 10%, rgba(217,58,43,0.10), transparent 45%),
      var(--kapur);
  }
  .hero .wrap{position:relative; z-index:2;}
  .hero-grid{
    display:grid;
    grid-template-columns:1.05fr 0.95fr;
    gap:48px;
    align-items:center;
  }
  .plate-tag{
    display:inline-flex;
    align-items:center;
    gap:10px;
    font-family:'JetBrains Mono', monospace;
    font-size:12.5px;
    font-weight:600;
    letter-spacing:0.08em;
    background:var(--aspal);
    color:var(--kapur);
    padding:7px 14px 7px 10px;
    border-radius:3px;
    margin-bottom:22px;
  }
  .plate-tag .flag{background:var(--marka); color:var(--aspal); padding:2px 6px; border-radius:2px; font-weight:700;}
  h1.hero-head{
    font-size:clamp(46px, 6.4vw, 82px);
    color:var(--aspal);
  }
  h1.hero-head em{
    font-style:normal;
    color:var(--merah);
  }
  .hero p.lede{
    margin-top:22px;
    font-size:18px;
    color:var(--teks-mute);
    max-width:460px;
  }
  .hero-actions{display:flex; gap:16px; margin-top:34px; flex-wrap:wrap;}
  .hero-trust{
    display:flex; gap:30px; margin-top:46px; padding-top:26px; border-top:1px solid rgba(0,0,0,0.1);
  }
  .hero-trust div b{
    display:block; font-family:'Big Shoulders Display',sans-serif; font-size:30px; font-weight:800; color:var(--aspal);
  }
  .hero-trust div span{font-size:12.5px; color:var(--teks-mute); text-transform:uppercase; letter-spacing:0.05em;}

  /* car illustration */
  .car-scene{position:relative; height:100%; display:flex; align-items:center; justify-content:center;}
  .car-card-visual{
    position:relative;
    background:var(--aspal);
    border-radius:6px;
    padding:34px 30px 26px;
    box-shadow:10px 10px 0 var(--marka);
  }
  .car-card-visual svg{width:100%; height:auto;}
  .odometer{
    position:absolute; bottom:-22px; left:26px;
    background:var(--kapur); border:2px solid var(--aspal); border-radius:4px;
    padding:9px 14px; display:flex; gap:10px; align-items:center;
    box-shadow:5px 5px 0 var(--merah);
  }
  .odometer .k{font-family:'JetBrains Mono'; font-weight:700; font-size:14px;}
  .odometer .l{font-size:10.5px; color:var(--teks-mute); text-transform:uppercase; letter-spacing:.06em;}

  /* ===== SECTION HEAD ===== */
  section{position:relative; z-index:1;}
  .sec-head{max-width:600px; margin-bottom:50px;}
  .sec-head h2{font-size:clamp(32px,4vw,46px); color:var(--aspal); margin-top:12px;}
  .sec-head p{color:var(--teks-mute); font-size:16px; margin-top:14px;}
  .sec-head.center{margin-left:auto; margin-right:auto; text-align:center;}

  /* ===== TRUST STRIP ===== */
  .stripe{
    background:var(--aspal); color:var(--kapur);
    padding:16px 0; overflow:hidden;
  }
  .stripe .track{
    display:flex; gap:60px; white-space:nowrap;
    font-family:'JetBrains Mono'; font-size:13px; letter-spacing:.08em; text-transform:uppercase;
    animation:scroll 26s linear infinite;
  }
  .stripe .track span{opacity:0.8;}
  .stripe .track span b{color:var(--marka);}
  @keyframes scroll{ from{transform:translateX(0);} to{transform:translateX(-50%);} }

  /* ===== RUTE / HOW IT WORKS ===== */
  .rute{padding:110px 0 100px;}
  .rute-road{
    position:relative;
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:24px;
    margin-top:20px;
  }
  .rute-road::before{
    content:"";
    position:absolute; top:29px; left:6%; right:6%; height:2px;
    background:repeating-linear-gradient(to right, var(--aspal) 0 16px, transparent 16px 30px);
    z-index:0;
  }
  .marker{position:relative; z-index:1;}
  .marker .pin{
    width:58px; height:58px; border-radius:50%;
    background:var(--kapur); border:2.5px solid var(--aspal);
    display:flex; align-items:center; justify-content:center;
    font-family:'JetBrains Mono'; font-weight:700; font-size:16px;
    margin-bottom:22px;
    transition:background .2s ease, color .2s ease;
  }
  .marker:nth-child(4) .pin{background:var(--merah); color:var(--kapur); border-color:var(--merah);}
  .marker h3{font-size:21px; text-transform:none; letter-spacing:0; font-weight:700; font-family:'Plus Jakarta Sans'; color:var(--aspal); margin-bottom:8px;}
  .marker p{font-size:14.5px; color:var(--teks-mute);}
  @media (max-width:820px){
    .rute-road{grid-template-columns:1fr; gap:34px;}
    .rute-road::before{display:none;}
  }

  /* ===== ARMADA / CARS ===== */
  .armada{padding:90px 0 100px; background:var(--kapur-dim);}
  .fleet-grid{
    display:grid; grid-template-columns:repeat(3,1fr); gap:26px; margin-top:10px;
  }
  .fleet-card{
    background:var(--kapur);
    border-radius:4px;
    overflow:hidden;
    border:1.5px solid rgba(0,0,0,0.08);
    transition:transform .2s ease, box-shadow .2s ease;
  }
  .fleet-card:hover{transform:translateY(-6px); box-shadow:0 14px 0 -8px rgba(0,0,0,0.15), 8px 8px 0 var(--aspal);}
  .fleet-media{
    height:170px; background:var(--aspal);
    display:flex; align-items:center; justify-content:center; position:relative;
  }
  .fleet-media .cat{
    position:absolute; top:12px; left:12px;
    font-family:'JetBrains Mono'; font-size:10.5px; letter-spacing:.06em;
    background:var(--marka); color:var(--aspal); padding:4px 9px; border-radius:2px; font-weight:700; text-transform:uppercase;
  }
  .fleet-media svg{width:78%;}
  .fleet-body{padding:22px 22px 24px;}
  .fleet-body h3{font-size:19px; text-transform:none; letter-spacing:0; font-weight:700; font-family:'Plus Jakarta Sans'; color:var(--aspal);}
  .fleet-specs{display:flex; gap:14px; margin:12px 0 16px; font-size:12.5px; color:var(--teks-mute); flex-wrap:wrap;}
  .fleet-specs span{display:flex; align-items:center; gap:5px;}
  .fleet-foot{display:flex; align-items:center; justify-content:space-between; border-top:1px dashed rgba(0,0,0,0.15); padding-top:16px;}
  .price{font-family:'JetBrains Mono'; font-weight:700; font-size:19px; color:var(--aspal);}
  .price small{font-weight:500; font-size:11.5px; color:var(--teks-mute); text-transform:uppercase;}
  .fleet-book{
    font-size:12.5px; font-weight:700; color:var(--merah); border-bottom:1.5px solid var(--merah); padding-bottom:2px;
  }

  /* ===== KENAPA / FEATURES ===== */
  .kenapa{padding:100px 0;}
  .feat-grid{display:grid; grid-template-columns:repeat(4,1fr); gap:2px; background:rgba(0,0,0,0.1); margin-top:20px; border:1px solid rgba(0,0,0,0.1);}
  .feat{background:var(--kapur); padding:34px 26px;}
  .feat .num{font-family:'JetBrains Mono'; color:var(--merah); font-size:12.5px; font-weight:700;}
  .feat h3{font-size:19px; text-transform:none; letter-spacing:0; font-weight:700; font-family:'Plus Jakarta Sans'; margin:14px 0 10px; color:var(--aspal);}
  .feat p{font-size:14px; color:var(--teks-mute);}
  @media (max-width:900px){ .feat-grid{grid-template-columns:1fr 1fr;} }
  @media (max-width:560px){ .feat-grid{grid-template-columns:1fr;} }

  /* ===== TESTIMONI ===== */
  .testi{background:var(--aspal); color:var(--kapur); padding:100px 0;}
  .testi .wrap{display:grid; grid-template-columns:0.9fr 1.1fr; gap:60px; align-items:center;}
  .testi blockquote{
    font-family:'Big Shoulders Display'; font-weight:700; text-transform:none; letter-spacing:0;
    font-size:clamp(24px,2.6vw,32px); line-height:1.3;
  }
  .testi blockquote span{color:var(--marka);}
  .testi-who{display:flex; align-items:center; gap:14px; margin-top:28px;}
  .avatar{width:46px; height:46px; border-radius:50%; background:var(--merah); display:flex; align-items:center; justify-content:center; font-weight:700; font-family:'JetBrains Mono';}
  .testi-who .name{font-weight:700; font-size:15px;}
  .testi-who .role{font-size:12.5px; color:var(--perak);}
  .testi-stats{display:grid; grid-template-columns:1fr 1fr; gap:2px; background:rgba(255,255,255,0.12);}
  .tstat{background:var(--aspal-soft); padding:30px 26px;}
  .tstat b{display:block; font-family:'Big Shoulders Display'; font-size:40px; font-weight:800; color:var(--marka);}
  .tstat span{font-size:12.5px; color:var(--perak); text-transform:uppercase; letter-spacing:.05em;}
  @media (max-width:820px){ .testi .wrap{grid-template-columns:1fr;} }

  /* ===== CTA APP ===== */
  .app-cta{padding:90px 0;}
  .app-box{
    background:var(--merah); color:var(--kapur);
    border-radius:6px; padding:64px 60px;
    display:grid; grid-template-columns:1.2fr 0.8fr; gap:30px; align-items:center;
    position:relative; overflow:hidden;
  }
  .app-box::after{
    content:"TEMPUH"; position:absolute; right:-30px; bottom:-50px;
    font-family:'Big Shoulders Display'; font-size:180px; font-weight:900; color:rgba(255,255,255,0.08);
    letter-spacing:0.02em; pointer-events:none;
  }
  .app-box h2{font-size:clamp(28px,3.4vw,42px); position:relative; z-index:1;}
  .app-box p{margin-top:14px; opacity:0.9; max-width:420px; position:relative; z-index:1;}
  .app-box .stores{display:flex; gap:14px; margin-top:26px; position:relative; z-index:1; flex-wrap:wrap;}
  @media (max-width:820px){ .app-box{grid-template-columns:1fr; padding:44px 28px;} .app-box::after{display:none;} }

  /* ===== FOOTER ===== */
  footer{background:var(--aspal); color:var(--perak); padding:70px 0 30px; font-size:14px;}
  .foot-grid{display:grid; grid-template-columns:1.4fr 1fr 1fr 1fr; gap:40px; padding-bottom:50px; border-bottom:1px solid rgba(255,255,255,0.12);}
  .foot-grid h4{color:var(--kapur); font-size:13px; text-transform:uppercase; letter-spacing:.08em; margin-bottom:18px; font-family:'JetBrains Mono';}
  .foot-grid ul{list-style:none; display:flex; flex-direction:column; gap:10px;}
  .foot-grid ul a:hover{color:var(--kapur);}
  .foot-bottom{display:flex; justify-content:space-between; align-items:center; padding-top:26px; flex-wrap:wrap; gap:14px; font-size:12.5px;}
  @media (max-width:820px){ .foot-grid{grid-template-columns:1fr 1fr; row-gap:34px;} }

  @media (max-width:900px){
    .hero-grid{grid-template-columns:1fr;}
    .car-scene{order:-1; margin-bottom:20px;}
    .fleet-grid{grid-template-columns:1fr 1fr;}
  }
  @media (max-width:600px){
    .wrap{padding:0 20px;}
    .fleet-grid{grid-template-columns:1fr;}
    .hero-trust{flex-wrap:wrap; row-gap:18px;}
  }

  /* focus visibility */
  a:focus-visible, button:focus-visible{outline:2.5px solid var(--merah); outline-offset:3px;}
</style>
</head>
<body>

<header>
  <nav>
    <div class="logo"><span class="dot"></span>TEMPUH ID</div>
    <div class="navlinks">
      <a href="#armada">Armada</a>
      <a href="#rute">Cara Kerja</a>
      <a href="#testimoni">Testimoni</a>
      <a href="#kontak">Kontak</a>
    </div>
    <div class="navcta">
      <span class="tel">☎ 0856-0938-4017</span>
      <a href="{{ route('login') }}" class="btn btn-primary" style="padding:11px 20px; font-size:13.5px;">Sewa Sekarang</a>
    </div>
  </nav>
</header>

<section class="hero">
  <div class="wrap">
    <div class="hero-grid">
      <div>
        <div class="plate-tag"><span class="flag">RI</span> SEWA · ANTAR-JEMPUT · 24 JAM</div>
        <h1 class="hero-head">Jalan Terus,<br>Urusan <em>Beres</em>.</h1>
        <p class="lede">Sewa mobil tanpa drama — pilih armada, kunci booking dalam 2 menit, mobil siap antar ke depan pintu. Untuk mudik, dinas, atau sekadar keluar kota.</p>
        <div class="hero-actions">
          <a href="#armada" class="btn btn-primary">Lihat Armada →</a>
          <a href="#rute" class="btn btn-ghost">Cara Kerjanya</a>
        </div>
        <div class="hero-trust">
          <div><b>5+</b><span>Unit Armada</span></div>
          <div><b>2</b><span>Kota Tersedia</span></div>
          <div><b>4.9/5</b><span>Rating Penyewa</span></div>
        </div>
      </div>

      <div class="car-scene">
        <div class="car-card-visual">
          <svg viewBox="0 0 340 170" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="0" y="0" width="340" height="170" fill="none"/>
            <path d="M18 118 Q18 100 42 96 L78 92 Q94 66 118 62 L210 60 Q232 60 246 80 L262 96 L300 100 Q318 102 318 118 L318 132 L18 132 Z" stroke="#F7F4EE" stroke-width="3" fill="none"/>
            <path d="M96 92 L112 66 Q120 62 132 62 L176 62 Q186 62 190 70 L196 92 Z" stroke="#F2B705" stroke-width="3" fill="none"/>
            <line x1="150" y1="62" x2="150" y2="92" stroke="#F2B705" stroke-width="2"/>
            <circle cx="80" cy="132" r="20" fill="#18181A" stroke="#F7F4EE" stroke-width="3"/>
            <circle cx="80" cy="132" r="7" fill="#F7F4EE"/>
            <circle cx="256" cy="132" r="20" fill="#18181A" stroke="#F7F4EE" stroke-width="3"/>
            <circle cx="256" cy="132" r="7" fill="#F7F4EE"/>
            <circle cx="298" cy="104" r="4" fill="#D93A2B"/>
            <circle cx="34" cy="104" r="3" fill="#F7F4EE"/>
            <line x1="18" y1="146" x2="318" y2="146" stroke="#F7F4EE" stroke-width="2" stroke-dasharray="8 8" opacity="0.4"/>
          </svg>
          <div class="odometer">
            <span class="k">08.24</span>
            <span class="l">Jam · Booking<br>Rata-rata</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="stripe">
  <div class="track">
    <span>✓ <b>GRATIS</b> ANTAR-JEMPUT DALAM KOTA</span>
    <span>✓ ASURANSI PERJALANAN TERMASUK</span>
    <span>✓ BATAL <b>GRATIS</b> H-24</span>
    <span>✓ SUPPORT SIAGA 24 JAM</span>
    <span>✓ <b>GRATIS</b> ANTAR-JEMPUT DALAM KOTA</span>
    <span>✓ ASURANSI PERJALANAN TERMASUK</span>
    <span>✓ BATAL <b>GRATIS</b> H-24</span>
    <span>✓ SUPPORT SIAGA 24 JAM</span>
  </div>
</div>

<section class="rute" id="rute">
  <div class="wrap">
    <div class="sec-head center" style="margin-left:auto;margin-right:auto;">
      <div class="eyebrow" style="justify-content:center;">RUTE PEMESANAN</div>
      <h2>Empat Langkah ke Jalan Raya</h2>
      <p>Bukan formalitas — ini urutan yang benar-benar kamu lalui, dari cari sampai nyetir.</p>
    </div>

    <div class="rute-road">
      <div class="marker">
        <div class="pin">KM1</div>
        <h3>Cari & Bandingkan</h3>
        <p>Masukkan kota, tanggal, dan jenis mobil. Kami tampilkan yang tersedia hari itu juga.</p>
      </div>
      <div class="marker">
        <div class="pin">KM2</div>
        <h3>Pilih Unit</h3>
        <p>Cek spesifikasi, foto asli, dan riwayat servis sebelum kunci pilihan.</p>
      </div>
      <div class="marker">
        <div class="pin">KM3</div>
        <h3>Konfirmasi & Bayar</h3>
        <p>Booking terkunci dengan DP, sisa dibayar saat serah terima kunci.</p>
      </div>
      <div class="marker">
        <div class="pin">TIBA</div>
        <h3>Jemput & Jalan</h3>
        <p>Mobil diantar sesuai jadwal, cek unit bareng driver kami, lalu berangkat.</p>
      </div>
    </div>
  </div>
</section>

<section class="armada" id="armada">
  <div class="wrap">
    <div class="sec-head">
      <div class="eyebrow">ARMADA TERSEDIA</div>
      <h2>Pilih Sesuai Medan Perjalananmu</h2>
      <p>Dari city car harian sampai SUV untuk luar kota — semua unit diservis rutin sebelum diantar.</p>
    </div>

    <div class="fleet-grid">

      <div class="fleet-card">
        <div class="fleet-media">
          <span class="cat">CITY CAR</span>
          <svg viewBox="0 0 200 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 70 Q12 58 28 56 L48 54 Q58 38 74 36 L128 36 Q140 36 148 48 L158 56 L180 58 Q190 60 190 70 L190 78 L12 78 Z" stroke="#F7F4EE" stroke-width="2.5" fill="none"/>
            <circle cx="52" cy="78" r="12" fill="#242427" stroke="#F7F4EE" stroke-width="2.5"/>
            <circle cx="150" cy="78" r="12" fill="#242427" stroke="#F7F4EE" stroke-width="2.5"/>
          </svg>
        </div>
        <div class="fleet-body">
          <h3>Toyota Agya 2023</h3>
          <div class="fleet-specs">
            <span>⚙ Matic</span><span>👤 4 Kursi</span><span>⛽ Irit Kota</span>
          </div>
          <div class="fleet-foot">
            <div class="price">Rp275rb<small> /hari</small></div>
            <a href="#kontak" class="fleet-book">Booking →</a>
          </div>
        </div>
      </div>

      <div class="fleet-card">
        <div class="fleet-media">
          <span class="cat">SEDAN</span>
          <svg viewBox="0 0 200 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 68 Q10 56 26 54 L44 52 Q56 34 76 32 L124 32 Q140 32 150 46 L162 54 L182 56 Q192 58 192 68 L192 76 L10 76 Z" stroke="#F7F4EE" stroke-width="2.5" fill="none"/>
            <line x1="100" y1="32" x2="100" y2="54" stroke="#F2B705" stroke-width="2"/>
            <circle cx="50" cy="76" r="12" fill="#242427" stroke="#F7F4EE" stroke-width="2.5"/>
            <circle cx="152" cy="76" r="12" fill="#242427" stroke="#F7F4EE" stroke-width="2.5"/>
          </svg>
        </div>
        <div class="fleet-body">
          <h3>Honda Civic 2022</h3>
          <div class="fleet-specs">
            <span>⚙ Matic</span><span>👤 5 Kursi</span><span>🛣 Luar Kota</span>
          </div>
          <div class="fleet-foot">
            <div class="price">Rp650rb<small> /hari</small></div>
            <a href="#kontak" class="fleet-book">Booking →</a>
          </div>
        </div>
      </div>

      <div class="fleet-card">
        <div class="fleet-media">
          <span class="cat">SUV</span>
          <svg viewBox="0 0 200 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 64 Q8 48 26 46 L40 44 Q52 22 76 20 L132 20 Q148 20 158 36 L170 46 L184 48 Q194 50 194 64 L194 76 L8 76 Z" stroke="#F7F4EE" stroke-width="2.5" fill="none"/>
            <line x1="118" y1="20" x2="118" y2="46" stroke="#F2B705" stroke-width="2"/>
            <circle cx="52" cy="76" r="13" fill="#242427" stroke="#F7F4EE" stroke-width="2.5"/>
            <circle cx="156" cy="76" r="13" fill="#242427" stroke="#F7F4EE" stroke-width="2.5"/>
          </svg>
        </div>
        <div class="fleet-body">
          <h3>Mitsubishi Pajero 2023</h3>
          <div class="fleet-specs">
            <span>⚙ Matic</span><span>👤 7 Kursi</span><span>🏔 4WD</span>
          </div>
          <div class="fleet-foot">
            <div class="price">Rp950rb<small> /hari</small></div>
            <a href="#kontak" class="fleet-book">Booking →</a>
          </div>
        </div>
      </div>

    </div>

    <div style="text-align:center; margin-top:44px;">
      <a href="#kontak" class="btn btn-ghost">Lihat Semua 5+ Unit</a>
    </div>
  </div>
</section>

<section class="kenapa">
  <div class="wrap">
    <div class="sec-head">
      <div class="eyebrow">KENAPA TEMPUH ID</div>
      <h2>Dibangun untuk Penyewa yang Buru-buru</h2>
    </div>
    <div class="feat-grid">
      <div class="feat">
        <div class="num">/01</div>
        <h3>Tanpa Biaya Siluman</h3>
        <p>Harga yang tampil di layar adalah harga yang kamu bayar. Tidak ada biaya kejutan saat serah terima.</p>
      </div>
      <div class="feat">
        <div class="num">/02</div>
        <h3>Booking 2 Menit</h3>
        <p>Tiga langkah, tanpa formulir panjang. Konfirmasi langsung masuk WhatsApp kamu.</p>
      </div>
      <div class="feat">
        <div class="num">/03</div>
        <h3>Batal Fleksibel</h3>
        <p>Rencana berubah? Batalkan gratis hingga 24 jam sebelum jadwal jemput.</p>
      </div>
      <div class="feat">
        <div class="num">/04</div>
        <h3>Siaga Sepanjang Jalan</h3>
        <p>Ada kendala di jalan? Tim darurat kami merespons rata-rata dalam 15 menit.</p>
      </div>
    </div>
  </div>
</section>

<section class="testi" id="testimoni">
  <div class="wrap">
    <div>
      <blockquote>"Mobil diantar tepat waktu, kondisi mulus, dan <span>harganya persis</span> seperti yang tertera di app — tidak ada tambahan aneh-aneh."</blockquote>
      <div class="testi-who">
        <div class="avatar">RR</div>
        <div>
          <div class="name">Ridha Ramadhani</div>
          <div class="role">Penyewa, Perjalanan Pekanbaru–Payakumbuh</div>
        </div>
      </div>
    </div>
    <div class="testi-stats">
      <div class="tstat"><b>98%</b><span>Booking Tepat Waktu</span></div>
      <div class="tstat"><b>15mnt</b><span>Respons Darurat</span></div>
      <div class="tstat"><b>4.9</b><span>Rating Rata-rata</span></div>
      <div class="tstat"><b>52rb+</b><span>Perjalanan Selesai</span></div>
    </div>
  </div>
</section>

<section class="app-cta" id="kontak">
  <div class="wrap">
    <div class="app-box">
      <div>
        <h2>Siap Berangkat?<br>Booking Sekarang</h2>
        <p>Chat tim kami untuk cek ketersediaan unit, atau langsung isi form booking — balasan rata-rata di bawah 5 menit.</p>
        <div class="stores">
          <a href="https://wa.me/62856093840176" class="btn btn-light">💬 Chat via WhatsApp</a>
          <a href="#armada" class="btn btn-light">📋 Isi Form Booking</a>
        </div>
      </div>
      <div></div>
    </div>
  </div>
</section>

<footer>
  <div class="wrap">
    <div class="foot-grid">
      <div>
        <div class="logo" style="color:var(--kapur); margin-bottom:14px;"><span class="dot"></span>TEMPUH</div>
        <p style="max-width:260px; color:var(--perak);">Platform sewa mobil untuk perjalanan dalam dan luar kota — antar-jemput, terjadwal, terpantau.</p>
      </div>
      <div>
        <h4>Layanan</h4>
        <ul>
          <li><a href="#armada">Sewa Harian</a></li>
          <li><a href="#armada">Sewa Mingguan</a></li>
        </ul>
      </div>
      <div>
        <h4>Perusahaan</h4>
        <ul>
          <li><a href="#">Tentang Kami</a></li>
          <li><a href="#">Karier</a></li>
          <li><a href="#">Blog Perjalanan</a></li>
        </ul>
      </div>
      <div>
        <h4>Kontak</h4>
        <ul>
          <li>0856-0938-4017</li>
          <li>halo@tempuh.id</li>
          <li>Jakarta · Bandung · Surabaya</li>
        </ul>
      </div>
    </div>
    <div class="foot-bottom">
      <span>© 2026 Tempuh ID. Semua hak dilindungi.</span>
      <span>Syarat & Ketentuan · Kebijakan Privasi</span>
    </div>
  </div>
</footer>

</body>
</html>