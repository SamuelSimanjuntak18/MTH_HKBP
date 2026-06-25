<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pemenang - Door Prize Gotilon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        :root{
            --navy:#101a3d;
            --navy-2:#1f2d66;
            --gold:#f4c542;
            --gold-soft:#fff4bf;
            --text:#101a3d;
            --muted:#6b7280;
            --border:#e8edf7;
        }

        *{ box-sizing:border-box; }

        body{
            margin:0;
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(244,197,66,.35), transparent 30%),
                radial-gradient(circle at bottom right, rgba(16,26,61,.12), transparent 32%),
                linear-gradient(135deg,#eef3ff,#f8fafc);
            min-height:100vh;
            color:var(--text);
        }

        .container{
            max-width:1220px;
            margin:auto;
            padding:34px 18px 44px;
        }

        .hero{
            background:
                radial-gradient(circle at 78% 24%, rgba(244,197,66,.28), transparent 28%),
                radial-gradient(circle at left bottom, rgba(255,255,255,.10), transparent 28%),
                linear-gradient(135deg,var(--navy),var(--navy-2));
            color:white;
            border-radius:34px;
            padding:34px;
            box-shadow:0 28px 80px rgba(16,26,61,.24);
            margin-bottom:24px;
            display:grid;
            grid-template-columns:1fr .95fr;
            align-items:center;
            gap:28px;
            overflow:hidden;
            position:relative;
        }

        .hero::before{
            content:"";
            position:absolute;
            inset:0;
            background-image:
                radial-gradient(circle, rgba(244,197,66,.28) 1px, transparent 1px);
            background-size:26px 26px;
            opacity:.18;
            mask-image:linear-gradient(90deg,#000,transparent 72%);
        }

        .hero::after{
            content:"";
            position:absolute;
            width:230px;
            height:230px;
            border-radius:50%;
            background:rgba(244,197,66,.12);
            left:-90px;
            bottom:-100px;
        }

        .hero-content{
            position:relative;
            z-index:2;
        }

        .hero-badge{
            display:inline-flex;
            align-items:center;
            gap:8px;
            background:rgba(244,197,66,.16);
            border:1px solid rgba(244,197,66,.38);
            color:var(--gold);
            border-radius:999px;
            padding:10px 14px;
            font-size:13px;
            font-weight:900;
            margin-bottom:18px;
        }

        .hero .icon{
            font-size:64px;
            margin-bottom:10px;
            filter:drop-shadow(0 12px 22px rgba(0,0,0,.28));
        }

        .hero h1{
            margin:0;
            font-size:46px;
            line-height:1.12;
            letter-spacing:-.03em;
        }

        .hero h1 span{
            color:var(--gold);
        }

        .hero p{
            color:#dbe3ff;
            font-size:17px;
            line-height:1.7;
            margin:18px 0 24px;
            max-width:540px;
        }

        .hero-actions{
            display:flex;
            gap:12px;
            align-items:center;
            max-width:640px;
        }

        .search{
            flex:1;
            padding:15px 17px;
            border-radius:16px;
            border:1px solid #dbe1ef;
            font-size:15px;
            outline:none;
            box-shadow:0 10px 24px rgba(0,0,0,.08);
        }

        .search:focus{
            border-color:var(--gold);
            box-shadow:0 0 0 4px rgba(244,197,66,.20);
        }

        .login-btn{
            background:linear-gradient(135deg,var(--gold),#ffb21c);
            color:var(--navy);
            text-decoration:none;
            font-weight:900;
            padding:15px 18px;
            border-radius:16px;
            white-space:nowrap;
            box-shadow:0 12px 28px rgba(244,197,66,.25);
        }

        .hero-image-wrap{
            position:relative;
            z-index:2;
            border-radius:30px;
            padding:12px;
            background:rgba(255,255,255,.08);
            border:1px solid rgba(255,255,255,.16);
            box-shadow:0 26px 70px rgba(0,0,0,.30);
        }

        .hero-image{
            width:100%;
            display:block;
            border-radius:24px;
            animation:floatPrize 4s ease-in-out infinite;
        }

        @keyframes floatPrize{
            0%,100%{ transform:translateY(0); }
            50%{ transform:translateY(-8px); }
        }

        .section-title{
            display:flex;
            justify-content:space-between;
            align-items:end;
            gap:14px;
            margin:22px 4px 16px;
        }

        .section-title h2{
            margin:0;
            font-size:26px;
            color:var(--navy);
        }

        .section-title p{
            margin:6px 0 0;
            color:var(--muted);
        }

        .winner-count{
            background:#fff;
            border:1px solid var(--border);
            border-radius:999px;
            padding:10px 14px;
            font-weight:900;
            color:var(--navy);
            box-shadow:0 10px 24px rgba(16,26,61,.08);
            white-space:nowrap;
        }

        .winner-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:18px;
        }

        .winner-card{
            background:rgba(255,255,255,.94);
            border-radius:26px;
            padding:22px;
            box-shadow:0 16px 40px rgba(16,26,61,.10);
            border:1px solid #eef2ff;
            position:relative;
            overflow:hidden;
            transition:.2s ease;
        }

        .winner-card:hover{
            transform:translateY(-4px);
            box-shadow:0 24px 54px rgba(16,26,61,.15);
        }

        .winner-card::after{
            content:"";
            position:absolute;
            width:120px;
            height:120px;
            border-radius:50%;
            background:rgba(244,197,66,.16);
            right:-40px;
            top:-40px;
        }

        .winner-card::before{
            content:"🏆";
            position:absolute;
            right:18px;
            top:18px;
            font-size:24px;
            z-index:2;
            opacity:.9;
        }

        .prize{
            color:var(--muted);
            font-weight:900;
            font-size:13px;
            text-transform:uppercase;
            letter-spacing:.08em;
            position:relative;
            z-index:2;
            padding-right:42px;
        }

        .coupon{
            font-size:44px;
            font-weight:900;
            color:var(--navy);
            margin:12px 0;
            position:relative;
            z-index:2;
        }

        .name{
            font-size:21px;
            font-weight:900;
            margin-bottom:8px;
            position:relative;
            z-index:2;
        }

        .meta{
            color:var(--muted);
            font-size:14px;
            line-height:1.6;
            position:relative;
            z-index:2;
        }

        .empty{
            background:white;
            border-radius:28px;
            padding:48px 28px;
            text-align:center;
            color:var(--muted);
            box-shadow:0 16px 40px rgba(16,26,61,.08);
            border:1px solid #eef2ff;
        }

        .empty-icon{
            font-size:58px;
            margin-bottom:12px;
        }

        .empty h2{
            margin:0 0 8px;
            color:var(--navy);
        }

        @media(max-width:980px){
            .hero{
                grid-template-columns:1fr;
                text-align:center;
            }

            .hero-content{
                text-align:center;
            }

            .hero p{
                margin-left:auto;
                margin-right:auto;
            }

            .hero-actions{
                margin:auto;
            }

            .winner-grid{
                grid-template-columns:repeat(2,1fr);
            }
        }

        @media(max-width:600px){
            .container{
                padding:22px 14px 34px;
            }

            .hero{
                padding:26px 18px;
                border-radius:28px;
            }

            .hero h1{
                font-size:32px;
            }

            .hero p{
                font-size:15px;
            }

            .hero-actions{
                flex-direction:column;
            }

            .search,.login-btn{
                width:100%;
            }

            .winner-grid{
                grid-template-columns:1fr;
            }

            .section-title{
                flex-direction:column;
                align-items:flex-start;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="hero">
        <div class="hero-content">
            <div class="icon">🏆</div>

            <h1>
                Daftar Pemenang<br>
                <span>Door Prize Gotilon</span>
            </h1>
            <div class="hero-actions">
                <input class="search" id="searchWinner" placeholder="Cari nama, nomor kupon, atau hadiah...">
                <a href="{{ route('login') }}" class="login-btn">Login Admin</a>
            </div>
        </div>

        <div class="hero-image-wrap">
            <img
                src="{{ asset('images/hadiah-utama.png') }}"
                class="hero-image"
                alt="Hadiah Door Prize Gotilon">
        </div>
    </div>

    <div class="section-title">
        <div>
            <h2>Riwayat Pemenang</h2>
            <p>Daftar pemenang akan otomatis bertambah setelah proses pengundian dilakukan.</p>
        </div>

        <div class="winner-count">
            Total Pemenang: {{ $winners->count() }}
        </div>
    </div>

    @if($winners->count() > 0)
        <div class="winner-grid" id="winnerGrid">
            @foreach($winners as $winner)
                <div class="winner-card"
                     data-search="{{ strtolower($winner->prize_name.' '.$winner->coupon->coupon_number.' '.$winner->coupon->buyer_name) }}">
                    <div class="prize">{{ $winner->prize_name }}</div>
                    <div class="coupon">#{{ $winner->coupon->coupon_number }}</div>
                    <div class="name">{{ $winner->coupon->buyer_name }}</div>
                    <div class="meta">
                        Waktu:
                        {{ \Carbon\Carbon::parse($winner->drawn_at)->addHours(7)->format('d M Y H:i:s') }} WIB
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty">
            <div class="empty-icon">🎁</div>
            <h2>Belum Ada Pemenang</h2>
            <p>Daftar pemenang akan tampil setelah proses pengundian dilakukan.</p>
        </div>
    @endif
</div>

<script>
    const searchInput = document.getElementById('searchWinner');

    if(searchInput){
        searchInput.addEventListener('input', function(){
            const keyword = this.value.toLowerCase();

            document.querySelectorAll('.winner-card').forEach(card => {
                card.style.display = card.dataset.search.includes(keyword) ? 'block' : 'none';
            });
        });
    }
</script>

</body>
</html>
