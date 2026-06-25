<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Door Prize Gotilon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * { box-sizing:border-box; }

        body {
            margin:0;
            min-height:100vh;
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(244,197,66,.35), transparent 30%),
                linear-gradient(135deg,#eef3ff,#f8fafc);
            display:flex;
            align-items:center;
            justify-content:center;
            padding:20px;
            color:#101a3d;
        }

        .login-wrapper {
            width:100%;
            max-width:980px;
            display:grid;
            grid-template-columns:1.1fr .9fr;
            background:white;
            border-radius:32px;
            overflow:hidden;
            box-shadow:0 30px 80px rgba(16,26,61,.20);
        }

        .login-hero {
            background:linear-gradient(135deg,#101a3d,#1e2d68);
            color:white;
            padding:48px;
            position:relative;
            overflow:hidden;
        }

        .login-hero::after {
            content:"";
            position:absolute;
            width:260px;
            height:260px;
            border-radius:50%;
            background:rgba(244,197,66,.16);
            right:-90px;
            bottom:-90px;
        }

        .brand-icon {
            width:62px;
            height:62px;
            border-radius:20px;
            background:linear-gradient(135deg,#f4c542,#fff0a8);
            color:#101a3d;
            display:grid;
            place-items:center;
            font-size:34px;
            font-weight:900;
            margin-bottom:22px;
        }

        .login-hero h1 {
            margin:0 0 12px;
            font-size:38px;
            line-height:1.15;
        }

        .login-hero p {
            color:#dbe3ff;
            line-height:1.7;
            font-size:16px;
            max-width:390px;
        }

        .hero-points {
            margin-top:34px;
            display:grid;
            gap:14px;
        }

        .hero-point {
            background:rgba(255,255,255,.10);
            border:1px solid rgba(255,255,255,.14);
            border-radius:18px;
            padding:14px 16px;
            color:#eef2ff;
            font-weight:bold;
        }

        .login-form {
            padding:48px;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .login-form h2 {
            margin:0 0 8px;
            font-size:30px;
            color:#101a3d;
        }

        .login-form .subtitle {
            margin:0 0 28px;
            color:#6b7280;
        }

        label {
            display:block;
            font-size:13px;
            font-weight:bold;
            color:#374151;
            margin-bottom:8px;
        }

        input {
            width:100%;
            border:1px solid #dbe1ef;
            border-radius:14px;
            padding:14px 15px;
            font-size:15px;
            outline:none;
            margin-bottom:16px;
        }

        input:focus {
            border-color:#f4c542;
            box-shadow:0 0 0 4px rgba(244,197,66,.20);
        }

        .remember-row {
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
            margin:2px 0 22px;
        }

        .remember-left {
            display:flex;
            align-items:center;
            gap:8px;
            color:#6b7280;
            font-size:14px;
        }

        .remember-left input {
            width:auto;
            margin:0;
        }

        .login-btn {
            width:100%;
            background:linear-gradient(135deg,#f4c542,#ffb21c);
            color:#101a3d;
            border:0;
            border-radius:14px;
            padding:15px;
            font-weight:900;
            font-size:15px;
            cursor:pointer;
        }

        .login-btn:hover {
            filter:brightness(.98);
            transform:translateY(-1px);
        }

        .public-link {
            display:block;
            text-align:center;
            margin-top:18px;
            color:#101a3d;
            text-decoration:none;
            font-weight:bold;
        }

        .error-box {
            background:#fee2e2;
            color:#991b1b;
            border-left:5px solid #dc2626;
            border-radius:14px;
            padding:14px;
            margin-bottom:18px;
            font-size:14px;
        }

        @media(max-width:850px){
            .login-wrapper {
                grid-template-columns:1fr;
            }

            .login-hero {
                padding:34px;
            }

            .login-form {
                padding:34px;
            }

            .login-hero h1 {
                font-size:30px;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-hero">
        <div class="brand-icon">✦</div>
        <h1>Door Prize Gotilon</h1>
        <p>
          Welcome Admin👋
        </p>

        <div class="hero-points">

            <div class="hero-point">💰 Pantau Kupon</div>
            <div class="hero-point">🏆 Pengundian lebih transparan</div>
        </div>
    </div>

    <div class="login-form">
        <h2>Login Admin</h2>
        <p class="subtitle">Masuk untuk mengelola sistem undian Gotilon.</p>

        @if ($errors->any())
            <div class="error-box">
                Email atau password tidak sesuai.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label>Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="admin@gotilon.com"
                required
                autofocus
            >

            <label>Password</label>
            <input
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <div class="remember-row">
                <label class="remember-left">
                    <input type="checkbox" name="remember">
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="login-btn">
                Masuk Dashboard
            </button>
        </form>

        <a href="{{ route('public.winners') }}" class="public-link">
            Lihat Daftar Pemenang
        </a>
    </div>
</div>

</body>
</html>
