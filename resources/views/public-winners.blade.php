<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pemenang - Door Prize Gotilon</title>
    <style>
        body{
            margin:0;
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(244,197,66,.35), transparent 30%),
                linear-gradient(135deg,#eef3ff,#f8fafc);
            min-height:100vh;
            color:#101a3d;
        }

        .container{
            max-width:1100px;
            margin:auto;
            padding:36px 18px;
        }

        .hero{
            background:linear-gradient(135deg,#101a3d,#1f2d66);
            color:white;
            border-radius:32px;
            padding:42px;
            text-align:center;
            box-shadow:0 24px 70px rgba(16,26,61,.22);
            margin-bottom:24px;
        }

        .hero .icon{
            font-size:72px;
            margin-bottom:12px;
        }

        .hero h1{
            margin:0;
            font-size:42px;
        }

        .hero p{
            color:#dbe3ff;
            font-size:17px;
        }

        .top-actions{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:18px;
            gap:12px;
        }

        .search{
            flex:1;
            padding:14px 16px;
            border-radius:16px;
            border:1px solid #dbe1ef;
            font-size:15px;
        }

        .login-btn{
            background:#f4c542;
            color:#101a3d;
            text-decoration:none;
            font-weight:bold;
            padding:14px 18px;
            border-radius:16px;
        }

        .winner-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:18px;
        }

        .winner-card{
            background:white;
            border-radius:26px;
            padding:22px;
            box-shadow:0 14px 35px rgba(16,26,61,.10);
            border:1px solid #eef2ff;
            position:relative;
            overflow:hidden;
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

        .prize{
            color:#6b7280;
            font-weight:bold;
            font-size:13px;
            text-transform:uppercase;
            letter-spacing:.08em;
        }

        .coupon{
            font-size:42px;
            font-weight:900;
            color:#101a3d;
            margin:12px 0;
        }

        .name{
            font-size:20px;
            font-weight:bold;
            margin-bottom:8px;
        }

        .meta{
            color:#6b7280;
            font-size:14px;
            line-height:1.6;
        }

        .empty{
            background:white;
            border-radius:26px;
            padding:42px;
            text-align:center;
            color:#6b7280;
            box-shadow:0 14px 35px rgba(16,26,61,.08);
        }

        @media(max-width:900px){
            .winner-grid{ grid-template-columns:repeat(2,1fr); }
        }

        @media(max-width:600px){
            .hero h1{ font-size:30px; }
            .winner-grid{ grid-template-columns:1fr; }
            .top-actions{ flex-direction:column; }
            .search,.login-btn{ width:100%; box-sizing:border-box; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="hero">
        <div class="icon">🏆</div>
        <h1>Daftar Pemenang Door Prize Gotilon</h1>
    </div>

    <div class="top-actions">
        <input class="search" id="searchWinner" placeholder="Cari nama, nomor kupon, atau hadiah...">
        <a href="{{ route('login') }}" class="login-btn">Login Admin</a>
    </div>

    @if($winners->count() > 0)
        <div class="winner-grid" id="winnerGrid">
            @foreach($winners as $winner)
                <div class="winner-card"
                     data-search="{{ strtolower($winner->prize_name.' '.$winner->coupon->coupon_number.' '.$winner->coupon->buyer_name) }}">
                    <div class="prize">{{ $winner->prize_name }}</div>
                    <div class="coupon">#{{ $winner->coupon->coupon_number }}</div>
                    <div class="name">{{ $winner->coupon->buyer_name }}</div>
                    <div class="meta"> Waktu:{{ \Carbon\Carbon::parse($winner->drawn_at)->addHours(7)->format('d M Y H:i:s') }} WIB
            </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty">
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
