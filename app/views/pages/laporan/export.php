<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data Laporan | SPP Skensa</title>
    <style>
        * {
            font-size: 0.98em;
        }
    </style>
</head>
<body>
    <table class="table table-bordered" border="1" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th style="text-align: start;">No</th>
                <th style="text-align: start;">Tanggal Transaksi</th>
                <th style="text-align: start;">Bulan Dibayar</th>
                <?php if($_SESSION['user']['role'] !== 'siswa') : ?>
                    <th style="text-align: start;">Nama Siswa</th>
                <?php endif; ?>
                <th style="text-align: start;">Nama Petugas</th>
                <th style="text-align: start;">Nominal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['transaksi'] as $key => $val) : ?>
                <tr class="siswa_data">
                    <td><?= ++$key ?></td>
                    <td><?= date_format(date_create($val['tanggal_bayar']), "d M Y") ?></td>
                    <td><?= date("F", mktime(0, 0, 0, $val['bulan_dibayar'], 10)) . ' ' . $val['tahun_dibayar'] ?></td>
                    <?php if($_SESSION['user']['role'] !== 'siswa') : ?>
                        <td><?= $val['nama_siswa'] ?></td>
                    <?php endif; ?>
                    <td><?= $val['nama_petugas'] ?></td>
                    <td><?= rupiah($val['nominal']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        window.print()
    </script>
</body>
</html>