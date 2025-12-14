<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Masuk via WhatsApp • Panduan 1000 Hari</title>
  <style>
    :root{
      /* Palette sesuai logo (turquoise) */
      --brand-1:#45E3D6;  /* mint */
      --brand-2:#2FBFD0;  /* teal */
      --brand-3:#1FA6C6;  /* blue-teal */
      --ink:#0B1B2A;
      --muted:#5B6B7A;
      --card:#ffffff;
      --line:#E7EEF5;

      --wa:#17B75E;
      --wa-dark:#0FA151;
      --shadow: 0 18px 55px rgba(7, 25, 40, .18);
      --radius: 22px;
    }

    *{box-sizing:border-box}
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans", "Helvetica Neue", sans-serif;
      color:var(--ink);
      min-height:100vh;
      display:grid;
      place-items:center;
      background:
        radial-gradient(900px 600px at 30% 20%, rgba(69,227,214,.35), transparent 60%),
        radial-gradient(900px 600px at 80% 60%, rgba(31,166,198,.30), transparent 60%),
        linear-gradient(135deg, rgba(69,227,214,.35), rgba(31,166,198,.25));
    }

    .wrap{
      width:min(980px, 92vw);
      display:grid;
      grid-template-columns: 1.1fr 1fr;
      gap:28px;
      align-items:center;
      padding: 22px;
    }

    @media (max-width: 900px){
      .wrap{grid-template-columns:1fr; padding:14px}
      .hero{order:-1}
    }

    .hero{
      padding: 10px 10px 10px 6px;
    }
    .brand{
      display:flex;
      align-items:center;
      gap:14px;
      margin-bottom:18px;
    }
    .brand img{
      width:62px;
      height:62px;
      border-radius:18px;
      box-shadow: 0 10px 28px rgba(31,166,198,.25);
      background:#fff;
      object-fit:cover;
    }
    .brand h1{
      font-size:34px;
      line-height:1.1;
      margin:0;
      letter-spacing:-.6px;
    }
    .brand p{
      margin:6px 0 0;
      color:var(--muted);
      font-size:14px;
    }

    .heroCard{
      background: rgba(255,255,255,.55);
      border:1px solid rgba(255,255,255,.55);
      border-radius: var(--radius);
      padding:18px 18px;
      backdrop-filter: blur(10px);
    }
    .heroCard .pill{
      display:inline-flex;
      align-items:center;
      gap:10px;
      padding:8px 12px;
      border-radius:999px;
      background: rgba(255,255,255,.75);
      border:1px solid rgba(231,238,245,.9);
      color:var(--muted);
      font-size:13px;
      margin-bottom:12px;
    }
    .dot{
      width:10px;height:10px;border-radius:999px;
      background: linear-gradient(180deg, var(--brand-1), var(--brand-3));
      box-shadow: 0 0 0 6px rgba(69,227,214,.18);
    }

    .card{
      background: var(--card);
      border:1px solid rgba(231,238,245,.95);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 26px;
    }

    .title{
      font-size:26px;
      margin:0 0 6px;
      letter-spacing:-.4px;
    }
    .subtitle{
      margin:0 0 18px;
      color:var(--muted);
      font-size:14px;
      line-height:1.55;
    }

    .alert{
      padding:12px 14px;
      border-radius:14px;
      margin-bottom:14px;
      font-size:14px;
    }
    .alert.ok{
      background: rgba(23,183,94,.10);
      border:1px solid rgba(23,183,94,.25);
      color:#0C5F33;
    }
    .alert.err{
      background: rgba(255,77,79,.10);
      border:1px solid rgba(255,77,79,.25);
      color:#8A1F1F;
    }

    label{
      display:block;
      font-size:13px;
      color:var(--muted);
      margin: 10px 0 8px;
    }

    .field{
      display:flex;
      gap:10px;
      align-items:stretch;
    }

    .input{
      flex:1;
      border:1px solid var(--line);
      background: #FBFDFF;
      border-radius: 16px;
      padding: 14px 14px;
      font-size:15px;
      outline:none;
      transition: .15s ease;
    }
    .input:focus{
      border-color: rgba(47,191,208,.8);
      box-shadow: 0 0 0 6px rgba(69,227,214,.18);
      background:#fff;
    }

    .btn{
      border:none;
      border-radius: 16px;
      padding: 0 18px;
      min-width: 140px;
      font-weight: 700;
      cursor:pointer;
      display:flex;
      align-items:center;
      justify-content:center;
      gap:10px;
      transition: .15s ease;
      background: linear-gradient(180deg, var(--wa), var(--wa-dark));
      color:#fff;
      box-shadow: 0 10px 28px rgba(23,183,94,.25);
    }
    .btn:hover{ transform: translateY(-1px); }
    .btn:active{ transform: translateY(0px); }

    .hint{
      margin-top:10px;
      color:var(--muted);
      font-size:12.5px;
      line-height:1.5;
    }

    .links{
      margin-top:18px;
      display:flex;
      gap:10px;
      flex-wrap:wrap;
    }
    .link{
      text-decoration:none;
      color: rgba(31,166,198,1);
      font-weight:600;
      font-size:13px;
    }
    .link:hover{ text-decoration:underline; }

    .footer{
      margin-top:18px;
      color: rgba(255,255,255,.85);
      font-size:12px;
      text-align:center;
    }

    .waIcon{
      width:18px;height:18px;
      display:inline-block;
      border-radius:6px;
      background: rgba(255,255,255,.18);
      position:relative;
    }
    .waIcon:before{
      content:"";
      position:absolute; inset:4px;
      border-radius:5px;
      background: rgba(255,255,255,.95);
      clip-path: polygon(10% 15%, 90% 15%, 90% 85%, 10% 85%);
      opacity:.0; /* dekor kecil saja */
    }
  </style>
