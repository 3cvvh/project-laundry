<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'owner') {
    header("Location: ../login.php");
    exit;
}
include "../admin/koneksi.php";
header("Content-type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Semua Data Transaksi</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; margin: 30px; background: #f8fafc; }
        .header-logo { display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 4px; flex-wrap: wrap; }
        .header-logo img { height: 48px; }
        h2 { text-align: center; font-size: 2rem; color: #2563eb; margin-bottom: 0; font-weight: 800; letter-spacing: 0.05em;}
        h3 { text-align: center; font-size: 1.2rem; color: #334155; margin-bottom: 0.5rem; font-weight: 600;}
        .divider { border-bottom: 4px solid #2563eb; margin: 12px 0 24px 0; width: 100%; }
        .table-responsive { width: 100%; overflow-x: auto; border-radius: 8px; }
        table { min-width: 700px; width: 100%; border-collapse: collapse; margin-top: 24px; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px #0001; }
        th, td { border: 1px solid #e5e7eb; padding: 10px 14px; text-align: left; }
        th { background: #2563eb; color: #fff; font-size: 1rem; }
        tr:nth-child(even) { background: #f1f5f9; }
        tr:hover td { background: #e0e7ff !important; transition: background 0.2s; }
        tfoot td { background: #dbeafe !important; font-weight: bold; color: #1e293b; }
        .print-btn {
            margin-bottom:16px;padding:8px 24px;background:#2563eb;color:#fff;
            border:none;border-radius:4px;cursor:pointer;font-size:1rem;font-weight:bold;
            box-shadow: 0 2px 6px #0002; transition: background 0.2s;
        }
        .print-btn:hover { background: #1d4ed8; }
        @media (max-width: 900px) {
            .header-logo { flex-direction: column; gap: 4px; }
            h2 { font-size: 1.3rem; }
            body { margin: 8px; }
            .table-responsive { border-radius: 0; }
            table { min-width: 600px; font-size: 0.95rem; }
        }
        @media (max-width: 600px) {
            .header-logo { flex-direction: column; gap: 2px; }
            h2 { font-size: 1rem; }
            .divider { margin: 8px 0 12px 0; }
            .print-btn { width: 100%; padding: 8px 0; font-size: 0.95rem; }
            table { min-width: 480px; font-size: 0.90rem; }
            th, td { padding: 7px 6px; }
        }
        @media print {
            button, .print-btn, .divider { display: none; }
            body { margin: 0; background: #fff; }
            table { box-shadow: none; }
            .table-responsive { overflow: visible; }
        }
    </style>
</head>
<body>
    <div class="header-logo">
        <!-- <img src="../assets/media/logos/favicon.ico" alt="Logo Laundry" /> -->
        <h2 class="text-3xl font-extrabold text-blue-700 tracking-wide mb-1 text-center">LAPORAN TRANSAKSI LAUNDRY</h2>
        <h3 class="text-xl font-semibold text-gray-700 mb-2 text-center">LAUNDRY</h3>
        <div class="divider"></div>
    </div>
    <button class="print-btn" onclick="window.print()">Cetak</button>
    <div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Nama Member</th>
                <th>Outlet</th>
                <th>Tanggal Order</th>
                <th>Status Order</th>
                <th>Status Pembayaran</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $qry = mysqli_query($conn, "SELECT t.id_transaksi, m.nama_member, o.nama as outlet, t.tgl, t.status, t.dibayar, 
            SUM(dt.qty * p.harga) as total
            FROM transaksi t
            JOIN member m ON m.id_member = t.id_member
            JOIN outlet o ON o.id_outlet = t.id_outlet
            JOIN detail_transaksi dt ON dt.id_transaksi = t.id_transaksi
            JOIN paket p ON p.id_paket = dt.id_paket
            GROUP BY t.id_transaksi
            ORDER BY t.id_transaksi DESC");
        $no = 1;
        $grand_total = 0;
        while($row = mysqli_fetch_assoc($qry)) {
            $grand_total += $row['total'];
        ?>
            <tr>
                <td style="vertical-align:middle;"><?= $no++ ?></td>
                <td style="vertical-align:middle;"><?= $row['id_transaksi'] ?></td>
                <td style="vertical-align:middle;"><?= htmlspecialchars($row['nama_member']) ?></td>
                <td style="vertical-align:middle;"><?= htmlspecialchars($row['outlet']) ?></td>
                <td style="vertical-align:middle;"><?= $row['tgl'] ?></td>
                <td style="vertical-align:middle;"><?= ucfirst($row['status']) ?></td>
                <td style="vertical-align:middle;"><?= ucfirst($row['dibayar']) ?></td>
                <td style="vertical-align:middle; text-align:right;">Rp.<?= number_format($row['total'],0,',','.') ?></td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" style="text-align:right; background:#dbeafe; font-weight:bold; color:#1e293b; border-top:2px solid #2563eb;">Total Keseluruhan</td>
                <td style="font-weight:bold; background:#dbeafe; color:#1e293b; text-align:right; border-top:2px solid #2563eb;">Rp.<?= number_format($grand_total,0,',','.') ?></td>
            </tr>
        </tfoot>
    </table>
    </div>
    <div style="margin-top:40px; display:flex; justify-content:space-between; align-items:flex-end;">
        <span style="font-size:14px;color:#555;">Dicetak pada: <?=date('d-m-Y H:i')?></span>
        <div style="text-align:center;">
            <div style="margin-bottom:60px;"></div>
            <div style="font-weight:600;">Admin Laundry</div>
            <div style="margin-top:60px;">(___________________)</div>
        </div>
    </div>
</body>
</html>
