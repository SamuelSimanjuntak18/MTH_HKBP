<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Door Prize Gotilon</title>
    <style>
        body { font-family: Arial, sans-serif; background:#eef3ff; margin:0; }
        .layout { display:flex; min-height:100vh; padding:18px; gap:18px; }
        .sidebar { width:260px; background:#101a3d; color:white; border-radius:24px; padding:22px; position:sticky; top:18px; height:calc(100vh - 36px); }
        .sidebar h2 { margin-top:0; }
        .menu button { display:block; width:100%; margin:8px 0; padding:14px; border:0; border-radius:14px; text-align:left; font-weight:bold; cursor:pointer; }
        .main { flex:1; overflow-x:auto; }
        .card { background:white; border-radius:22px; padding:22px; margin-bottom:18px; box-shadow:0 10px 30px #0001; }
        .stats { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; }
        .stat strong { display:block; font-size:32px; color:#101a3d; }
        input, select { width:100%; padding:12px; border-radius:12px; border:1px solid #ddd; margin:8px 0 14px; box-sizing:border-box; }
        button { padding:12px 16px; border-radius:12px; border:0; font-weight:bold; cursor:pointer; }
        .primary { background:#f4c542; color:#101a3d; }
        .danger { background:#fee2e2; color:#991b1b; }
        .secondary { background:#e5e7eb; color:#101a3d; }
        .table-wrap { overflow:auto; max-height:620px; border-radius:18px; }
        table { width:100%; border-collapse:collapse; min-width:1050px; }
        th, td { padding:12px; border-bottom:1px solid #eee; text-align:left; vertical-align:middle; }
        th { background:#fafbff; color:#666; position:sticky; top:0; z-index:2; }
        .page { display:none; }
        .page.active { display:block; }
        .badge { padding:6px 10px; border-radius:999px; font-size:12px; font-weight:bold; display:inline-block; }
        .AVAILABLE { background:#e5e7eb; color:#374151; }
        .UNPAID { background:#fee2e2; color:#991b1b; }
        .PARTIAL { background:#fef3c7; color:#92400e; }
        .PAID { background:#dcfce7; color:#166534; }
        .WINNER { background:#ede9fe; color:#5b21b6; }
        .CANCELLED { background:#111827; color:white; }
        .draw-box { background:linear-gradient(135deg,#111b42,#2d1b69); color:white; text-align:center; border-radius:28px; padding:42px; }
        .ticket { background:#f4c542; color:#101a3d; font-size:58px; font-weight:900; border-radius:24px; padding:28px; margin:24px auto; max-width:420px; }
        .spin { animation:spin .12s infinite; }
        @keyframes spin { 50% { transform:scale(1.08) rotate(1deg); filter:blur(1px); } }
        .grid-3 { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; }
        .alert-success { border-left:6px solid #16a34a; color:#166534; }
        .alert-error { border-left:6px solid #dc2626; color:#991b1b; }

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
            width:520px;
            max-width:95%;
            max-height:90vh;
            overflow:auto;
            border-radius:24px;
            padding:24px;
            box-shadow:0 30px 80px rgba(0,0,0,.28);
        }
        .modal-header{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:16px;
        }
        .modal-header h2{ margin:0; color:#101a3d; }
        .close-btn{
            background:#fee2e2;
            color:#991b1b;
            width:42px;
            height:42px;
            padding:0;
            font-size:24px;
        }

        @media(max-width:900px){
            .layout { flex-direction:column; }
            .sidebar { width:auto; position:static; height:auto; }
            .stats, .grid-3 { grid-template-columns:1fr; }
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
        </div>
    </aside>

    <main class="main">
        @if(session('success'))
            <div class="card alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="card alert-error">{{ session('error') }}</div>
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
            <div class="card">
                <h1>Dashboard Undian Gereja</h1>
                <p>Kelola kupon, pembayaran, pembeli, PIC Panitia, dan pengundian secara dinamis.</p>
            </div>

            <div class="stats">
                <div class="card stat">Total Kupon <strong>{{ $coupons->count() }}</strong></div>
                <div class="card stat">Lunas <strong>{{ $coupons->where('payment_status','PAID')->count() }}</strong></div>
                <div class="card stat">Belum Lunas <strong>{{ $coupons->whereIn('payment_status',['UNPAID','PARTIAL'])->count() }}</strong></div>
                <div class="card stat">Pemenang <strong>{{ $winners->count() }}</strong></div>
            </div>
        </section>

        <section id="coupons" class="page">
            <div class="card">
                <h2>Tambah / Generate Kupon</h2>

                <form method="POST" action="{{ route('coupons.store') }}">
                    @csrf
                    <input name="coupon_number" placeholder="Nomor Kupon, contoh 0001" required>
                    <input name="owner_name" placeholder="PIC Panitia" required>
                    <button class="primary">Tambah Kupon</button>
                </form>

                <form method="POST" action="{{ route('coupons.generate') }}" style="margin-top:10px">
                    @csrf
                    <button class="primary">Generate 1000 Kupon</button>
                </form>
            </div>

            <div class="card">
                <h2>Update PIC Panitia Berdasarkan Nomor Kupon</h2>
<p>Contoh input: <b>1-10</b>, <b>1,5,6</b>, atau <b>1-10,15,20,25-30</b>.</p>

<form method="POST" action="{{ route('coupons.updatePicRange') }}">
    @csrf

    <label>Nomor Kupon</label>
    <input
        name="coupon_numbers"
        placeholder="Contoh: 1-10 atau 1,5,6 atau 1-10,15,20"
        required
    >

    <label>Nama PIC Panitia</label>
    <input name="owner_name" placeholder="Contoh: Samuel" required>

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
                                <td>{{ $coupon->owner_name }}</td>
                                <td>{{ $coupon->buyer_name ?? '-' }}</td>
                                <td>Rp {{ number_format($coupon->paid_amount,0,',','.') }} / {{ $coupon->payment_percent }}%</td>
                                <td><span class="badge {{ $coupon->payment_status }}">{{ $coupon->payment_status }}</span></td>
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
                    <select name="coupon_id" required>
                        @foreach($availableCoupons as $coupon)
                            <option value="{{ $coupon->id }}">{{ $coupon->coupon_number }} - {{ $coupon->owner_name }}</option>
                        @endforeach
                    </select>

                    <input name="buyer_name" placeholder="Nama Pembeli" required>
                    <input name="buyer_phone" placeholder="No HP Pembeli" required>

                    <label>Jumlah Bayar</label>
                    <input type="number" name="paid_amount" placeholder="0 - 100000" min="0" max="100000" required>

                    <label>Admin Input</label>
                    <select name="input_by" required>
                        <option value="Admin 1">Admin 1</option>
                        <option value="Admin 2">Admin 2</option>
                        <option value="Admin 3">Admin 3</option>
                    </select>

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
                                <td>{{ $coupon->owner_name }}</td>
                                <td>{{ $coupon->buyer_name }}</td>
                                <td>{{ $coupon->buyer_phone }}</td>
                                <td>Rp {{ number_format($coupon->paid_amount,0,',','.') }} / {{ $coupon->payment_percent }}%</td>
                                <td><span class="badge {{ $coupon->payment_status }}">{{ $coupon->payment_status }}</span></td>
                                <td>{{ $coupon->input_by }}</td>
                            </tr>
                        @endforeach
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
                    <button type="button" class="primary" onclick="spinDraw()">Mulai Undian</button>
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
                                <td>{{ $winner->coupon->owner_name }}</td>
                                <td>{{ $winner->drawn_at }}</td>
                            </tr>
                        @endforeach
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
            <input name="owner_name" id="edit_owner_name" required>

            <label>Nama Pembeli</label>
            <input name="buyer_name" id="edit_buyer_name">

            <label>No HP Pembeli</label>
            <input name="buyer_phone" id="edit_buyer_phone">

            <label>Jumlah Bayar</label>
            <input type="number" name="paid_amount" id="edit_paid_amount" min="0" max="100000" required>

            <label>Admin Input</label>
            <select name="input_by" id="edit_input_by">
                <option value="">Pilih Admin</option>
                <option value="Admin 1">Admin 1</option>
                <option value="Admin 2">Admin 2</option>
                <option value="Admin 3">Admin 3</option>
            </select>

            <label>Catatan</label>
            <input name="note" id="edit_note">

            <button class="primary">Simpan Perubahan</button>
        </form>
    </div>
</div>

<script>
    const paidCoupons = @json($coupons->where('payment_status', 'PAID')->values());

    function showPage(id){
        document.querySelectorAll('.page').forEach(page => page.classList.remove('active'));
        document.getElementById(id).classList.add('active');
    }

    function openEditModal(id, couponNumber, ownerName, buyerName, buyerPhone, paidAmount, inputBy, note){
        document.getElementById('editCouponForm').action = `/coupons/${id}/update`;
        document.getElementById('edit_coupon_number').value = couponNumber || '';
        document.getElementById('edit_owner_name').value = ownerName || '';
        document.getElementById('edit_buyer_name').value = buyerName || '';
        document.getElementById('edit_buyer_phone').value = buyerPhone || '';
        document.getElementById('edit_paid_amount').value = paidAmount || 0;
        document.getElementById('edit_input_by').value = inputBy || '';
        document.getElementById('edit_note').value = note || '';
        document.getElementById('editModal').classList.add('active');
    }

    function closeEditModal(){
        document.getElementById('editModal').classList.remove('active');
    }

    function spinDraw(){
        if(paidCoupons.length === 0){
            alert('Belum ada kupon lunas untuk diundi.');
            return;
        }

        const ticket = document.getElementById('ticketDisplay');
        const info = document.getElementById('winnerInfo');

        ticket.classList.add('spin');

        let interval = setInterval(() => {
            const random = paidCoupons[Math.floor(Math.random() * paidCoupons.length)];
            ticket.innerText = random.coupon_number;
            info.innerHTML = `<b>${random.buyer_name}</b><br>No HP: ${random.buyer_phone}<br>PIC Panitia: ${random.owner_name}`;
        }, 80);

        setTimeout(() => {
            clearInterval(interval);
            ticket.classList.remove('spin');
            document.getElementById('drawForm').submit();
        }, 3500);
    }
</script>

</body>
</html>
