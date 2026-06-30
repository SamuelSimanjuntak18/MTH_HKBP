<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Door Prize Gotilon</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        .badge-available {
            background: #f3f4f6;
            color: #374151;
        }

        .badge-unpaid {
            background: #fee2e2;
            color: #b91c1c;
        }

        .badge-partial {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-paid {
            background: #dcfce7;
            color: #166534;
        }

        .badge-winner {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-cancelled {
            background: #e5e7eb;
            color: #4b5563;
        }

        .hero-right {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 18px;
        }

        .price-tag {
            background: linear-gradient(135deg, #FFD54F, #F4C542);
            color: #101a3d;
            border-radius: 18px;
            padding: 18px 28px;
            text-align: center;
            box-shadow: 0 18px 40px rgba(0, 0, 0, .18);
            position: relative;
            min-width: 250px;
        }

        .price-tag::before {
            content: "";
            position: absolute;
            top: -18px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 18px;
            background: #9ca3af;
        }

        .price-tag::after {
            content: "";
            position: absolute;
            top: -24px;
            left: 50%;
            transform: translateX(-50%);
            width: 10px;
            height: 10px;
            background: #374151;
            border-radius: 50%;
        }

        .price-label {
            display: block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .12em;
            font-weight: 700;
            opacity: .8;
        }

        .price-tag h3 {
            margin: 8px 0;
            font-size: 36px;
            font-weight: 900;
        }

        .price-tag small {
            font-size: 13px;
            opacity: .9;
        }

        .winner-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .winner-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            padding: 22px;
            border-radius: 22px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, .05);
            transition: .25s;
        }

        .winner-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 45px rgba(0, 0, 0, .08);
        }

        .winner-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #FFD54F, #FFB300);
            font-size: 32px;
            margin-right: 18px;
            flex-shrink: 0;
        }

        .winner-detail {
            flex: 1;
        }

        .winner-prize {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #6b7280;
            margin-bottom: 5px;
        }

        .winner-name {
            font-size: 24px;
            font-weight: 700;
            color: #101a3d;
            margin-bottom: 5px;
        }

        .winner-info {
            font-size: 14px;
            color: #6b7280;
        }

        .winner-time {
            text-align: right;
            font-weight: 700;
            color: #101a3d;
            min-width: 130px;
        }

        .winner-time small {
            color: #6b7280;
            font-weight: 500;
        }

        .table-search {
            width: 320px;
            padding: 14px 18px;
            border-radius: 14px;
            border: 1px solid #dbe2ee;
            font-size: 15px;
            outline: none;
        }

        .table-search:focus {
            border-color: #101a3d;
        }

        .table-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(0, 0, 0, .05);
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
        }

        .modern-table thead {
            background: #101a3d;
            color: white;
        }

        .modern-table th {
            padding: 18px;
            text-align: left;
            font-size: 14px;
        }

        .modern-table td {
            padding: 18px;
            border-bottom: 1px solid #eef2ff;
            vertical-align: middle;
        }

        .modern-table tbody tr {
            transition: .2s;
        }

        .modern-table tbody tr:hover {
            background: #f8fbff;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #101a3d;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .badge {
            padding: 7px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
        }

        .badge-type {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-paid {
            background: #dcfce7;
            color: #166534;
        }

        .badge-partial {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-unpaid {
            background: #fee2e2;
            color: #b91c1c;
        }

        .badge-winner {
            background: #ede9fe;
            color: #6d28d9;
        }

        .progress {
            height: 8px;
            margin: 6px 0;
            background: #eef2ff;
            border-radius: 20px;
            overflow: hidden;
        }

        .progress div {
            height: 100%;
            background: linear-gradient(90deg, #22c55e, #16a34a);
        }

        .empty-table {
            padding: 60px;
            text-align: center;
            color: #6b7280;
        }

        :root {
            --primary: #101a3d;
            --primary2: #1d2d67;
            --gold: #F4C542;
            --success: #22c55e;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
            --border: #e5e7eb;
            --bg: #f5f7fb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--bg);
            color: #111827;
        }

        .container {
            max-width: 1400px;
            margin: auto;
            padding: 35px;
        }

        /***************************** HEADER *****************************/
        .hero {
            background: linear-gradient(135deg, #101a3d, #24387e);
            border-radius: 30px;
            padding: 45px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
            color: white;
            overflow: hidden;
            position: relative;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .18);
        }

        .hero:before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .05);
            right: -120px;
            top: -120px;
        }

        .hero-left {
            max-width: 720px;
            z-index: 2;
        }

        .hero-left h1 {
            font-size: 46px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 12px;
        }

        .hero-left h1 span {
            color: var(--gold);
        }

        .hero-left p {
            font-size: 17px;
            line-height: 1.8;
            opacity: .9;
            margin-bottom: 25px;
        }

        .hero-right {
            z-index: 2;
            text-align: center;
        }

        .hero-right img {
            width: 330px;
            max-width: 100%;
        }

        .login-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #f4c542, #ffbf00);
            padding: 14px 28px;
            font-weight: 700;
            border-radius: 14px;
            color: #101a3d;
            text-decoration: none;
            transition: .25s;
        }

        .login-btn:hover {
            transform: translateY(-3px);
        }

        /***************************** INFO CARD *****************************/
        .info-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 18px;
            margin-top: 35px;
        }

        .info-card {
            background: white;
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
            border: 1px solid #edf0f7;
            transition: .25s;
        }

        .info-card:hover {
            transform: translateY(-4px);
        }

        .info-card small {
            display: block;
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .info-card h2 {
            font-size: 28px;
            color: #101a3d;
        }

        .price-card {
            background: linear-gradient(135deg, #F4C542, #FFD54F);
            color: #101a3d;
        }

        .price-card small {
            color: #4b5563;
        }

        .price-card h2 {
            font-size: 34px;
        }

        /***************************** TAB *****************************/
        .tab-wrapper {
            margin-top: 40px;
            display: flex;
            gap: 12px;
        }

        .tab-btn {
            padding: 15px 30px;
            border: none;
            background: white;
            border-radius: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
            border: 2px solid transparent;
        }

        .tab-btn.active {
            background: #101a3d;
            color: white;
        }

        .tab-content {
            display: none;
            margin-top: 25px;
        }

        .tab-content.active {
            display: block;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-title h2 {
            font-size: 28px;
            color: #101a3d;
        }

        .section-title p {
            color: #6b7280;
            margin-top: 4px;
        }

        @media(max-width:1100px) {
            .info-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero {
                flex-direction: column;
                text-align: center;
            }
        }

        @media(max-width:700px) {
            .container {
                padding: 20px;
            }

            .hero-left h1 {
                font-size: 34px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .tab-wrapper {
                flex-direction: column;
            }
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="hero">

            <div class="hero-left">

                <h1>

                    Door Prize

                    <span>Gotilon</span>

                </h1>

                <p>

                    Selamat datang di Portal Informasi Door Prize Gotilon.

                    Peserta dapat melihat daftar kupon yang telah terjual,

                    memastikan data pembelian telah tercatat oleh panitia,

                    serta melihat daftar pemenang setelah proses pengundian selesai.

                </p>

                <a href="{{ route('login') }}" class="login-btn">

                    🔐 Login Admin

                </a>

            </div>

            <div class="hero-right">

                <div class="hero-image-wrap">
                    <img src="{{ asset('images/hadiah-utama.png') }}" class="hero-image" alt="Hadiah Utama">
                </div>

                <div class="price-tag">

                    <span class="price-label">
                        🎟 Harga Kupon/Lembar
                    </span>

                    <h3>Rp100.000</h3>

                </div>

            </div>

        </div>

        <div class="tab-wrapper">

            <button class="tab-btn active" data-tab="couponTab">

                🎟 Kupon Terjual

            </button>

            <button class="tab-btn" data-tab="winnerTab">

                🏆 Daftar Pemenang

            </button>

        </div>
        <!-- ==========================
TAB : KUPON TERJUAL
========================== -->

        <div id="couponTab" class="tab-content active">

            <div class="section-title">

                <div>
                    <h2>Daftar Kupon Terjual</h2>
                    <p>
                        Gunakan kolom pencarian untuk memastikan data kupon Anda telah tercatat oleh panitia.
                    </p>
                </div>

                <input id="couponSearch" type="text" placeholder="Cari nomor kupon, nama pembeli, PIC..."
                    class="table-search">

            </div>


            <div class="table-card">

                <table class="modern-table" id="couponTable">

                    <thead>
                        <tr>
                            <th>No Kupon</th>
                            <th>Jenis</th>
                            <th>PIC Panitia</th>
                            <th>Pembeli</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($soldCoupons as $coupon)
                            <tr
                                data-search="{{ strtolower(
                                    ($coupon->coupon_number ?? '') .
                                        ' ' .
                                        ($coupon->owner_name ?? '') .
                                        ' ' .
                                        ($coupon->buyer_name ?? '') .
                                        ' ' .
                                        ($coupon->buyer_phone ?? ''),
                                ) }}">

                                <td>

                                    <strong>

                                        #{{ $coupon->coupon_number }}

                                    </strong>

                                </td>


                                <td>

                                    <span class="badge badge-type">

                                        {{ $coupon->coupon_type }}

                                    </span>

                                </td>


                                <td>

                                    <div class="user-info">

                                        <div class="avatar">

                                            {{ strtoupper(substr($coupon->owner_name ?? '?', 0, 1)) }}

                                        </div>

                                        <div>

                                            <strong>

                                                {{ $coupon->owner_name ?? '-' }}

                                            </strong>

                                        </div>

                                    </div>

                                </td>


                                <td>
                                    <strong>{{ $coupon->buyer_name }}</strong>
                                </td>


                                <td>
                                    <strong>{{ $coupon->buyer_name }}</strong>
                                </td>


                                <td>
                                    @php
                                        $statusMap = [
                                            'AVAILABLE' => 'Tersedia',
                                            'UNPAID' => 'Belum Lunas',
                                            'PARTIAL' => 'Dicicil',
                                            'PAID' => 'Lunas',
                                            'WINNER' => 'Menang',
                                            'CANCELLED' => 'Dibatalkan',
                                        ];

                                        $statusClass = [
                                            'AVAILABLE' => 'available',
                                            'UNPAID' => 'unpaid',
                                            'PARTIAL' => 'partial',
                                            'PAID' => 'paid',
                                            'WINNER' => 'winner',
                                            'CANCELLED' => 'cancelled',
                                        ];
                                    @endphp

                                    <span
                                        class="badge badge-{{ $statusClass[$coupon->payment_status] ?? 'available' }}">
                                        {{ $statusMap[$coupon->payment_status] ?? $coupon->payment_status }}
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6">

                                    <div class="empty-table">

                                        <div style="font-size:55px">

                                            🎟

                                        </div>

                                        <h3>

                                            Belum Ada Kupon Terjual

                                        </h3>

                                        <p>

                                            Data kupon akan muncul setelah panitia melakukan input pembelian.

                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
        <!-- ==========================
TAB : DAFTAR PEMENANG
========================== -->

        <div id="winnerTab" class="tab-content">

            <div class="section-title">

                <div>

                    <h2>Daftar Pemenang Door Prize</h2>

                    <p>
                        Seluruh pemenang yang telah diumumkan panitia.
                    </p>

                </div>

                <input id="winnerSearch" class="table-search" type="text"
                    placeholder="Cari hadiah, nama atau nomor kupon...">

            </div>

            @if ($winners->count())

                <div class="winner-list">

                    @foreach ($winners as $winner)
                        <div class="winner-item"
                            data-search="{{ strtolower($winner->prize_name . ' ' . $winner->coupon->coupon_number . ' ' . $winner->coupon->buyer_name) }}">

                            <div class="winner-icon">

                                🏆

                            </div>

                            <div class="winner-detail">

                                <div class="winner-prize">

                                    {{ $winner->prize_name }}

                                </div>

                                <div class="winner-name">

                                    {{ $winner->coupon->buyer_name }}

                                </div>

                                <div class="winner-info">

                                    Kupon
                                    <strong>

                                        #{{ $winner->coupon->coupon_number }}

                                    </strong>

                                    •

                                    PIC

                                    <strong>

                                        {{ $winner->coupon->owner_name }}

                                    </strong>

                                </div>

                            </div>

                            <div class="winner-time">

                                {{ \Carbon\Carbon::parse($winner->drawn_at)->addHours(7)->format('d M Y') }}

                                <br>

                                <small>

                                    {{ \Carbon\Carbon::parse($winner->drawn_at)->addHours(7)->format('H:i') }} WIB

                                </small>

                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                <div class="empty-table">

                    <div style="font-size:60px">

                        🎁

                    </div>

                    <h3>

                        Belum Ada Pemenang

                    </h3>

                    <p>

                        Daftar pemenang akan muncul setelah proses pengundian dilakukan.

                    </p>

                </div>

            @endif

        </div>

        <script>
            // =======================
            // TAB
            // =======================

            document.querySelectorAll(".tab-btn").forEach(btn => {

                btn.onclick = function() {

                    document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));

                    document.querySelectorAll(".tab-content").forEach(c => c.classList.remove("active"));

                    this.classList.add("active");

                    document.getElementById(this.dataset.tab).classList.add("active");

                }

            });


            // =======================
            // SEARCH KUPON
            // =======================

            const couponSearch = document.getElementById("couponSearch");

            couponSearch?.addEventListener("keyup", function() {

                const key = this.value.toLowerCase();

                document.querySelectorAll("#couponTable tbody tr").forEach(row => {

                    if (!row.dataset.search) return;

                    row.style.display = row.dataset.search.includes(key) ? "" : "none";

                });

            });


            // =======================
            // SEARCH PEMENANG
            // =======================

            const winnerSearch = document.getElementById("winnerSearch");

            winnerSearch?.addEventListener("keyup", function() {

                const key = this.value.toLowerCase();

                document.querySelectorAll(".winner-item").forEach(card => {

                    card.style.display = card.dataset.search.includes(key) ? "flex" : "none";

                });

            });
        </script>
