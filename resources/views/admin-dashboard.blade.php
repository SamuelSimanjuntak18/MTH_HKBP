<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Door Prize Gotilon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <style>
        .pic-master-card{
    background:
        radial-gradient(circle at right top, rgba(244,197,66,.20), transparent 30%),
        linear-gradient(135deg,#ffffff,#f8fafc);
    border:1px solid #eef2ff;
    border-radius:30px;
    padding:26px;
    margin-bottom:18px;
    box-shadow:0 16px 42px rgba(16,26,61,.08);
}

.pic-master-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:22px;
    margin-bottom:22px;
}

.pic-master-badge{
    display:inline-block;
    background:#fff7d6;
    color:#92400e;
    padding:8px 13px;
    border-radius:999px;
    font-weight:900;
    font-size:13px;
    margin-bottom:12px;
}

.pic-master-header h1{
    margin:0;
    color:#101a3d;
    font-size:32px;
}

.pic-master-header p{
    margin:8px 0 0;
    color:#6b7280;
}

.pic-master-stats{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:12px;
    min-width:330px;
}

.pic-master-stats div{
    background:white;
    border:1px solid #eef2ff;
    border-radius:18px;
    padding:14px;
}

.pic-master-stats span{
    display:block;
    color:#6b7280;
    font-size:12px;
    font-weight:900;
}

.pic-master-stats strong{
    display:block;
    margin-top:6px;
    color:#101a3d;
    font-size:24px;
}

.pic-input-form{
    display:grid;
    grid-template-columns:1fr 1fr 180px;
    gap:16px;
    align-items:end;
}

.pic-submit-wrap{
    padding-bottom:14px;
}

.pic-action-row{
    display:flex;
    gap:10px;
    justify-content:flex-end;
    align-items:center;
    flex-wrap:wrap;
}

.pic-inline-form{
    display:grid;
    grid-template-columns:160px 150px auto;
    gap:8px;
    align-items:center;
}

.pic-inline-form input{
    margin:0;
    padding:10px 12px;
    border-radius:12px;
}

.pic-disable-btn{
    background:#fee2e2;
    color:#991b1b;
    border:1px solid #fecaca;
    padding:10px 13px;
    border-radius:12px;
    font-weight:900;
}

.pic-enable-btn{
    background:#dcfce7;
    color:#166534;
    border:1px solid #bbf7d0;
    padding:10px 13px;
    border-radius:12px;
    font-weight:900;
}

@media(max-width:1100px){
    .pic-master-header{
        flex-direction:column;
        align-items:flex-start;
    }

    .pic-master-stats{
        width:100%;
        min-width:0;
    }

    .pic-input-form{
        grid-template-columns:1fr;
    }

    .pic-submit-wrap{
        padding-bottom:0;
    }

    .pic-inline-form{
        grid-template-columns:1fr;
        width:100%;
    }

    .pic-action-row{
        justify-content:flex-start;
    }
}

@media(max-width:700px){
    .pic-master-stats{
        grid-template-columns:1fr;
    }
}
        .prize-cell{
    display:flex;
    align-items:center;
    gap:14px;
}

.prize-icon{
    width:48px;
    height:48px;
    border-radius:18px;
    display:grid;
    place-items:center;
    background:#fff7d6;
    font-size:24px;
}

.prize-cell strong{
    display:block;
    color:#101a3d;
}

.prize-cell small{
    color:#6b7280;
}

.winner-time strong{
    display:block;
    color:#101a3d;
}

.winner-time small{
    color:#6b7280;
}

.winner-table-row td{
    transition:.2s;
}

.winner-table-row:hover td{
    background:#fffaf0;
}

        .sold-hero{
    background:
        radial-gradient(circle at right top, rgba(244,197,66,.24), transparent 30%),
        linear-gradient(135deg,#101a3d,#1f2d66);
    color:white;
    border-radius:34px;
    padding:30px;
    margin-bottom:18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:24px;
    box-shadow:0 28px 80px rgba(16,26,61,.20);
}

.sold-badge{
    display:inline-block;
    background:rgba(244,197,66,.16);
    color:#f4c542;
    border:1px solid rgba(244,197,66,.34);
    padding:9px 13px;
    border-radius:999px;
    font-weight:900;
    font-size:13px;
    margin-bottom:14px;
}

.sold-hero h1{
    margin:0;
    font-size:36px;
}

.sold-hero p{
    margin:8px 0 0;
    color:#dbe3ff;
}

.sold-hero-card{
    background:rgba(255,255,255,.11);
    border:1px solid rgba(255,255,255,.16);
    border-radius:24px;
    padding:20px;
    min-width:280px;
}

.sold-hero-card span{
    display:block;
    color:#dbe3ff;
    font-size:13px;
    font-weight:800;
}

.sold-hero-card strong{
    display:block;
    color:#f4c542;
    font-size:28px;
    margin:8px 0;
}

.sold-hero-card small{
    color:#dbe3ff;
}

.sold-summary-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:14px;
    margin-bottom:18px;
}

.sold-summary-card{
    background:white;
    border:1px solid #eef2ff;
    border-radius:22px;
    padding:18px;
    box-shadow:0 14px 34px rgba(16,26,61,.07);
}

.sold-summary-card span{
    display:block;
    color:#6b7280;
    font-weight:900;
    font-size:13px;
    margin-bottom:8px;
}

.sold-summary-card strong{
    color:#101a3d;
    font-size:30px;
}