</head>
<body>
  <div class="wrap">
    <div class="hero">
      <div class="brand">
        {{-- Ganti src sesuai path logo kamu --}}
        <div class="logo">
          <img src="/logo-panduan1000.svg" alt="Logo Panduan 1000 Hari" width="44" height="44" style="display:block;">
        </div>
        <div>
          <h1>Panduan 1000 Hari</h1>
          <p>Login cepat & aman menggunakan OTP WhatsApp</p>
        </div>
      </div>

      <div class="heroCard">
        <div class="pill"><span class="dot"></span> OTP berlaku 5 menit • Maks 5 percobaan</div>
        <div class="pill"><span class="dot"></span> Hanya untuk akun <b>Orang Tua (User)</b></div>
      </div>

      <div class="footer">
        © {{ date('Y') }} Panduan 1000 Hari • Aman & sederhana |
        <a href="/privacy-policy" target="_blank">Privacy and Policy</a> |
        Contact: <a href="https://wa.me/6282167114827" target="_blank">+62 821-6711-4827</a>
      </div>
    </div>

    <div class="card">
      <h2 class="title">Masuk dengan WhatsApp</h2>
      <p class="subtitle">
        Masukkan nomor WhatsApp aktif kamu. Kami akan mengirim kode OTP untuk verifikasi login.
      </p>

      @if (session('status'))
        <div class="alert ok">{{ session('status') }}</div>
      @endif

      @if ($errors->any())
        <div class="alert err">
          {{ $errors->first() }}
        </div>
      @endif

      <form method="POST" action="{{ route('otp.request') }}">
        @csrf

        <label for="phone">Nomor WhatsApp</label>
        <div class="field">
          <input
            id="phone"
            name="phone"
            class="input"
            placeholder="08xxxxxxxxxx"
            inputmode="numeric"
            value="{{ old('phone') }}"
            required
          />
          <button class="btn" type="submit">
            Kirim OTP
          </button>
        </div>

        <div class="hint">
          Format: <b>10–15 digit</b>. Contoh: <b>082167114827</b>. Jangan pakai spasi/tanda +.
        </div>

        <div class="links">
          <a class="link" href="{{ route('login') }}">Kembali </a>
          <a class="link" href="{{ route('register') }}">Daftar Akun</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
