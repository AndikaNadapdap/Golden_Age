<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Verifikasi OTP • Panduan 1000 Hari</title>
  <style>
    :root{
      --brand-1:#45E3D6;
      --brand-2:#2FBFD0;
      --brand-3:#1FA6C6;
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
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans";
      color:var(--ink);
      min-height:100vh;
      display:grid;
      place-items:center;
      background:
        radial-gradient(900px 600px at 30% 20%, rgba(69,227,214,.35), transparent 60%),
        radial-gradient(900px 600px at 80% 60%, rgba(31,166,198,.30), transparent 60%),
        linear-gradient(135deg, rgba(69,227,214,.35), rgba(31,166,198,.25));
      padding: 18px;
    }
    .card{
      width:min(560px, 92vw);
      background:var(--card);
      border:1px solid rgba(231,238,245,.95);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
      padding: 26px;
    }
    .top{
      display:flex;
      align-items:center;
      gap:14px;
      margin-bottom:14px;
    }
    .top img{
      width:54px;height:54px;border-radius:16px;
      box-shadow: 0 10px 28px rgba(31,166,198,.25);
      background:#fff; object-fit:cover;
    }
    h2{margin:0; font-size:22px; letter-spacing:-.3px}
    .sub{margin:4px 0 0; color:var(--muted); font-size:13.5px}

    .pill{
      display:inline-flex;
      gap:10px;
      align-items:center;
      padding:8px 12px;
      border-radius:999px;
      background:#F6FBFF;
      border:1px solid var(--line);
      color:var(--muted);
      font-size:13px;
      margin: 10px 0 16px;
    }

    .alert{
      padding:12px 14px;
      border-radius:14px;
      margin-bottom:14px;
      font-size:14px;
    }
    .alert.ok{background: rgba(23,183,94,.10); border:1px solid rgba(23,183,94,.25); color:#0C5F33;}
    .alert.err{background: rgba(255,77,79,.10); border:1px solid rgba(255,77,79,.25); color:#8A1F1F;}

    label{display:block; font-size:13px; color:var(--muted); margin: 10px 0 8px;}
    .input{
      width:100%;
      border:1px solid var(--line);
      background:#FBFDFF;
      border-radius: 16px;
      padding: 14px 14px;
      font-size:15px;
      outline:none;
      transition:.15s ease;
    }
    .input:focus{
      border-color: rgba(47,191,208,.8);
      box-shadow: 0 0 0 6px rgba(69,227,214,.18);
      background:#fff;
    }
    .row{display:grid; grid-template-columns: 1fr; gap:10px;}
    .btn{
      border:none;
      border-radius: 16px;
      padding: 14px 16px;
      font-weight: 800;
      cursor:pointer;
      transition:.15s ease;
      background: linear-gradient(180deg, var(--wa), var(--wa-dark));
      color:#fff;
      box-shadow: 0 10px 28px rgba(23,183,94,.25);
    }
    .btn:hover{ transform: translateY(-1px); }
    .btn:active{ transform: translateY(0px); }

    .links{
      margin-top:14px;
      display:flex;
      justify-content:space-between;
      flex-wrap:wrap;
      gap:10px;
    }
    .link{
      text-decoration:none;
      color: rgba(31,166,198,1);
      font-weight:600;
      font-size:13px;
    }
    .link:hover{text-decoration:underline}
  </style>
</head>
<body>
  <div class="card">
    <div class="top">
      <img src="{{ asset('images/logo.png') }}" alt="Logo Panduan 1000 Hari">
      <div>
        <h2>Verifikasi OTP</h2>
        <div class="sub">Masukkan kode 6 digit yang dikirim ke WhatsApp kamu</div>
      </div>
    </div>

    <div class="pill">
      Nomor WhatsApp: <b>{{ $phone ?? '' }}</b>
    </div>

    @if (session('status'))
      <div class="alert ok">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
      <div class="alert err">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('otp.verify') }}">
      @csrf

      <input type="hidden" name="phone" value="{{ $phone ?? old('phone') }}">

      <div class="row">
        <div>
          <label for="otp">Kode OTP (6 digit)</label>
          <input id="otp" name="otp" class="input" inputmode="numeric" placeholder="123456" required>
        </div>

        <button class="btn" type="submit">Verifikasi & Login</button>
      </div>

      <div class="links">
        <a class="link" href="{{ route('otp.request.form') }}">Request OTP ulang</a>
        <a class="link" href="{{ route('login') }}">Kembali ke Login Email</a>
      </div>
    </form>
  </div>
</body>
</html>
