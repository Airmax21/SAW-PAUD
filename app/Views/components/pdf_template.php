<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Ranking Akhir Semester</title>
    <style>
        body {
            font-family: sans-serif;
            color: #333;
            font-size: 12px;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0 0;
            color: #666;
        }

        .meta {
            margin-bottom: 20px;
            width: 100%;
        }

        .meta td {
            font-weight: bold;
        }

        .table-data {
            w_full: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            width: 100%;
        }

        .table-data th {
            bg_color: #f5f5f5;
            background: #e5e7eb;
            padding: 10px;
            font-weight: bold;
            border: 1px solid #ccc;
            text-align: left;
        }

        .table-data td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Laporan Hasil Akhir Perangkingan Siswa</h2>
        <p>Berdasarkan Metode Simple Additive Weighting (SAW)</p>
    </div>

    <table class="meta">
        <tr>
            <td width="80">Kelas</td>
            <td width="10">:</td>
            <td><?= $className ?></td>
            <td width="80" align="right">Periode</td>
            <td width="10" align="right">:</td>
            <td width="100" align="right"><?= date('F Y', strtotime($period)) ?></td>
        </tr>
    </table>

    <table class="table-data">
        <thead>
            <tr>
                <th width="40" class="text-center">Rank</th>
                <th>Nama Anak Didik</th>
                <?php foreach ($criterias as $crit): ?>
                    <th class="text-center" width="60"><?= $crit->code ?></th>
                <?php endforeach; ?>
                <th class="text-right" width="80">Skor Akhir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ranking as $index => $row): ?>
                <tr>
                    <td class="text-center font-bold"><?= $index + 1 ?></td>
                    <td class="font-bold"><?= $row->student_name ?></td>
                    <?php foreach ($criterias as $crit): ?>
                        <td class="text-center"><?= number_format($row->matrix[$crit->id]['normalized'], 2) ?></td>
                    <?php endforeach; ?>
                    <td class="text-right font-bold" style="color: #e040a0;"><?= number_format($row->total_score * 100, 1) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>