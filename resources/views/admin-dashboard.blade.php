<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Door Prize Gotilon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <style>
        :root{
            --navy:#101a3d;
            --navy-2:#16275a;
            --navy-3:#24346f;
            --gold:#f4c542;
            --gold-soft:#fff7d6;
            --bg:#eef3ff;
            --card:#ffffff;
            --muted:#6b7280;
            --text:#172033;
            --border:#e5e7eb;
            --green:#16a34a;
            --red:#dc2626;
            --purple:#7c3aed;
            --shadow:0 18px 45px rgba(16,26,61,.12);
            --shadow-soft:0 10px 28px rgba(16,26,61,.08);
        }

        *{ box-sizing:border-box; }

        body{
            margin:0;
            min-height:100vh;
            font-family:Inter, Arial, sans-serif;
            color:var(--text);
            background:
                radial-gradient(circle at top left, rgba(244,197,66,.30), transparent 30%),
                radial-gradient(circle at bottom right, rgba(16,26,61,.10), transparent 28%),
                linear-gradient(135deg,#eef3ff,#f8fafc);
        }

        .layout{
            display:flex;
            min-height:100vh;
            padding:18px;
            gap:18px;
        }

      .sidebar{
    width:280px;
    background:linear-gradient(180deg,var(--navy),#091020);
    color:white;
    border-radius:28px;
    padding:22px;
    position:sticky;
    top:18px;
    min-height:calc(100vh - 36px);
    max-height:calc(100vh - 36px);
    display:flex;
    flex-direction:column;
    box-shadow:var(--shadow);
    overflow:hidden;
}


        .brand{
            display:flex;
            gap:14px;
            align-items:center;
            margin-bottom:28px;
        }

        .brand-icon{
            width:50px;
            height:50px;
            border-radius:18px;
            background:linear-gradient(135deg,var(--gold),#fff0a8);
            color:var(--navy);
            display:grid;
            place-items:center;
            font-size:28px;
            font-weight:900;
        }

        .brand h2{
            margin:0;
            font-size:20px;
            line-height:1.2;
        }

        .brand p{
            margin:4px 0 0;
            color:#cbd5ff;
            font-size:12px;
        }

      .menu{
    flex:1;
    display:grid;
    align-content:start;
    gap:9px;
    padding-bottom:14px;
    overflow-y:auto;
    min-height:0;
}

        .menu button{
            width:100%;
            border:0;
            background:transparent;
            color:#dbe3ff;
            text-align:left;
            padding:14px 15px;
            border-radius:16px;
            font-weight:800;
            cursor:pointer;
            transition:.2s ease;
        }

        .menu button:hover,
        .menu button.active-menu{
            background:rgba(255,255,255,.13);
            color:white;
            transform:translateX(4px);
        }

      .logout-wrap{
    flex-shrink:0;
    padding-top:14px;
    border-top:1px solid rgba(255,255,255,.14);
    background:linear-gradient(180deg,rgba(9,16,32,0),#091020 20%);
}


        .user-card{
            background:rgba(255,255,255,.10);
            border:1px solid rgba(255,255,255,.14);
            padding:14px;
            border-radius:18px;
            margin-bottom:12px;
        }

        .user-card small{
            display:block;
            color:#cbd5ff;
            margin-bottom:4px;
        }

        .user-card strong{
            display:block;
            font-size:14px;
        }

       .logout-btn{
    width:100%;
    background:#dc2626;
    color:white;
        }

        .main{
            flex:1;
            min-width:0;
            overflow-x:auto;
        }

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:flex-start;
            gap:16px;
            margin:6px 4px 18px;
        }

        .topbar h1{
            margin:0;
            color:var(--navy);
            font-size:32px;
        }

        .topbar p{
            margin:6px 0 0;
            color:var(--muted);
        }

        .card{
            background:rgba(255,255,255,.90);
            backdrop-filter:blur(12px);
            border:1px solid rgba(255,255,255,.78);
            border-radius:26px;
            padding:24px;
            margin-bottom:18px;
            box-shadow:var(--shadow-soft);
        }

        .card h2,.card h3{
            margin-top:0;
            color:var(--navy);
        }

        .page{ display:none; animation:fadeIn .22s ease; }
        .page.active{ display:block; }

        @keyframes fadeIn{
            from{ opacity:0; transform:translateY(8px); }
            to{ opacity:1; transform:none; }
        }

        input,select{
            width:100%;
            padding:13px 14px;
            border-radius:14px;
            border:1px solid var(--border);
            background:white;
            margin:8px 0 14px;
            font:inherit;
            outline:none;
        }

        input:focus,select:focus{
            border-color:var(--gold);
            box-shadow:0 0 0 4px rgba(244,197,66,.18);
        }

        label{
            color:#374151;
            font-weight:800;
            font-size:13px;
        }

        button{
            padding:13px 16px;
            border-radius:14px;
            border:0;
            font-weight:900;
            cursor:pointer;
            font:inherit;
        }

        button:disabled{
            cursor:not-allowed;
            opacity:.65;
        }

        .primary{
            background:linear-gradient(135deg,var(--gold),#ffb21c);
            color:var(--navy);
        }

        .secondary{
            background:#eef2ff;
            color:var(--navy);
            border:1px solid #dbe3ff;
        }

        .danger{
            background:#fee2e2;
            color:#991b1b;
        }

        .grid-2{
            display:grid;
            grid-template-columns:repeat(2,minmax(0,1fr));
            gap:18px;
        }

        .grid-3{
            display:grid;
            grid-template-columns:repeat(3,minmax(0,1fr));
            gap:14px;
        }

        .stats{
            display:grid;
            grid-template-columns:repeat(4,minmax(0,1fr));
            gap:16px;
            margin-bottom:18px;
        }

        .stat{
            position:relative;
            overflow:hidden;
        }

        .stat::after{
            content:"";
            position:absolute;
            width:120px;
            height:120px;
            border-radius:50%;
            right:-45px;
            top:-45px;
            background:rgba(244,197,66,.16);
        }

        .stat span{
            color:var(--muted);
            font-weight:800;
            font-size:13px;
        }

        .stat strong{
            display:block;
            margin-top:8px;
            color:var(--navy);
            font-size:36px;
            line-height:1;
        }

        .dashboard-hero{
            position:relative;
            overflow:hidden;
            color:white;
            border-radius:32px;
            padding:34px;
            margin-bottom:18px;
            background:
                radial-gradient(circle at right top, rgba(244,197,66,.28), transparent 24%),
                linear-gradient(135deg,var(--navy),var(--navy-2));
            box-shadow:var(--shadow);
        }

        .dashboard-hero h1{
            margin:0 0 10px;
            font-size:38px;
        }

        .dashboard-hero p{
            margin:0;
            color:#dbe3ff;
            line-height:1.6;
        }

        .money-section{
            background:linear-gradient(135deg,#ffffff,#fffaf0);
            border:1px solid #f5e6b3;
        }

        .money-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:16px;
            margin-bottom:18px;
        }

        .money-header p{
            margin:6px 0 0;
            color:var(--muted);
        }

        .money-badge{
            background:var(--navy);
            color:var(--gold);
            padding:13px 18px;
            border-radius:999px;
            font-weight:900;
            white-space:nowrap;
        }

        .money-grid{
            display:grid;
            grid-template-columns:repeat(4,minmax(0,1fr));
            gap:14px;
        }

        .money-card{
            background:white;
            border-radius:22px;
            padding:20px;
            border:1px solid #f1f5f9;
            box-shadow:0 10px 24px rgba(16,26,61,.06);
        }

        .money-card span{
            color:var(--muted);
            font-weight:800;
            font-size:13px;
        }

        .money-card strong{
            display:block;
            margin-top:8px;
            color:var(--navy);
            font-size:25px;
        }

        .money-card.highlight{
            background:linear-gradient(135deg,var(--navy),var(--navy-3));
        }

        .money-card.highlight span{ color:#dbe3ff; }
        .money-card.highlight strong{ color:var(--gold); }

        .progress-box{ margin-top:20px; }

        .progress-info{
            display:flex;
            justify-content:space-between;
            margin-bottom:9px;
            color:var(--navy);
            font-weight:900;
        }

        .progress-track{
            height:18px;
            background:#e5e7eb;
            border-radius:999px;
            overflow:hidden;
        }

        .progress-fill{
            height:100%;
            background:linear-gradient(90deg,var(--gold),var(--green));
            border-radius:999px;
        }

        .table-wrap{
            overflow:auto;
            max-height:620px;
            border-radius:20px;
            border:1px solid #eef2f7;
        }

        table{
            width:100%;
            border-collapse:collapse;
            min-width:1050px;
            background:white;
        }

        th,td{
            padding:14px;
            border-bottom:1px solid #eef2f7;
            text-align:left;
            vertical-align:middle;
            font-size:14px;
        }

        th{
            background:#f8fafc;
            color:#64748b;
            position:sticky;
            top:0;
            z-index:2;
            font-size:12px;
            text-transform:uppercase;
            letter-spacing:.06em;
        }

        tr:hover td{
            background:#fffaf0;
        }

        .badge{
            padding:7px 11px;
            border-radius:999px;
            font-size:12px;
            font-weight:900;
            display:inline-block;
        }

        .AVAILABLE,.SALE{ background:#e5e7eb; color:#374151; }
        .REWARD{ background:#dbeafe; color:#1d4ed8; }
        .UNPAID{ background:#fee2e2; color:#991b1b; }
        .PARTIAL{ background:#fef3c7; color:#92400e; }
        .PAID{ background:#dcfce7; color:#166534; }
        .WINNER{ background:#ede9fe; color:#5b21b6; }
        .CANCELLED{ background:#111827; color:white; }

        .draw-box{
            position:relative;
            overflow:hidden;
            min-height:calc(100vh - 70px);
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            text-align:center;
            color:white;
            border-radius:34px;
            padding:52px;
            background:
                radial-gradient(circle at top left, rgba(244,197,66,.22), transparent 24%),
                radial-gradient(circle at bottom right, rgba(124,58,237,.30), transparent 28%),
                linear-gradient(135deg,#070b1c,#111b42 48%,#2d1b69);
            box-shadow:var(--shadow);
        }

        .draw-box h1{
            margin:0;
            font-size:46px;
        }

        .ticket{
            position:relative;
            background:linear-gradient(135deg,var(--gold),#fff0a8);
            color:var(--navy);
            font-size:82px;
            font-weight:1000;
            letter-spacing:.08em;
            border-radius:34px;
            padding:38px 48px;
            margin:28px auto;
            min-width:420px;
            box-shadow:0 30px 80px rgba(0,0,0,.28);
        }

        #winnerInfo{
            font-size:18px;
            color:#eef2ff;
            min-height:90px;
        }

        #drawForm input{
            background:rgba(255,255,255,.95);
            text-align:center;
            max-width:420px;
        }

        .spin{ animation:spin .12s infinite; }

        @keyframes spin{
            50%{ transform:scale(1.06) rotate(1deg); filter:blur(1px); }
        }

        .pic-form-card{
            background:linear-gradient(135deg,#ffffff,#f8fafc);
            border:1px solid #e5e7eb;
        }

        .pic-status-active{ background:#dcfce7; color:#166534; }
        .pic-status-inactive{ background:#fee2e2; color:#991b1b; }

        .action-row{
            display:flex;
            gap:8px;
            align-items:center;
            flex-wrap:wrap;
        }

        .inline-form{
            display:grid;
            grid-template-columns:180px 180px auto;
            gap:8px;
            align-items:center;
        }

        .inline-form input{ margin:0; }

        .modal-overlay{
            display:none;
            position:fixed;
            inset:0;
            background:rgba(0,0,0,.55);
            z-index:9999;
            align-items:center;
            justify-content:center;
            padding:20px;
        }

        .modal-overlay.active{ display:flex; }

        .modal-card{
            background:white;
            width:540px;
            max-width:95%;
            max-height:90vh;
            overflow:auto;
            border-radius:28px;
            padding:26px;
            box-shadow:0 30px 80px rgba(0,0,0,.28);
        }

        .modal-header{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:18px;
        }

        .modal-header h2{
            margin:0;
            color:var(--navy);
        }

        .close-btn{
            background:#fee2e2;
            color:#991b1b;
            width:42px;
            height:42px;
            padding:0;
            font-size:24px;
        }

        .toast-message{
            position:fixed;
            top:24px;
            right:24px;
            z-index:99999;
            padding:16px 20px;
            border-radius:16px;
            font-weight:900;
            box-shadow:0 18px 45px rgba(16,26,61,.22);
            animation:slideIn .25s ease;
            max-width:360px;
        }

        .toast-success{ background:#dcfce7; color:#166534; border-left:6px solid var(--green); }
        .toast-error{ background:#fee2e2; color:#991b1b; border-left:6px solid var(--red); }
        .toast-hide{ opacity:0; transform:translateX(30px); transition:.35s; }

        @keyframes slideIn{
            from{ opacity:0; transform:translateX(30px); }
            to{ opacity:1; transform:translateX(0); }
        }

        .confetti{
            position:fixed;
            top:-10px;
            width:10px;
            height:16px;
            background:var(--gold);
            z-index:999999;
            animation:fall 2.8s linear forwards;
        }

        @keyframes fall{
            to{ transform:translateY(110vh) rotate(720deg); opacity:0; }
        }

        .select2-container{
            width:100% !important;
            margin:8px 0 14px;
        }

        .select2-container--default .select2-selection--single{
            height:48px;
            border:1px solid var(--border);
            border-radius:14px;
            background:#fff;
            display:flex;
            align-items:center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered{
            width:100%;
            padding:0 42px 0 12px;
            line-height:46px;
            color:var(--text);
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow{
            height:46px;
            right:8px;
        }

        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--single{
            border-color:var(--gold);
            box-shadow:0 0 0 4px rgba(244,197,66,.18);
        }

        .select2-dropdown{
            border:1px solid #e5e7eb;
            border-radius:14px;
            overflow:hidden;
            box-shadow:0 18px 40px rgba(16,26,61,.16);
            z-index:10050;
        }

        .select2-search--dropdown{ padding:10px; }

        .select2-search--dropdown .select2-search__field{
            margin:0;
            border:1px solid #ddd !important;
            border-radius:10px;
            padding:10px;
        }

        .select2-results__option{ padding:10px 12px; }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable{
            background:var(--navy);
        }

        @media(max-width:980px){
            .layout{ flex-direction:column; }
            .sidebar{ width:100%; position:static; height:auto; }
            .menu{ grid-template-columns:repeat(2,1fr); display:grid; }
            .stats,.grid-2,.grid-3,.money-grid{ grid-template-columns:1fr; }
            .money-header{ flex-direction:column; align-items:flex-start; }
            .ticket{ min-width:0; width:100%; font-size:50px; }
            .draw-box{ min-height:auto; padding:34px 20px; }
            .inline-form{ grid-template-columns:1fr; }
        }
        .dashboard-clean-hero{
    background:
        radial-gradient(circle at right, rgba(244,197,66,.22), transparent 28%),
        linear-gradient(135deg,#101a3d,#1f2d66);
    color:white;
    border-radius:30px;
    padding:30px;
    margin-bottom:18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    box-shadow:0 24px 60px rgba(16,26,61,.20);
}

.dashboard-badge{
    display:inline-block;
    background:rgba(244,197,66,.16);
    color:#f4c542;
    border:1px solid rgba(244,197,66,.35);
    padding:8px 12px;
    border-radius:999px;
    font-size:13px;
    font-weight:900;
    margin-bottom:14px;
}

.dashboard-clean-hero h1{
    margin:0;
    font-size:34px;
}

.dashboard-clean-hero p{
    margin:8px 0 0;
    color:#dbe3ff;
}

.dashboard-amount{
    background:rgba(255,255,255,.10);
    border:1px solid rgba(255,255,255,.16);
    border-radius:24px;
    padding:20px;
    min-width:280px;
}

.dashboard-amount span{
    display:block;
    color:#dbe3ff;
    font-size:13px;
    font-weight:800;
    margin-bottom:8px;
}

.dashboard-amount strong{
    color:#f4c542;
    font-size:28px;
}

.dashboard-summary-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:16px;
    margin-bottom:18px;
}

.summary-card{
    background:white;
    border-radius:24px;
    padding:22px;
    box-shadow:0 14px 35px rgba(16,26,61,.08);
    border:1px solid #eef2ff;
}

.summary-icon{
    width:46px;
    height:46px;
    border-radius:16px;
    background:#eef2ff;
    display:grid;
    place-items:center;
    font-size:24px;
    margin-bottom:16px;
}

.summary-card span{
    display:block;
    color:#6b7280;
    font-weight:800;
    font-size:13px;
}

.summary-card strong{
    display:block;
    color:#101a3d;
    margin-top:8px;
    font-size:34px;
}

.summary-card.success .summary-icon{
    background:#dcfce7;
}

.summary-card.warning .summary-icon{
    background:#fef3c7;
}

.summary-card.purple .summary-icon{
    background:#ede9fe;
}

.dashboard-money-card{
    background:white;
    border-radius:28px;
    padding:26px;
    box-shadow:0 16px 40px rgba(16,26,61,.09);
    border:1px solid #eef2ff;
}

.money-main{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:18px;
    margin-bottom:18px;
}

.money-main h2{
    margin:0;
    color:#101a3d;
}

.money-main p{
    margin:6px 0 0;
    color:#6b7280;
}

.money-percent{
    background:#101a3d;
    color:#f4c542;
    font-size:28px;
    font-weight:900;
    padding:14px 20px;
    border-radius:20px;
}

.progress-track.clean{
    height:18px;
    background:#e5e7eb;
    border-radius:999px;
    overflow:hidden;
    margin-bottom:20px;
}

.money-detail-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
}

.money-detail-grid div{
    background:#f8fafc;
    border-radius:18px;
    padding:16px;
    border:1px solid #eef2ff;
}

.money-detail-grid span{
    display:block;
    color:#6b7280;
    font-size:13px;
    font-weight:800;
    margin-bottom:8px;
}

.money-detail-grid strong{
    color:#101a3d;
    font-size:18px;
}

@media(max-width:980px){
    .dashboard-clean-hero{
        flex-direction:column;
        align-items:flex-start;
    }

    .dashboard-amount{
        width:100%;
        min-width:0;
    }

    .dashboard-summary-grid,
    .money-detail-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:600px){
    .dashboard-summary-grid,
    .money-detail-grid{
        grid-template-columns:1fr;
    }

    .money-main{
        flex-direction:column;
        align-items:flex-start;
    }

    .money-percent{
        width:100%;
        text-align:center;
    }
}
    </style>
</head>
<body>


<div class="layout">
    <aside class="sidebar">
        <h2>Door Prize Gotilon</h2>

        <div class="menu">
            <button onclick="showPage('dashboard')">🏠 Dashboard</button>
            <button onclick="showPage('coupons')">🎟 Data Kupon</button>
            <button onclick="showPage('sell')">🛒 Input Pembelian</button>
            <button onclick="showPage('sold')">✅ Kupon Terjual</button>
            <button onclick="showPage('draw')">🎉 Pengundian</button>
            <button onclick="showPage('winners')">🏆 Pemenang</button>
            <button onclick="showPage('pics')">⚙️ Master PIC</button>
        </div>

       <div class="logout-wrap">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">🚪 Logout</button>
    </form>
</div>
    </aside>

    <main class="main">
        @if(session('success'))
            <div class="toast-message toast-success" id="toastMessage">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="toast-message toast-error" id="toastMessage">
                ❌ {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="card alert-error">
                <b>Validasi gagal:</b>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

      <section id="dashboard" class="page active">
    <div class="dashboard-clean-hero">
        <div>
            <span class="dashboard-badge">🎟 Gotilon Dashboard</span>
            <h1>Dashboard Kupon Gotilon</h1>
            <p>Ringkasan penjualan kupon, pembayaran, dan pemenang.</p>
        </div>

        <div class="dashboard-amount">
            <span>Uang Masuk</span>
            <strong>Rp {{ number_format($paidAmountTotal, 0, ',', '.') }}</strong>
        </div>
    </div>

    <div class="dashboard-summary-grid">
        <div class="summary-card">
            <div class="summary-icon">🎟</div>
            <span>Total Kupon</span>
            <strong>{{ $coupons->count() }}</strong>
        </div>

        <div class="summary-card success">
            <div class="summary-icon">✅</div>
            <span>Kupon Lunas</span>
            <strong>{{ $coupons->where('payment_status','PAID')->count() }}</strong>
        </div>

        <div class="summary-card warning">
            <div class="summary-icon">⏳</div>
            <span>Belum Lunas</span>
            <strong>{{ $coupons->whereIn('payment_status',['UNPAID','PARTIAL'])->count() }}</strong>
        </div>

        <div class="summary-card purple">
            <div class="summary-icon">🏆</div>
            <span>Pemenang</span>
            <strong>{{ $winners->count() }}</strong>
        </div>
    </div>

    <div class="dashboard-money-card">
        <div class="money-main">
            <div>
                <h2>Progress Dana Masuk</h2>
                <p>Target dana dari seluruh kupon penjualan.</p>
            </div>

            <div class="money-percent">
                {{ $moneyProgress }}%
            </div>
        </div>

        <div class="progress-track clean">
            <div class="progress-fill" style="width: {{ $moneyProgress }}%"></div>
        </div>

        <div class="money-detail-grid">
            <div>
                <span>Target Dana</span>
                <strong>Rp {{ number_format($targetAmount, 0, ',', '.') }}</strong>
            </div>

            <div>
                <span>Uang Masuk</span>
                <strong>Rp {{ number_format($paidAmountTotal, 0, ',', '.') }}</strong>
            </div>

            <div>
                <span>Sisa Target</span>
                <strong>Rp {{ number_format($remainingAmount, 0, ',', '.') }}</strong>
            </div>

            <div>
                <span>Harga Kupon</span>
                <strong>Rp 100.000</strong>
            </div>
        </div>
    </div>
</section>

        <section id="coupons" class="page">
            <div class="grid-2">
                <div class="card">
                    <h2>Generate Kupon</h2>

                    <p style="color:#6b7280">
                        Kupon penjualan akan dibuat mulai nomor <b>0001</b> sampai <b>1500</b>.
                    </p>

                    <form method="POST" action="{{ route('coupons.generate') }}">
                        @csrf

                        @if($hasSaleCoupons)
                            <button
                                class="secondary"
                                style="width:100%;cursor:not-allowed;opacity:.65"
                                disabled
                            >
                                ✅ 1500 Kupon Sudah Digenerate
                            </button>

                            <small style="display:block;margin-top:10px;color:#6b7280">
                                Kupon penjualan sudah tersedia. Hapus data terlebih dahulu jika ingin generate ulang.
                            </small>
                        @else
                            <button class="primary" style="width:100%">
                                🎟 Generate 1500 Kupon Penjualan
                            </button>
                        @endif
                    </form>

                    <hr style="margin:25px 0">

                    <h3>Generate Reward PIC</h3>

                    <p style="color:#6b7280">
                        Sistem akan otomatis membuat kupon reward untuk PIC yang telah menjual
                        setiap <b>35 kupon lunas</b>.
                    </p>

                    <form method="POST" action="{{ route('coupons.generateReward') }}">
                        @csrf

                        <button class="secondary" style="width:100%">
                            🎁 Generate Kupon Reward
                        </button>
                    </form>
                </div>

                {{-- <div class="card">
                    <h2>Tambah Kupon Manual</h2>

                    <p style="color:#6b7280">
                        Digunakan jika ada kupon tambahan di luar proses generate.
                    </p>

                    <form method="POST" action="{{ route('coupons.store') }}">
                        @csrf

                        <label>Nomor Kupon</label>
                        <input
                            name="coupon_number"
                            placeholder="Contoh : 1501"
                            required
                        >

                        <button class="primary">
                            Tambah Kupon
                        </button>
                    </form>
                </div> --}}
            </div>

            <div class="card">
                <h2>Update PIC Panitia Berdasarkan Nomor Kupon</h2>
                <p style="color:#6b7280">
                    Contoh input: <b>1-10</b>, <b>1,5,6</b>, atau <b>1-10,15,20,25-30</b>.
                </p>

                <form method="POST" action="{{ route('coupons.updatePicRange') }}">
                    @csrf

                    <label>Nomor Kupon</label>
                    <input
                        name="coupon_numbers"
                        placeholder="Contoh: 1-10 atau 1,5,6 atau 1-10,15,20"
                        required
                    >

                    <label>PIC Panitia</label>
                    <select name="owner_name" class="searchable-select" data-placeholder="Cari PIC Panitia..." required>
                        <option value=""></option>
                        @foreach($activePics as $pic)
                            <option value="{{ $pic->name }}">{{ $pic->name }}</option>
                        @endforeach
                    </select>

                    <button class="primary">Update PIC Kupon</button>
                </form>
            </div>

            <div class="card">
                <h2>Data Kupon</h2>

                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>No Kupon</th>
                            <th>Jenis</th>
                            <th>PIC Panitia</th>
                            <th>Pembeli</th>
                            <th>Bayar</th>
                            <th>Status</th>
                            <th>Admin</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($coupons as $coupon)
                            <tr>
                                <td><b>{{ $coupon->coupon_number }}</b></td>
                                <td>
                                    <span class="badge {{ $coupon->coupon_type ?? 'SALE' }}">
                                        {{ $coupon->coupon_type ?? 'SALE' }}
                                    </span>
                                </td>
                                <td>{{ $coupon->owner_name ?? 'Belum Ada PIC' }}</td>
                                <td>{{ $coupon->buyer_name ?? '-' }}</td>
                                <td>Rp {{ number_format($coupon->paid_amount,0,',','.') }} / {{ $coupon->payment_percent }}%</td>
                                <td>
                                    <span class="badge {{ $coupon->payment_status }}">
                                        {{ $coupon->payment_status }}
                                    </span>
                                </td>
                                <td>{{ $coupon->input_by ?? '-' }}</td>
                                <td>
                                    <button
                                        type="button"
                                        class="secondary"
                                        onclick="openEditModal(
                                            '{{ $coupon->id }}',
                                            '{{ e($coupon->coupon_number) }}',
                                            '{{ e($coupon->owner_name) }}',
                                            '{{ e($coupon->buyer_name) }}',
                                            '{{ e($coupon->buyer_phone) }}',
                                            '{{ $coupon->paid_amount }}',
                                            '{{ e($coupon->input_by) }}',
                                            '{{ e($coupon->note) }}'
                                        )">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        @if($coupons->count() === 0)
                            <tr>
                                <td colspan="8" style="text-align:center;color:#6b7280;padding:28px">
                                    Belum ada data kupon.
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section id="sell" class="page">
            <div class="card">
                <h2>Input Pembelian Kupon</h2>

                <form method="POST" action="{{ route('sales.store') }}">
                    @csrf

                    <label>Pilih Kupon</label>
                    <select name="coupon_id" class="searchable-select" data-placeholder="Cari nomor kupon atau PIC..." required>
                        <option value=""></option>
                        @foreach($availableCoupons as $coupon)
                            <option value="{{ $coupon->id }}">
                                {{ $coupon->coupon_number }} - {{ $coupon->owner_name ?? 'Belum Ada PIC' }}
                            </option>
                        @endforeach
                    </select>

                    <label>Nama Pembeli</label>
                    <input name="buyer_name" placeholder="Nama Pembeli" required>

                    <label>No HP Pembeli</label>
                    <input name="buyer_phone" placeholder="No HP Pembeli" required>

                    <label>Jumlah Bayar</label>
                    <input type="number" name="paid_amount" placeholder="0 - 100000" min="0" max="100000" required>

                    <label>Admin Input</label>

                        <input
                            type="text"
                            value="{{ auth()->user()->name }}"
                            readonly
                        >

                        <input
                            type="hidden"
                            name="input_by"
                            value="{{ auth()->user()->name }}"
>

                    <label>Catatan</label>
                    <input name="note" placeholder="Catatan">

                    <button class="primary">Simpan Pembelian</button>
                </form>
            </div>
        </section>

        <section id="sold" class="page">
            <div class="card">
                <h2>Kupon Terjual</h2>

                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>No Kupon</th>
                            <th>Jenis</th>
                            <th>PIC Panitia</th>
                            <th>Pembeli</th>
                            <th>No HP</th>
                            <th>Bayar</th>
                            <th>Status</th>
                            <th>Admin</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($soldCoupons as $coupon)
                            <tr>
                                <td><b>{{ $coupon->coupon_number }}</b></td>
                                <td>
                                    <span class="badge {{ $coupon->coupon_type ?? 'SALE' }}">
                                        {{ $coupon->coupon_type ?? 'SALE' }}
                                    </span>
                                </td>
                                <td>{{ $coupon->owner_name ?? 'Belum Ada PIC' }}</td>
                                <td>{{ $coupon->buyer_name }}</td>
                                <td>{{ $coupon->buyer_phone }}</td>
                                <td>Rp {{ number_format($coupon->paid_amount,0,',','.') }} / {{ $coupon->payment_percent }}%</td>
                                <td>
                                    <span class="badge {{ $coupon->payment_status }}">
                                        {{ $coupon->payment_status }}
                                    </span>
                                </td>
                                <td>{{ $coupon->input_by }}</td>
                            </tr>
                        @endforeach

                        @if($soldCoupons->count() === 0)
                            <tr>
                                <td colspan="8" style="text-align:center;color:#6b7280;padding:28px">
                                    Belum ada kupon terjual.
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

       <section id="draw" class="page">
    <div class="draw-box">
        <h1>Live Drawing</h1>
        <div class="ticket" id="ticketDisplay">----</div>
        <div id="winnerInfo">Klik mulai untuk mengundi dari kupon yang sudah lunas.</div>

        <form method="POST" action="{{ route('draw.store') }}" id="drawForm">
            @csrf
            <input name="prize_name" placeholder="Nama Hadiah" style="max-width:400px;text-align:center">
            <br>
            <button type="button" class="primary" id="drawButton" onclick="spinDraw()">🎰 Mulai Undian</button>
        </form>
    </div>
</section>

        <section id="winners" class="page">
            <div class="card">
                <h2>Riwayat Pemenang</h2>

                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>Hadiah</th>
                            <th>No Kupon</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>PIC Panitia</th>
                            <th>Waktu</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($winners as $winner)
                            <tr>
                                <td>{{ $winner->prize_name }}</td>
                                <td><b>{{ $winner->coupon->coupon_number }}</b></td>
                                <td>{{ $winner->coupon->buyer_name }}</td>
                                <td>{{ $winner->coupon->buyer_phone }}</td>
                                <td>{{ $winner->coupon->owner_name ?? 'Belum Ada PIC' }}</td>
                                <td>{{ $winner->drawn_at }}</td>
                            </tr>
                        @endforeach

                        @if($winners->count() === 0)
                            <tr>
                                <td colspan="6" style="text-align:center;color:#6b7280;padding:28px">
                                    Belum ada pemenang.
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section id="pics" class="page">
            <div class="card pic-form-card">
                <h2>Master PIC Panitia</h2>
                <p>Kelola daftar PIC agar admin tidak perlu mengetik nama PIC manual saat input kupon.</p>

                <form method="POST" action="{{ route('pics.store') }}">
                    @csrf

                    <div class="grid-3">
                        <div>
                            <label>Nama PIC</label>
                            <input name="name" placeholder="Contoh: Samuel" required>
                        </div>

                        <div>
                            <label>No HP</label>
                            <input name="phone" placeholder="Opsional">
                        </div>

                        <div style="display:flex;align-items:end">
                            <button class="primary" style="width:100%">Tambah PIC</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card">
                <h2>Daftar PIC Panitia</h2>

                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>Nama PIC</th>
                            <th>No HP</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pics as $pic)
                            <tr>
                                <td><b>{{ $pic->name }}</b></td>
                                <td>{{ $pic->phone ?? '-' }}</td>
                                <td>
                                    @if($pic->is_active)
                                        <span class="badge pic-status-active">Aktif</span>
                                    @else
                                        <span class="badge pic-status-inactive">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-row">
                                        <form method="POST" action="{{ route('pics.update', $pic) }}" class="inline-form">
                                            @csrf
                                            <input name="name" value="{{ $pic->name }}" required>
                                            <input name="phone" value="{{ $pic->phone }}">
                                            <button class="secondary">Update</button>
                                        </form>

                                        <form method="POST" action="{{ route('pics.toggle', $pic) }}">
                                            @csrf
                                            <button class="{{ $pic->is_active ? 'danger' : 'primary' }}">
                                                {{ $pic->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if($pics->count() === 0)
                            <tr>
                                <td colspan="4" style="text-align:center;color:#6b7280;padding:28px">
                                    Belum ada data PIC.
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</div>

<div class="modal-overlay" id="editModal">
    <div class="modal-card">
        <div class="modal-header">
            <h2>Edit Kupon</h2>
            <button type="button" class="close-btn" onclick="closeEditModal()">×</button>
        </div>

        <form method="POST" id="editCouponForm">
            @csrf

            <label>No Kupon</label>
            <input name="coupon_number" id="edit_coupon_number" required>

            <label>PIC Panitia</label>
            <select name="owner_name" id="edit_owner_name" class="searchable-select modal-searchable-select" data-placeholder="Cari PIC Panitia...">
                <option value=""></option>
                @foreach($activePics as $pic)
                    <option value="{{ $pic->name }}">{{ $pic->name }}</option>
                @endforeach
            </select>

            <label>Nama Pembeli</label>
            <input name="buyer_name" id="edit_buyer_name">

            <label>No HP Pembeli</label>
            <input name="buyer_phone" id="edit_buyer_phone">

            <label>Jumlah Bayar</label>
            <input type="number" name="paid_amount" id="edit_paid_amount" min="0" max="100000" required>

            <label>Admin Input</label>
            <input type="text"
                value="{{ auth()->user()->name }}"readonly>
            <input type="hidden"
                name="input_by" value="{{ auth()->user()->name }}">
            </select>

            <label>Catatan</label>
            <input name="note" id="edit_note">

            <button class="primary">Simpan Perubahan</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    const paidCoupons = @json($coupons->where('payment_status', 'PAID')->values());

    document.addEventListener('DOMContentLoaded', function () {
        const toast = document.getElementById('toastMessage');

        if (toast) {
            setTimeout(() => {
                toast.classList.add('toast-hide');
                setTimeout(() => toast.remove(), 400);
            }, 3000);
        }

        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function () {
                const button = form.querySelector('button[type="submit"], button:not([type])');

                if (button && !button.disabled) {
                    button.disabled = true;
                    button.dataset.originalText = button.innerHTML;
                    button.innerHTML = '⏳ Memproses...';
                }
            });
        });
    });

    $(document).ready(function(){
        $('.searchable-select').each(function(){
            const $select = $(this);
            const options = {
                width: '100%',
                placeholder: $select.data('placeholder') || 'Cari data...',
                allowClear: true
            };

            if ($select.hasClass('modal-searchable-select')) {
                options.dropdownParent = $('#editModal');
            }

            $select.select2(options);
        });
    });

    function showPage(id){
        document.querySelectorAll('.page').forEach(page => page.classList.remove('active'));
        document.getElementById(id).classList.add('active');
    }

    function openEditModal(id, couponNumber, ownerName, buyerName, buyerPhone, paidAmount, inputBy, note){
        document.getElementById('editCouponForm').action = `/coupons/${id}/update`;
        document.getElementById('edit_coupon_number').value = couponNumber || '';
        $('#edit_owner_name').val(ownerName || '').trigger('change');
        document.getElementById('edit_buyer_name').value = buyerName || '';
        document.getElementById('edit_buyer_phone').value = buyerPhone || '';
        document.getElementById('edit_paid_amount').value = paidAmount || 0;
        $('#edit_input_by').val(inputBy || '').trigger('change');
        document.getElementById('edit_note').value = note || '';
        document.getElementById('editModal').classList.add('active');
    }

    function closeEditModal(){
        document.getElementById('editModal').classList.remove('active');
    }

    document.getElementById('editModal').addEventListener('click', function(event){
        if(event.target === this){
            closeEditModal();
        }
    });

    document.addEventListener('keydown', function(event){
        if(event.key === 'Escape'){
            closeEditModal();
        }
    });

    function playStartSound(){
    const audio = new Audio('https://actions.google.com/sounds/v1/cartoon/wood_plank_flicks.ogg');
    audio.volume = 0.5;
    audio.play().catch(() => {});
}

function playWinnerSound(){
    const audio = new Audio('https://actions.google.com/sounds/v1/cartoon/clang_and_wobble.ogg');
    audio.volume = 0.7;
    audio.play().catch(() => {});
}

function createConfetti(){
    for(let i = 0; i < 120; i++){
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        confetti.style.left = Math.random() * 100 + 'vw';
        confetti.style.background = ['#f4c542','#16a34a','#dc2626','#2563eb','#9333ea'][Math.floor(Math.random() * 5)];
        confetti.style.animationDelay = Math.random() * 0.8 + 's';
        document.body.appendChild(confetti);

        setTimeout(() => confetti.remove(), 3500);
    }
}

function spinDraw(){
    const drawForm = document.getElementById('drawForm');
    const drawButton = document.getElementById('drawButton');
    const ticket = document.getElementById('ticketDisplay');
    const info = document.getElementById('winnerInfo');

    if(paidCoupons.length === 0){
        alert('Belum ada kupon lunas untuk diundi.');
        return;
    }

    drawButton.disabled = true;
    drawButton.innerHTML = '⏳ Mengundi...';
    ticket.classList.add('spin');
    info.innerHTML = 'Sedang memilih pemenang...';

    playStartSound();

    fetch(drawForm.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: new FormData(drawForm)
    })
    .then(async response => {
        const data = await response.json();

        if(!response.ok){
            throw new Error(data.message || 'Gagal melakukan pengundian.');
        }

        const winner = data.winner;

        let interval = setInterval(() => {
            const random = paidCoupons[Math.floor(Math.random() * paidCoupons.length)];
            ticket.innerText = random.coupon_number;
            info.innerHTML = `<b>${random.buyer_name}</b><br>No HP: ${random.buyer_phone}<br>PIC Panitia: ${random.owner_name || 'Belum Ada PIC'}`;
        }, 70);

        setTimeout(() => {
            clearInterval(interval);

            ticket.classList.remove('spin');
            ticket.innerText = winner.coupon_number;

            info.innerHTML = `
                <div style="font-size:24px;font-weight:900;margin-top:10px">🏆 ${winner.prize_name}</div>
                <div style="font-size:34px;font-weight:900;margin-top:12px">${winner.buyer_name}</div>
                <div style="font-size:18px;margin-top:8px">No HP: ${winner.buyer_phone}</div>
                <div style="font-size:18px;margin-top:4px">PIC Panitia: ${winner.owner_name}</div>
            `;

            playWinnerSound();
            createConfetti();

            drawButton.disabled = false;
            drawButton.innerHTML = '🎰 Mulai Undian Lagi';
        }, 3800);
    })
    .catch(error => {
        ticket.classList.remove('spin');
        info.innerHTML = error.message;
        drawButton.disabled = false;
        drawButton.innerHTML = '🎰 Mulai Undian';
        alert(error.message);
    });
}
function showPage(id){
    document.querySelectorAll('.page').forEach(page => page.classList.remove('active'));
    document.getElementById(id).classList.add('active');
}

document.addEventListener('DOMContentLoaded', function () {
    showPage(activePageFromSession);
});
</script>

</body>
</html>