.sold-summary-card.green strong{ color:#16a34a; }
.sold-summary-card.yellow strong{ color:#92400e; }
.sold-summary-card.red strong{ color:#991b1b; }
.sold-summary-card.blue strong{ color:#1d4ed8; }

.sold-table-card{
    background:rgba(255,255,255,.96);
    border:1px solid #eef2ff;
    border-radius:28px;
    padding:24px;
    box-shadow:0 16px 42px rgba(16,26,61,.08);
}

.sold-table-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:16px;
    margin-bottom:18px;
}

.sold-table-header h2{
    margin:0;
    color:#101a3d;
}

.sold-table-header p{
    margin:7px 0 0;
    color:#6b7280;
}

.sold-table-tools{
    min-width:320px;
}

.sold-search{
    width:100%;
    padding:13px 16px;
    border-radius:16px;
    border:1px solid #dbe1ef;
    outline:none;
}

.sold-search:focus{
    border-color:#f4c542;
    box-shadow:0 0 0 4px rgba(244,197,66,.18);
}

@media(max-width:1100px){
    .sold-hero{
        flex-direction:column;
        align-items:flex-start;
    }

    .sold-hero-card{
        width:100%;
        min-width:0;
    }

    .sold-summary-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:700px){
    .sold-summary-grid{
        grid-template-columns:1fr;
    }

    .sold-table-header{
        flex-direction:column;
    }

    .sold-table-tools{
        width:100%;
        min-width:0;
    }
}

        .sell-hero{

    background:
    radial-gradient(circle at right,rgba(244,197,66,.22),transparent 30%),
    linear-gradient(135deg,#101a3d,#1f2d66);

    color:white;

    border-radius:34px;

    padding:30px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:22px;

    box-shadow:0 25px 70px rgba(16,26,61,.18);

}

.sell-badge{

    display:inline-block;

    background:rgba(244,197,66,.18);

    color:#f4c542;

    padding:8px 14px;

    border-radius:999px;

    font-weight:700;

    margin-bottom:15px;

}

.sell-hero h1{

    margin:0;

    font-size:36px;

}

.sell-hero p{

    margin-top:8px;

    color:#dbe3ff;

}

.sell-side-card{

    background:rgba(255,255,255,.12);

    padding:24px;

    border-radius:22px;

    min-width:220px;

}

.sell-side-card span{

    display:block;

    color:#dbe3ff;

}

.sell-side-card strong{

    display:block;

    font-size:44px;

    color:#f4c542;

    margin:8px 0;

}

.sell-form-card{

    background:white;

    border-radius:30px;

    padding:30px;

    box-shadow:0 18px 55px rgba(0,0,0,.08);

}

.form-title{

    display:flex;

    gap:16px;

    align-items:center;

    margin-bottom:30px;

}

.form-icon{

    width:64px;

    height:64px;

    background:#fff6dc;

    border-radius:20px;

    display:grid;

    place-items:center;

    font-size:30px;

}

.form-title h2{

    margin:0;

}

.form-title p{

    margin:6px 0 0;

    color:#64748b;

}

.form-grid{

    display:grid;

    grid-template-columns:repeat(2,1fr);

    gap:20px;

}

.field.full{

    grid-column:1/-1;

}

.form-grid label{

    display:block;

    margin-bottom:8px;

    font-weight:700;

    color:#334155;

}

.form-grid input,
.form-grid textarea,
.form-grid select{

    width:100%;

    border:1px solid #dbe3ff;

    border-radius:16px;

    padding:14px 16px;

    font-size:15px;

    transition:.2s;

    background:#fbfcff;

}

.form-grid input:focus,
.form-grid textarea:focus{

    outline:none;

    border-color:#f4c542;

    box-shadow:0 0 0 4px rgba(244,197,66,.18);

}

.form-footer{

    margin-top:30px;

    text-align:right;

}

.save-sale-btn{

    background:linear-gradient(135deg,#101a3d,#1f2d66);

    color:white;

    border:none;

    padding:15px 34px;

    border-radius:18px;

    font-size:16px;

    font-weight:700;

    cursor:pointer;

    transition:.25s;

}

.save-sale-btn:hover{

    transform:translateY(-3px);

    box-shadow:0 18px 35px rgba(16,26,61,.22);

}

@media(max-width:900px){

.sell-hero{

flex-direction:column;

align-items:flex-start;

gap:20px;

}

.form-grid{

grid-template-columns:1fr;

}

}
        .coupon-header{
    background:
        radial-gradient(circle at right top, rgba(244,197,66,.22), transparent 28%),
        linear-gradient(135deg,#101a3d,#1f2d66);
    color:white;
    border-radius:34px;
    padding:30px;
    margin-bottom:18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:24px;
    box-shadow:0 28px 80px rgba(16,26,61,.20);
}

.coupon-badge{
    display:inline-block;
    background:rgba(244,197,66,.16);
    color:#f4c542;
    border:1px solid rgba(244,197,66,.34);
    padding:9px 13px;
    border-radius:999px;
    font-weight:900;
    font-size:13px;
    margin-bottom:14px;
}

.coupon-header h1{
    margin:0;
    font-size:34px;
}

.coupon-header p{
    margin:8px 0 0;
    color:#dbe3ff;
}

.coupon-header-stats{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:12px;
    min-width:360px;
}

.coupon-header-stats div{
    background:rgba(255,255,255,.10);
    border:1px solid rgba(255,255,255,.15);
    border-radius:20px;
    padding:16px;
}

.coupon-header-stats span{
    display:block;
    color:#dbe3ff;
    font-size:12px;
    font-weight:800;
}

.coupon-header-stats strong{
    display:block;
    margin-top:6px;
    color:#f4c542;
    font-size:26px;
}

.coupon-action-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:18px;
    margin-bottom:18px;
}

.coupon-action-card,
.coupon-assign-card,
.coupon-table-card{
    background:rgba(255,255,255,.95);
    border:1px solid #eef2ff;
    border-radius:28px;
    padding:24px;
    box-shadow:0 16px 42px rgba(16,26,61,.08);
}

.coupon-action-card{
    display:grid;
    grid-template-columns:64px 1fr;
    gap:16px;
    align-items:start;
}

.coupon-action-card form{
    grid-column:1 / -1;
}

.action-icon{
    width:58px;
    height:58px;
    border-radius:22px;
    display:grid;
    place-items:center;
    background:#fff7d6;
    font-size:28px;
}

.coupon-action-card.reward .action-icon{
    background:#ede9fe;
}

.coupon-action-card h2,
.coupon-assign-card h2,
.coupon-table-card h2{
    margin:0;
    color:#101a3d;
}

.coupon-action-card p,
.coupon-assign-card p,
.coupon-table-card p{
    margin:8px 0 0;
    color:#6b7280;
    line-height:1.5;
}

.full-btn{
    width:100%;
}

.btn-disabled{
    width:100%;
    background:#e5e7eb;
    color:#374151;
    cursor:not-allowed;
}

.assign-form{
    display:grid;
    grid-template-columns:1fr 1fr 180px;
    gap:16px;
    align-items:end;
    margin-top:18px;
}

.assign-button-wrap{
    padding-bottom:14px;
}

.table-card-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:16px;
    margin-bottom:18px;
}

.table-tools{
    min-width:320px;
}

.table-search{
    width:100%;
    padding:13px 16px;
    border-radius:16px;
    border:1px solid #dbe1ef;
    outline:none;
}

.table-search:focus{
    border-color:#f4c542;
    box-shadow:0 0 0 4px rgba(244,197,66,.18);
}

.coupon-table-summary{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:12px;
    margin-bottom:18px;
}

.coupon-table-summary div{
    background:#f8fafc;
    border:1px solid #eef2ff;
    border-radius:18px;
    padding:14px;
}

.coupon-table-summary span{
    display:block;
    color:#6b7280;
    font-size:12px;
    font-weight:900;
    margin-bottom:6px;
}

.coupon-table-summary strong{
    color:#101a3d;
    font-size:22px;
}

.professional-table-wrap{
    overflow:auto;
    border:1px solid #eef2ff;
    border-radius:22px;
    max-height:680px;
    background:white;
}

.professional-table{
    width:100%;
    border-collapse:separate;
    border-spacing:0;
    min-width:1150px;
    background:white;
}

.professional-table th{
    position:sticky;
    top:0;
    z-index:5;
    background:#f8fafc;
    color:#64748b;
    text-align:left;
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:.06em;
    padding:16px;
    border-bottom:1px solid #e5e7eb;
}

.professional-table td{
    padding:16px;
    border-bottom:1px solid #eef2ff;
    vertical-align:middle;
    color:#101a3d;
}

.professional-table tbody tr{
    transition:.18s ease;
}

.professional-table tbody tr:hover td{
    background:#fffaf0;
}

.text-right{
    text-align:right !important;
}

.coupon-number-cell span{
    display:inline-block;
    background:#101a3d;
    color:#f4c542;
    padding:9px 12px;
    border-radius:14px;
    font-weight:900;
    letter-spacing:.04em;
}

.modern-badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:7px 11px;
    border-radius:999px;
    font-size:11px;
    font-weight:900;
    text-transform:uppercase;
    letter-spacing:.04em;
}

.type-sale{
    background:#e5e7eb;
    color:#374151;
}

.type-reward{
    background:#dbeafe;
    color:#1d4ed8;
}

.status-available{
    background:#e5e7eb;
    color:#374151;
}

.status-unpaid{
    background:#fee2e2;
    color:#991b1b;
}

.status-partial{
    background:#fef3c7;
    color:#92400e;
}

.status-paid{
    background:#dcfce7;
    color:#166534;
}

.status-winner{
    background:#ede9fe;
    color:#5b21b6;
}

.status-cancelled{
    background:#111827;
    color:white;
}

.person-cell{
    display:flex;
    align-items:center;
    gap:12px;
}

.person-avatar{
    width:42px;
    height:42px;
    border-radius:16px;
    display:grid;
    place-items:center;
    background:linear-gradient(135deg,#f4c542,#ffb21c);
    color:#101a3d;
    font-weight:900;
    flex-shrink:0;
}

.person-cell strong,
.buyer-cell strong{
    display:block;
    color:#101a3d;
}

.person-cell small,
.buyer-cell small,
.payment-cell small{
    display:block;
    color:#6b7280;
    font-size:12px;
    margin-top:3px;
}

.muted-text{
    color:#94a3b8;
    font-weight:700;
}

.payment-cell{
    min-width:150px;
}

.payment-cell strong{
    font-size:14px;
}

.mini-progress{
    height:8px;
    background:#e5e7eb;
    border-radius:999px;
    overflow:hidden;
    margin:7px 0 4px;
}

.mini-progress div{
    height:100%;
    background:linear-gradient(90deg,#f4c542,#16a34a);
    border-radius:999px;
}

.admin-chip{
    display:inline-block;
    background:#f1f5f9;
    color:#475569;
    padding:7px 10px;
    border-radius:999px;
    font-size:12px;
    font-weight:900;
}

.action-edit-btn{
    background:#eef2ff;
    color:#101a3d;
    border:1px solid #dbe3ff;
    padding:9px 13px;
    border-radius:12px;
    font-weight:900;
}

.action-edit-btn:hover{
    background:#101a3d;
    color:white;
}

.table-empty-state{
    text-align:center;
    padding:44px 20px;
    color:#6b7280;
}

.table-empty-state div{
    font-size:48px;
    margin-bottom:10px;
}

.table-empty-state h3{
    margin:0 0 6px;
    color:#101a3d;
}

@media(max-width:1100px){
    .coupon-header{
        flex-direction:column;
        align-items:flex-start;
    }

    .coupon-header-stats{
        min-width:0;
        width:100%;
    }

    .assign-form{
        grid-template-columns:1fr;
    }

    .assign-button-wrap{
        padding-bottom:0;
    }
}

@media(max-width:760px){
    .coupon-action-grid,
    .coupon-header-stats,
    .coupon-table-summary{
        grid-template-columns:1fr;
    }

    .table-card-header{
        flex-direction:column;
    }

    .table-tools{
        width:100%;
        min-width:0;
    }
}
        .dashboard-wow{
    background:
        radial-gradient(circle at right top, rgba(244,197,66,.26), transparent 28%),
        radial-gradient(circle at left bottom, rgba(255,255,255,.12), transparent 30%),
        linear-gradient(135deg,#101a3d,#1f2d66);
    color:white;
    border-radius:34px;
    padding:32px;
    display:grid;
    grid-template-columns:1.25fr .75fr;
    gap:24px;
    margin-bottom:18px;
    box-shadow:0 28px 80px rgba(16,26,61,.22);
    overflow:hidden;
    position:relative;
}

.dashboard-wow::after{
    content:"";
    position:absolute;
    width:220px;
    height:220px;
    border-radius:50%;
    background:rgba(244,197,66,.12);
    left:-90px;
    bottom:-100px;
}

.wow-left,.wow-money{ position:relative; z-index:2; }

.wow-badge{
    display:inline-block;
    background:rgba(244,197,66,.16);
    border:1px solid rgba(244,197,66,.35);
    color:#f4c542;
    padding:9px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:900;
    margin-bottom:16px;
}

.dashboard-wow h1{
    margin:0;
    font-size:38px;
    letter-spacing:-.03em;
}

.dashboard-wow p{
    color:#dbe3ff;
    line-height:1.6;
    margin:10px 0 0;
}

.wow-mini{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:12px;
    margin-top:26px;
}

.wow-mini div{
    background:rgba(255,255,255,.10);
    border:1px solid rgba(255,255,255,.14);
    border-radius:20px;
    padding:16px;
}

.wow-mini span,.wow-money span{
    display:block;
    color:#dbe3ff;
    font-size:13px;
    font-weight:800;
}

.wow-mini strong{
    display:block;
    margin-top:7px;
    color:#f4c542;
    font-size:26px;
}

.wow-money{
    background:rgba(255,255,255,.12);
    border:1px solid rgba(255,255,255,.18);
    border-radius:26px;
    padding:24px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.wow-money strong{
    display:block;
    color:#f4c542;
    font-size:30px;
    margin:10px 0 6px;
    line-height:1.15;
}

.wow-money p{
    font-size:13px;
    margin:0 0 18px;
}

.wow-progress{
    height:14px;
    background:rgba(255,255,255,.18);
    border-radius:999px;
    overflow:hidden;
    margin-bottom:10px;
}

.wow-progress div{
    height:100%;
    background:linear-gradient(90deg,#f4c542,#16a34a);
    border-radius:999px;
}

.wow-money small{ color:#dbe3ff; }

.kpi-premium-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:16px;
    margin-bottom:18px;
}

.kpi-premium{
    background:rgba(255,255,255,.94);
    border:1px solid #eef2ff;
    border-radius:26px;
    padding:22px;
    box-shadow:0 16px 42px rgba(16,26,61,.08);
    overflow:hidden;
    position:relative;
}

.kpi-premium::after{
    content:"";
    position:absolute;
    width:110px;
    height:110px;
    border-radius:50%;
    background:rgba(244,197,66,.13);
    right:-40px;
    top:-40px;
}

.kpi-top{
    display:flex;
    align-items:center;
    gap:12px;
    position:relative;
    z-index:2;
}

.kpi-icon{
    width:48px;
    height:48px;
    border-radius:18px;
    background:#fff7d6;
    display:grid;
    place-items:center;
    font-size:24px;
}

.kpi-premium.blue .kpi-icon{ background:#dbeafe; }
.kpi-premium.green .kpi-icon{ background:#dcfce7; }
.kpi-premium.purple .kpi-icon{ background:#ede9fe; }

.kpi-top span{
    color:#6b7280;
    font-size:13px;
    font-weight:900;
}

.kpi-premium strong{
    display:block;
    position:relative;
    z-index:2;
    color:#101a3d;
    font-size:38px;
    margin:18px 0 6px;
    line-height:1;
}

.kpi-premium p{
    position:relative;
    z-index:2;
    margin:0;
    color:#6b7280;
    font-size:13px;
    line-height:1.5;
}

.dashboard-bottom-grid{
    display:grid;
    grid-template-columns:1.25fr .75fr;
    gap:18px;
}

.panel-modern{
    background:rgba(255,255,255,.95);
    border:1px solid #eef2ff;
    border-radius:28px;
    padding:24px;
    box-shadow:0 16px 42px rgba(16,26,61,.08);
}

.panel-modern-header{
    display:flex;
    justify-content:space-between;
    gap:14px;
    margin-bottom:18px;
}

.panel-modern-header h2{
    margin:0;
    color:#101a3d;
}

.panel-modern-header p{
    margin:6px 0 0;
    color:#6b7280;
}

.percent-pill{
    background:#101a3d;
    color:#f4c542;
    padding:10px 14px;
    border-radius:999px;
    font-weight:900;
    height:max-content;
}

.fund-modern-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:14px;
}

.fund-modern-grid div{
    background:#f8fafc;
    border:1px solid #eef2ff;
    border-radius:20px;
    padding:18px;
}

.fund-modern-grid span{
    color:#6b7280;
    font-weight:900;
    font-size:13px;
}

.fund-modern-grid strong{
    display:block;
    margin-top:8px;
    color:#101a3d;
    font-size:20px;
}

.green-text{ color:#16a34a !important; }

.top-list{
    display:grid;
    gap:12px;
}

.top-item{
    display:grid;
    grid-template-columns:34px 48px 1fr auto;
    align-items:center;
    gap:12px;
    background:#f8fafc;
    border:1px solid #eef2ff;
    border-radius:20px;
    padding:14px;
}

.rank{
    width:34px;
    height:34px;
    border-radius:12px;
    display:grid;
    place-items:center;
    background:#101a3d;
    color:#f4c542;
    font-weight:900;
}

.avatar{
    width:48px;
    height:48px;
    border-radius:18px;
    display:grid;
    place-items:center;
    background:linear-gradient(135deg,#f4c542,#ffb21c);
    color:#101a3d;
    font-weight:900;
}

.top-info strong{
    display:block;
    color:#101a3d;
}

.top-info span{
    color:#6b7280;
    font-size:13px;
}

.top-money{
    color:#16a34a;
    font-weight:900;
    white-space:nowrap;
}

.empty-mini{
    background:#f8fafc;
    border:1px dashed #cbd5e1;
    border-radius:20px;
    padding:24px;
    color:#6b7280;
    text-align:center;
    font-weight:800;
}

@media(max-width:1100px){
    .dashboard-wow,
    .dashboard-bottom-grid{
        grid-template-columns:1fr;
    }

    .kpi-premium-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:700px){
    .wow-mini,
    .kpi-premium-grid,
    .fund-modern-grid{
        grid-template-columns:1fr;
    }

    .dashboard-wow h1{
        font-size:30px;
    }

    .top-item{
        grid-template-columns:34px 48px 1fr;
    }

    .top-money{
        grid-column:3;
    }
}
        body{
    background:
        radial-gradient(circle at 8% 8%, rgba(244,197,66,.28), transparent 26%),
        radial-gradient(circle at 92% 20%, rgba(37,99,235,.12), transparent 30%),
        radial-gradient(circle at 70% 92%, rgba(124,58,237,.12), transparent 30%),
        linear-gradient(135deg,#eef3ff,#f8fafc);
}

.dashboard-premium-hero{
    background:
        radial-gradient(circle at right top, rgba(244,197,66,.25), transparent 28%),
        radial-gradient(circle at left bottom, rgba(255,255,255,.11), transparent 28%),
        linear-gradient(135deg,#101a3d,#1f2d66);
    color:white;
    border-radius:34px;
    padding:32px;
    margin-bottom:18px;
    display:grid;
    grid-template-columns:1.25fr .75fr;
    gap:24px;
    align-items:stretch;
    box-shadow:0 28px 80px rgba(16,26,61,.22);
    overflow:hidden;
    position:relative;
}

.dashboard-premium-hero::after{
    content:"";
    position:absolute;
    width:180px;
    height:180px;
    border-radius:50%;
    background:rgba(244,197,66,.12);
    left:-70px;
    bottom:-80px;
}

.hero-left,
.hero-money-card{
    position:relative;
    z-index:2;
}

.hero-badge{
    display:inline-block;
    background:rgba(244,197,66,.16);
    border:1px solid rgba(244,197,66,.35);
    color:#f4c542;
    padding:9px 13px;
    border-radius:999px;
    font-size:13px;
    font-weight:900;
    margin-bottom:16px;
}

.dashboard-premium-hero h1{
    margin:0;
    font-size:38px;
    letter-spacing:-.03em;
}

.dashboard-premium-hero p{
    margin:10px 0 0;
    color:#dbe3ff;
    line-height:1.6;
}

.hero-mini-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:12px;
    margin-top:26px;
}

.hero-mini-grid div{
    background:rgba(255,255,255,.10);
    border:1px solid rgba(255,255,255,.14);
    border-radius:20px;
    padding:16px;
}

.hero-mini-grid span,
.hero-money-card span{
    display:block;
    color:#dbe3ff;
    font-size:13px;
    font-weight:800;
}

.hero-mini-grid strong{
    display:block;
    margin-top:6px;
    color:#f4c542;
    font-size:28px;
}

.hero-money-card{
    background:rgba(255,255,255,.12);
    border:1px solid rgba(255,255,255,.18);
    border-radius:26px;
    padding:24px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    box-shadow:inset 0 0 0 1px rgba(255,255,255,.04);
}

.hero-money-card strong{
    display:block;
    color:#f4c542;
    margin:10px 0 6px;
    font-size:30px;
    line-height:1.15;
}

.hero-money-card p{
    margin:0 0 18px;
    font-size:13px;
}

.hero-progress{
    height:14px;
    background:rgba(255,255,255,.18);
    border-radius:999px;
    overflow:hidden;
}

.hero-progress div{
    height:100%;
    background:linear-gradient(90deg,#f4c542,#16a34a);
    border-radius:999px;
}

.dashboard-kpi-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:16px;
    margin-bottom:18px;
}

.kpi-card{
    background:rgba(255,255,255,.92);
    border:1px solid #eef2ff;
    border-radius:26px;
    padding:22px;
    box-shadow:0 16px 42px rgba(16,26,61,.08);
    position:relative;
    overflow:hidden;
}

.kpi-card::after{
    content:"";
    position:absolute;
    width:100px;
    height:100px;
    border-radius:50%;
    background:rgba(244,197,66,.13);
    right:-36px;
    top:-36px;
}

.kpi-icon{
    width:48px;
    height:48px;
    border-radius:18px;
    background:#fff7d6;
    display:grid;
    place-items:center;
    font-size:24px;
    margin-bottom:16px;
}

.kpi-card.blue .kpi-icon{ background:#dbeafe; }
.kpi-card.green .kpi-icon{ background:#dcfce7; }
.kpi-card.purple .kpi-icon{ background:#ede9fe; }

.kpi-card span{
    display:block;
    color:#6b7280;
    font-size:13px;
    font-weight:900;
}

.kpi-card strong{
    display:block;
    margin:8px 0;
    color:#101a3d;
    font-size:36px;
    line-height:1;
}

.kpi-card small{
    color:#6b7280;
    line-height:1.5;
}

.dashboard-content-grid{
    display:grid;
    grid-template-columns:1.35fr .65fr;
    gap:18px;
}

.dashboard-panel{
    background:rgba(255,255,255,.94);
    border:1px solid #eef2ff;
    border-radius:28px;
    padding:24px;
    box-shadow:0 16px 42px rgba(16,26,61,.08);
}

.highlight-panel{
    background:
        radial-gradient(circle at right top, rgba(244,197,66,.18), transparent 35%),
        #ffffff;
}

.panel-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:14px;
    margin-bottom:18px;
}

.panel-header h2{
    margin:0;
    color:#101a3d;
}

.panel-header p{
    margin:6px 0 0;
    color:#6b7280;
}

.panel-badge{
    background:#101a3d;
    color:#f4c542;
    padding:10px 14px;
    border-radius:999px;
    font-weight:900;
    white-space:nowrap;
}

.fund-list{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:14px;
}

.fund-list div{
    background:#f8fafc;
    border:1px solid #eef2ff;
    border-radius:20px;
    padding:18px;
}

.fund-list span{
    display:block;
    color:#6b7280;
    font-size:13px;
    font-weight:900;
    margin-bottom:8px;
}

.fund-list strong{
    color:#101a3d;
    font-size:20px;
}

.success-text{
    color:#16a34a !important;
}

.top-pic-card{
    display:flex;
    gap:16px;
    align-items:center;
    background:#f8fafc;
    border:1px solid #eef2ff;
    border-radius:22px;
    padding:20px;
}

.avatar{
    width:62px;
    height:62px;
    border-radius:22px;
    display:grid;
    place-items:center;
    background:linear-gradient(135deg,#f4c542,#ffb21c);
    color:#101a3d;
    font-weight:900;
    font-size:28px;
    flex-shrink:0;
}

.top-pic-card h3{
    margin:0;
    color:#101a3d;
    font-size:22px;
}

.top-pic-card p{
    margin:6px 0;
    color:#6b7280;
    line-height:1.5;
}

.top-pic-card strong{
    color:#16a34a;
    font-size:20px;
}

.top-pic-empty{
    background:#f8fafc;
    border:1px dashed #cbd5e1;
    border-radius:20px;
    padding:24px;
    color:#6b7280;
    text-align:center;
    font-weight:800;
}

@media(max-width:1100px){
    .dashboard-premium-hero,
    .dashboard-content-grid{
        grid-template-columns:1fr;
    }

    .dashboard-kpi-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:700px){
    .hero-mini-grid,
    .dashboard-kpi-grid,
    .fund-list{
        grid-template-columns:1fr;
    }

    .dashboard-premium-hero h1{
        font-size:30px;
    }

    .hero-money-card strong{
        font-size:24px;
    }
}
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
            <button onclick="showPage('pics')">⚙️ Input Panitia PIC</button>
        </div>

       <div class="logout-wrap">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
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
    @php
        $totalCoupons = $coupons->count();
        $paidCouponsCount = $coupons->where('payment_status','PAID')->count();
        $unpaidCouponsCount = $coupons->whereIn('payment_status',['UNPAID','PARTIAL'])->count();
        $availableCouponsCount = $coupons->where('payment_status','AVAILABLE')->count();
        $soldCouponsCount = $coupons->whereIn('payment_status',['UNPAID','PARTIAL','PAID','WINNER'])->count();
        $rewardCouponsCount = $coupons->where('coupon_type','REWARD')->count();
        $winnerCount = $winners->count();

        $soldProgress = $totalCoupons > 0 ? round(($soldCouponsCount / $totalCoupons) * 100, 1) : 0;
        $paidProgress = $totalCoupons > 0 ? round(($paidCouponsCount / $totalCoupons) * 100, 1) : 0;

        $topPics = $coupons
            ->whereNotNull('owner_name')
            ->groupBy('owner_name')
            ->map(function($items, $picName){
                return [
                    'name' => $picName,
                    'sold' => $items->whereIn('payment_status',['UNPAID','PARTIAL','PAID','WINNER'])->count(),
                    'paid' => $items->whereIn('payment_status',['PAID','WINNER'])->count(),
                    'amount' => $items->sum('paid_amount'),
                ];
            })
            ->sortByDesc('paid')
            ->take(3)
            ->values();
    @endphp

    <div class="dashboard-wow">
        <div class="wow-left">
            <div class="wow-badge">✨System Kupon</div>
            <h1>Selamat Datang, {{ auth()->user()->name }} 👋</h1>
            <div class="wow-mini">
                <div>
                    <span>Kupon Terjual</span>
                    <strong>{{ $soldCouponsCount }}/{{ $totalCoupons }}</strong>
                </div>
                <div>
                    <span>Kupon Lunas</span>
                    <strong>{{ $paidCouponsCount }}</strong>
                </div>
                <div>
                    <span>Reward</span>
                    <strong>{{ $rewardCouponsCount }}</strong>
                </div>
            </div>
        </div>

        <div class="wow-money">
            <span>Total Uang Masuk</span>
            <strong>Rp {{ number_format($paidAmountTotal, 0, ',', '.') }}</strong>
            <p>Dari target Rp {{ number_format($targetAmount, 0, ',', '.') }}</p>

            <div class="wow-progress">
                <div style="width: {{ $moneyProgress }}%"></div>
            </div>

            <small>{{ $moneyProgress }}% target dana tercapai</small>
        </div>
    </div>

    <div class="kpi-premium-grid">
        <div class="kpi-premium">
            <div class="kpi-top">
                <div class="kpi-icon">🎟</div>
                <span>Total Kupon</span>
            </div>
            <strong>{{ $totalCoupons }}</strong>
            <p>{{ $availableCouponsCount }} kupon masih tersedia</p>
        </div>

        <div class="kpi-premium blue">
            <div class="kpi-top">
                <div class="kpi-icon">🛒</div>
                <span>Kupon Terjual</span>
            </div>
            <strong>{{ $soldCouponsCount }}</strong>
            <p>{{ $soldProgress }}% dari total kupon</p>
        </div>

        <div class="kpi-premium green">
            <div class="kpi-top">
                <div class="kpi-icon">✅</div>
                <span>Sudah Lunas</span>
            </div>
            <strong>{{ $paidCouponsCount }}</strong>
            <p>{{ $unpaidCouponsCount }} kupon belum/parsial</p>
        </div>

        <div class="kpi-premium purple">
            <div class="kpi-top">
                <div class="kpi-icon">🏆</div>
                <span>Pemenang</span>
            </div>
            <strong>{{ $winnerCount }}</strong>
            <p>{{ $rewardCouponsCount }} kupon reward ikut undian</p>
        </div>
    </div>

    <div class="dashboard-bottom-grid">
        <div class="panel-modern">
            <div class="panel-modern-header">
                <div>
                    <h2>Ringkasan Dana</h2>
                    <p>Overview target, realisasi, dan sisa dana.</p>
                </div>
                <div class="percent-pill">{{ $moneyProgress }}%</div>
            </div>

            <div class="fund-modern-grid">
                <div>
                    <span>Target Dana</span>
                    <strong>Rp {{ number_format($targetAmount, 0, ',', '.') }}</strong>
                </div>
                <div>
                    <span>Uang Masuk</span>
                    <strong class="green-text">Rp {{ number_format($paidAmountTotal, 0, ',', '.') }}</strong>
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

        <div class="panel-modern top-seller-panel">
            <div class="panel-modern-header">
                <div>
                    <h2>Top PIC</h2>
                    <p>Ranking sementara berdasarkan kupon lunas.</p>
                </div>
                <div class="percent-pill">⭐</div>
            </div>

            @if($topPics->count() > 0)
                <div class="top-list">
                    @foreach($topPics as $index => $pic)
                        <div class="top-item">
                            <div class="rank">{{ $index + 1 }}</div>
                            <div class="avatar">{{ strtoupper(substr($pic['name'],0,1)) }}</div>
                            <div class="top-info">
                                <strong>{{ $pic['name'] }}</strong>
                                <span>{{ $pic['paid'] }} lunas • {{ $pic['sold'] }} terjual</span>
                            </div>
                            <div class="top-money">
                                Rp {{ number_format($pic['amount'], 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-mini">Belum ada data PIC.</div>
            @endif
        </div>
    </div>
</section>

    <section id="coupons" class="page">
    @php
        $saleCouponsCount = $coupons->where('coupon_type','SALE')->count();
        $rewardCouponsCount = $coupons->where('coupon_type','REWARD')->count();
        $availableCouponsCount = $coupons->where('payment_status','AVAILABLE')->count();
        $paidCouponsCount = $coupons->where('payment_status','PAID')->count();
    @endphp

    <div class="coupon-header">
        <div>
            <span class="coupon-badge">🎟 Coupon Management</span>
            <h1>Data Kupon Gotilon</h1>
        </div>

        <div class="coupon-header-stats">
            <div>
                <span>Total</span>
                <strong>{{ $coupons->count() }}</strong>
            </div>
            <div>
                <span>Available</span>
                <strong>{{ $availableCouponsCount }}</strong>
            </div>
            <div>
                <span>Lunas</span>
                <strong>{{ $paidCouponsCount }}</strong>
            </div>
        </div>
    </div>

    <div class="coupon-action-grid">
        <div class="coupon-action-card">
            <div class="action-icon">🎟</div>
            <div>
                <h2>Generate Kupon Penjualan</h2>
                <p>Kupon penjualan akan dibuat mulai nomor <b>0001</b> sampai <b>1500</b>.</p>
            </div>

            <form method="POST" action="{{ route('coupons.generate') }}">
                @csrf

                @if($hasSaleCoupons)
                    <button class="btn-disabled" disabled>
                        ✅ 1500 Kupon Sudah Digenerate
                    </button>
                    <small>Kupon penjualan sudah tersedia.</small>
                @else
                    <button class="primary full-btn">
                        Generate 1500 Kupon
                    </button>
                @endif
            </form>
        </div>

        <div class="coupon-action-card reward">
            <div class="action-icon">🎁</div>
            <div>
                <h2>Generate Reward PIC</h2>
                <p>Reward dibuat untuk PIC yang berhasil menjual setiap <b>35 kupon lunas</b>.</p>
            </div>

            <form method="POST" action="{{ route('coupons.generateReward') }}">
                @csrf
                <button class="secondary full-btn">
                    Generate Kupon Reward
                </button>
            </form>
        </div>
    </div>

    <div class="coupon-assign-card">
        <div class="assign-header">
            <div>
                <h2>Update PIC Berdasarkan Nomor Kupon</h2>
                <p>Contoh: <b>1-10</b>, <b>1,5,6</b>, atau <b>1-10,15,20,25-30</b>.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('coupons.updatePicRange') }}" class="assign-form">
            @csrf

            <div>
                <label>Nomor Kupon</label>
                <input
                    name="coupon_numbers"
                    placeholder="Contoh: 1-10 atau 1,5,6 atau 1-10,15,20"
                    required
                >
            </div>

            <div>
                <label>PIC Panitia</label>
                <select name="owner_name" class="searchable-select" data-placeholder="Cari PIC Panitia..." required>
                    <option value=""></option>
                    @foreach($activePics as $pic)
                        <option value="{{ $pic->name }}">{{ $pic->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="assign-button-wrap">
                <button class="primary full-btn">
                    Update PIC
                </button>
            </div>
        </form>
    </div>

    <div class="coupon-table-card">
        <div class="table-card-header">
            <div>
                <h2>Daftar Kupon</h2>
                <p>Menampilkan seluruh kupon penjualan dan reward.</p>
            </div>

            <div class="table-tools">
                <input
                    type="text"
                    id="couponSearchInput"
                    class="table-search"
                    placeholder="Cari nomor, PIC, pembeli, status..."
                >
            </div>
        </div>

        <div class="coupon-table-summary">
            <div>
                <span>Kupon Sale</span>
                <strong>{{ $saleCouponsCount }}</strong>
            </div>
            <div>
                <span>Kupon Reward</span>
                <strong>{{ $rewardCouponsCount }}</strong>
            </div>
            <div>
                <span>Belum Terjual</span>
                <strong>{{ $availableCouponsCount }}</strong>
            </div>
            <div>
                <span>Lunas</span>
                <strong>{{ $paidCouponsCount }}</strong>
            </div>
        </div>

        <div class="professional-table-wrap">
            <table class="professional-table" id="couponTable">
                <thead>
                <tr>
                    <th>No Kupon</th>
                    <th>Jenis</th>
                    <th>PIC Panitia</th>
                    <th>Pembeli</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th>Admin</th>
                    <th class="text-right">Aksi</th>
                </tr>
                </thead>

                <tbody>
                @foreach($coupons as $coupon)
                    <tr class="coupon-table-row"
                        data-search="{{ strtolower(
                            ($coupon->coupon_number ?? '') . ' ' .
                            ($coupon->coupon_type ?? 'SALE') . ' ' .
                            ($coupon->owner_name ?? 'Belum Ada PIC') . ' ' .
                            ($coupon->buyer_name ?? '') . ' ' .
                            ($coupon->payment_status ?? '') . ' ' .
                            ($coupon->input_by ?? '')
                        ) }}"
                    >
                        <td>
                            <div class="coupon-number-cell">
                                <span>#{{ $coupon->coupon_number }}</span>
                            </div>
                        </td>

                        <td>
                            <span class="modern-badge type-{{ strtolower($coupon->coupon_type ?? 'SALE') }}">
                                {{ $coupon->coupon_type ?? 'SALE' }}
                            </span>
                        </td>

                        <td>
                            <div class="person-cell">
                                <div class="person-avatar">
                                    {{ $coupon->owner_name ? strtoupper(substr($coupon->owner_name, 0, 1)) : '?' }}
                                </div>
                                <div>
                                    <strong>{{ $coupon->owner_name ?? 'Belum Ada PIC' }}</strong>
                                    <small>PIC Panitia</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            @if($coupon->buyer_name)
                                <div class="buyer-cell">
                                    <strong>{{ $coupon->buyer_name }}</strong>
                                    <small>{{ $coupon->buyer_phone ?? '-' }}</small>
                                </div>
                            @else
                                <span class="muted-text">Belum ada pembeli</span>
                            @endif
                        </td>

                        <td>
                            <div class="payment-cell">
                                <strong>Rp {{ number_format($coupon->paid_amount,0,',','.') }}</strong>
                                <div class="mini-progress">
                                    <div style="width: {{ $coupon->payment_percent }}%"></div>
                                </div>
                                <small>{{ $coupon->payment_percent }}%</small>
                            </div>
                        </td>

                        <td>
                            <span class="modern-badge status-{{ strtolower($coupon->payment_status) }}">
                                {{ $coupon->payment_status }}
                            </span>
                        </td>

                        <td>
                            <span class="admin-chip">
                                {{ $coupon->input_by ?? '-' }}
                            </span>
                        </td>

                        <td class="text-right">
                            <button
                                type="button"
                                class="action-edit-btn"
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
                        <td colspan="8">
                            <div class="table-empty-state">
                                <div>🎟</div>
                                <h3>Belum ada data kupon</h3>
                                <p>Generate kupon terlebih dahulu untuk mulai menggunakan sistem.</p>
                            </div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</section>

     <section id="sell" class="page">

    <div class="sell-hero">

        <div>
            <span class="sell-badge">💳 Pembelian Kupon</span>
            <h1>Input Pembelian Kupon</h1>
        </div>

        <div class="sell-side-card">
            <span>Kupon Siap Dijual</span>
            <strong>{{ $availableCoupons->count() }}</strong>

            <small>
                Kupon yang belum memiliki pembeli.
            </small>
        </div>

    </div>

    <div class="sell-form-card">

        <div class="form-title">
            <div class="form-icon">
                🎟
            </div>

            <div>
                <h2>Informasi Pembelian</h2>
                <p>Lengkapi seluruh informasi sebelum menyimpan transaksi.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('sales.store') }}">

            @csrf

            <div class="form-grid">

                <div class="field full">

                    <label>Nomor Kupon</label>

                    <select
                        name="coupon_id"
                        class="searchable-select"
                        data-placeholder="Cari nomor kupon..."
                        required>

                        <option></option>

                        @foreach($availableCoupons as $coupon)

                            <option value="{{ $coupon->id }}">
                                #{{ $coupon->coupon_number }}
                                •
                                {{ $coupon->owner_name ?? 'Belum Ada PIC' }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <div>

                    <label>Nama Pembeli</label>

                    <input
                        name="buyer_name"
                        placeholder="Masukkan nama pembeli"
                        required>

                </div>

                <div>

                    <label>No HP</label>

                    <input
                        name="buyer_phone"
                        placeholder="08xxxxxxxxxx"
                        required>

                </div>

                <div>

                    <label>Jumlah Bayar</label>

                    <input
                        type="number"
                        name="paid_amount"
                        placeholder="100000"
                        min="0"
                        max="100000"
                        required>

                </div>

                <div>

                    <label>Admin Input</label>

                    <input
                        readonly
                        value="{{ auth()->user()->name }}">

                    <input
                        type="hidden"
                        name="input_by"
                        value="{{ auth()->user()->name }}">

                </div>

                <div class="field full">

                    <label>Catatan</label>

                    <textarea
                        rows="3"
                        name="note"
                        placeholder="Opsional..."></textarea>

                </div>

            </div>

            <div class="form-footer">

                <button class="save-sale-btn">

                    💾 Simpan Pembelian

                </button>

            </div>

        </form>

    </div>

</section>

     <section id="sold" class="page">
    @php
        $soldTotal = $soldCoupons->count();
        $soldPaid = $soldCoupons->whereIn('payment_status', ['PAID','WINNER'])->count();
        $soldPartial = $soldCoupons->where('payment_status', 'PARTIAL')->count();
        $soldUnpaid = $soldCoupons->where('payment_status', 'UNPAID')->count();
        $soldReward = $soldCoupons->where('coupon_type', 'REWARD')->count();
        $soldAmount = $soldCoupons->sum('paid_amount');
    @endphp

    <div class="sold-hero">
        <div>
            <span class="sold-badge">🛒 Report Penjualan</span>
            <h1>Kupon Terjual</h1>
        </div>
        <div class="sold-hero-card">
            <span>Total Uang Masuk</span>
            <strong>Rp {{ number_format($soldAmount, 0, ',', '.') }}</strong>
            <small>Dari {{ $soldTotal }} kupon terjual</small>
        </div>
    </div>

    <div class="sold-summary-grid">
        <div class="sold-summary-card">
            <span>Total Terjual</span>
            <strong>{{ $soldTotal }}</strong>
        </div>

        <div class="sold-summary-card green">
            <span>Lunas</span>
            <strong>{{ $soldPaid }}</strong>
        </div>

        <div class="sold-summary-card yellow">
            <span>Parsial</span>
            <strong>{{ $soldPartial }}</strong>
        </div>

        <div class="sold-summary-card red">
            <span>Belum Bayar</span>
            <strong>{{ $soldUnpaid }}</strong>
        </div>

        <div class="sold-summary-card blue">
            <span>Reward</span>
            <strong>{{ $soldReward }}</strong>
        </div>
    </div>

    <div class="sold-table-card">
        <div class="sold-table-header">
            <div>
                <h2>Daftar Kupon Terjual</h2>
                <p>Cari berdasarkan nomor kupon, PIC, pembeli, no HP, status, atau admin.</p>
            </div>

            <div class="sold-table-tools">
                <input
                    type="text"
                    id="soldSearchInput"
                    class="sold-search"
                    placeholder="Cari data kupon terjual..."
                >
            </div>
        </div>

        <div class="professional-table-wrap">
            <table class="professional-table" id="soldTable">
                <thead>
                <tr>
                    <th>No Kupon</th>
                    <th>Jenis</th>
                    <th>PIC Panitia</th>
                    <th>Pembeli</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th>Admin</th>
                </tr>
                </thead>

                <tbody>
                @foreach($soldCoupons as $coupon)
                    <tr class="sold-table-row"
                        data-search="{{ strtolower(
                            ($coupon->coupon_number ?? '') . ' ' .
                            ($coupon->coupon_type ?? 'SALE') . ' ' .
                            ($coupon->owner_name ?? 'Belum Ada PIC') . ' ' .
                            ($coupon->buyer_name ?? '') . ' ' .
                            ($coupon->buyer_phone ?? '') . ' ' .
                            ($coupon->payment_status ?? '') . ' ' .
                            ($coupon->input_by ?? '')
                        ) }}"
                    >
                        <td>
                            <div class="coupon-number-cell">
                                <span>#{{ $coupon->coupon_number }}</span>
                            </div>
                        </td>

                        <td>
                            <span class="modern-badge type-{{ strtolower($coupon->coupon_type ?? 'SALE') }}">
                                {{ $coupon->coupon_type ?? 'SALE' }}
                            </span>
                        </td>

                        <td>
                            <div class="person-cell">
                                <div class="person-avatar">
                                    {{ $coupon->owner_name ? strtoupper(substr($coupon->owner_name, 0, 1)) : '?' }}
                                </div>
                                <div>
                                    <strong>{{ $coupon->owner_name ?? 'Belum Ada PIC' }}</strong>
                                    <small>PIC Panitia</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <div class="buyer-cell">
                                <strong>{{ $coupon->buyer_name ?? '-' }}</strong>
                                <small>{{ $coupon->buyer_phone ?? '-' }}</small>
                            </div>
                        </td>

                        <td>
                            <div class="payment-cell">
                                <strong>Rp {{ number_format($coupon->paid_amount,0,',','.') }}</strong>
                                <div class="mini-progress">
                                    <div style="width: {{ $coupon->payment_percent }}%"></div>
                                </div>
                                <small>{{ $coupon->payment_percent }}%</small>
                            </div>
                        </td>

                        <td>
                            <span class="modern-badge status-{{ strtolower($coupon->payment_status) }}">
                                {{ $coupon->payment_status }}
                            </span>
                        </td>

                        <td>
                            <span class="admin-chip">
                                {{ $coupon->input_by ?? '-' }}
                            </span>
                        </td>
                    </tr>
                @endforeach

                @if($soldCoupons->count() === 0)
                    <tr>
                        <td colspan="7">
                            <div class="table-empty-state">
                                <div>🛒</div>
                                <h3>Belum ada kupon terjual</h3>
                                <p>Data akan tampil setelah admin menyimpan pembelian kupon.</p>
                            </div>
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

    <div class="coupon-table-card">

        <div class="table-card-header">

            <div>
                <h2>🏆 Riwayat Pemenang</h2>
                <p>Daftar seluruh pemenang door prize Gotilon.</p>
            </div>

            <div class="table-tools">
                <input
                    type="text"
                    id="winnerSearchInput"
                    class="table-search"
                    placeholder="Cari hadiah, nomor kupon, nama, PIC..."
                >
            </div>

        </div>

        <div class="professional-table-wrap">

            <table class="professional-table">

                <thead>

                <tr>
                    <th>Hadiah</th>
                    <th>No Kupon</th>
                    <th>Pemenang</th>
                    <th>PIC Panitia</th>
                    <th>Waktu Undian</th>
                </tr>

                </thead>

                <tbody>

                @foreach($winners as $winner)

                    <tr
                        class="winner-table-row"
                        data-search="{{ strtolower(
                            $winner->prize_name.' '.
                            $winner->coupon->coupon_number.' '.
                            $winner->coupon->buyer_name.' '.
                            ($winner->coupon->owner_name ?? '')
                        ) }}"
                    >

                        <td>

                            <div class="prize-cell">

                                <div class="prize-icon">
                                    🏆
                                </div>

                                <div>
                                    <strong>{{ $winner->prize_name }}</strong>
                                    <small>Door Prize</small>
                                </div>

                            </div>

                        </td>

                        <td>

                            <div class="coupon-number-cell">
                                <span>#{{ $winner->coupon->coupon_number }}</span>
                            </div>

                        </td>

                        <td>

                            <div class="person-cell">

                                <div class="person-avatar">

                                    {{ strtoupper(substr($winner->coupon->buyer_name,0,1)) }}

                                </div>

                                <div>

                                    <strong>{{ $winner->coupon->buyer_name }}</strong>

                                    <small>{{ $winner->coupon->buyer_phone }}</small>

                                </div>

                            </div>

                        </td>

                        <td>

                            <div class="person-cell">

                                <div class="person-avatar">

                                    {{ $winner->coupon->owner_name ? strtoupper(substr($winner->coupon->owner_name,0,1)) : '?' }}

                                </div>

                                <div>

                                    <strong>{{ $winner->coupon->owner_name ?? 'Belum Ada PIC' }}</strong>

                                    <small>PIC Panitia</small>

                                </div>

                            </div>

                        </td>

                        <td>

                            <div class="winner-time">

                                <strong>

                                    {{ \Carbon\Carbon::parse($winner->drawn_at)->addHours(7)->format('d M Y') }}

                                </strong>

                                <small>

                                    {{ \Carbon\Carbon::parse($winner->drawn_at)->addHours(7)->format('H:i:s') }} WIB

                                </small>

                            </div>

                        </td>

                    </tr>

                @endforeach

                @if($winners->count()==0)

                    <tr>

                        <td colspan="5">

                            <div class="table-empty-state">

                                <div>🏆</div>

                                <h3>Belum ada pemenang</h3>

                                <p>Pemenang akan muncul setelah proses undian dilakukan.</p>

                            </div>

                        </td>

                    </tr>

                @endif

                </tbody>

            </table>

        </div>

    </div>

</section>

       <section id="pics" class="page">
    @php
        $activePicCount = $pics->where('is_active', true)->count();
        $inactivePicCount = $pics->where('is_active', false)->count();
    @endphp

    <div class="pic-master-card">
        <div class="pic-master-header">
            <div>
                <span class="pic-master-badge">⚙️ Master Data</span>
                <h1>Master PIC Panitia</h1>
                <p>Kelola daftar PIC agar input dan distribusi kupon lebih rapi.</p>
            </div>

            <div class="pic-master-stats">
                <div>
                    <span>Total PIC</span>
                    <strong>{{ $pics->count() }}</strong>
                </div>
                <div>
                    <span>Aktif</span>
                    <strong>{{ $activePicCount }}</strong>
                </div>
                <div>
                    <span>Nonaktif</span>
                    <strong>{{ $inactivePicCount }}</strong>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('pics.store') }}" class="pic-input-form">
            @csrf

            <div>
                <label>Nama PIC</label>
                <input name="name" placeholder="Contoh: Samuel" required>
            </div>

            <div>
                <label>No HP</label>
                <input name="phone" placeholder="Opsional">
            </div>

            <div class="pic-submit-wrap">
                <button class="primary full-btn">
                    Tambah PIC
                </button>
            </div>
        </form>
    </div>

    <div class="coupon-table-card">
        <div class="table-card-header">
            <div>
                <h2>Daftar PIC Panitia</h2>
                <p>Cari, update, aktifkan, atau nonaktifkan PIC Panitia.</p>
            </div>

            <div class="table-tools">
                <input
                    type="text"
                    id="picSearchInput"
                    class="table-search"
                    placeholder="Cari nama PIC atau no HP..."
                >
            </div>
        </div>

        <div class="professional-table-wrap">
            <table class="professional-table">
                <thead>
                <tr>
                    <th>Nama PIC</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
                </thead>

                <tbody>
                @foreach($pics as $pic)
                    <tr class="pic-table-row"
                        data-search="{{ strtolower($pic->name.' '.($pic->phone ?? '').' '.($pic->is_active ? 'aktif' : 'nonaktif')) }}"
                    >
                        <td>
                            <div class="person-cell">
                                <div class="person-avatar">
                                    {{ strtoupper(substr($pic->name,0,1)) }}
                                </div>
                                <div>
                                    <strong>{{ $pic->name }}</strong>
                                    <small>PIC Panitia</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="admin-chip">
                                {{ $pic->phone ?? '-' }}
                            </span>
                        </td>

                        <td>
                            @if($pic->is_active)
                                <span class="modern-badge status-paid">
                                    Aktif
                                </span>
                            @else
                                <span class="modern-badge status-cancelled">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <td class="text-right">
                            <div class="pic-action-row">
                                <form method="POST" action="{{ route('pics.update', $pic) }}" class="pic-inline-form">
                                    @csrf

                                    <input name="name" value="{{ $pic->name }}" required>
                                    <input name="phone" value="{{ $pic->phone }}">

                                    <button class="action-edit-btn">
                                        Update
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('pics.toggle', $pic) }}">
                                    @csrf

                                    <button class="{{ $pic->is_active ? 'pic-disable-btn' : 'pic-enable-btn' }}">
                                        {{ $pic->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

                @if($pics->count() === 0)
                    <tr>
                        <td colspan="4">
                            <div class="table-empty-state">
                                <div>👥</div>
                                <h3>Belum ada data PIC</h3>
                                <p>Tambahkan PIC Panitia terlebih dahulu agar bisa dipilih saat assign kupon.</p>
                            </div>
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
    const picSearchInput = document.getElementById('picSearchInput');

if(picSearchInput){
    picSearchInput.addEventListener('input', function(){
        const keyword = this.value.toLowerCase();

        document.querySelectorAll('.pic-table-row').forEach(row => {
            row.style.display = row.dataset.search.includes(keyword) ? '' : 'none';
        });
    });
}
    const winnerSearchInput = document.getElementById('winnerSearchInput');

if(winnerSearchInput){

    winnerSearchInput.addEventListener('input', function(){

        const keyword = this.value.toLowerCase();

        document.querySelectorAll('.winner-table-row').forEach(row=>{

            row.style.display =
                row.dataset.search.includes(keyword)
                ? ''
                : 'none';

        });

    });

}
    const soldSearchInput = document.getElementById('soldSearchInput');

if(soldSearchInput){
    soldSearchInput.addEventListener('input', function(){
        const keyword = this.value.toLowerCase();

        document.querySelectorAll('.sold-table-row').forEach(row => {
            row.style.display = row.dataset.search.includes(keyword) ? '' : 'none';
        });
    });
}
    const couponSearchInput = document.getElementById('couponSearchInput');

if(couponSearchInput){
    couponSearchInput.addEventListener('input', function(){
        const keyword = this.value.toLowerCase();

        document.querySelectorAll('.coupon-table-row').forEach(row => {
            row.style.display = row.dataset.search.includes(keyword) ? '' : 'none';
        });
    });
}
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
