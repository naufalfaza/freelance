<?php
$id_transaksi = $this->input->get("id_transaksi");
$get = $this->M_data->dataTransaksiById($id_transaksi);
$gett = $get->row();
$no = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINT INVOICE</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            font-size: 24px;
            margin: 0;
        }

        .invoice-header img {
            width: 150px;
            height: auto;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-details th,
        .invoice-details td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        .invoice-details th {
            text-align: left;
            background-color: #f2f2f2;
        }

        .invoice-items {
            margin-bottom: 20px;
        }

        .invoice-items table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-items th,
        .invoice-items td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        .invoice-items th {
            text-align: left;
            background-color: #f2f2f2;
        }

        .invoice-summary {
            text-align: right;
        }

        .invoice-summary table {
            width: auto;
        }

        .invoice-summary th,
        .invoice-summary td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <h1 style="text-align: center;"><u>INVOICE</u></h1>
        <!-- <img src="<?= base_url("/assets/img/logo.png") ?>" alt="LOGO" width="20%"> -->
    </div>

    <div class="invoice-details">
        <table>
            <tr>
                <th width="30%">NAMA:</th>
                <td width="70%"><?= $gett->nama ?></td>
            </tr>
            <tr>
                <th>EMAIL:</th>
                <td><?= $gett->email ?></td>
            </tr>
            <tr>
                <th>TANGGAL:</th>
                <td><?= date("d-m-Y", strtotime($gett->record)) ?></td>
            </tr>
            <tr>
                <th>NO INVOICE:</th>
                <td><?= $gett->id_transaksi ?></td>
            </tr>
        </table>
    </div>

    <div class="invoice-items">
        <table>
            <tr>
                <th>KETERANGAN</th>
                <th>HARGA</th>
                <th>JML</th>
                <th>TOTAL</th>
            </tr>
            <?php
            $totalsemua = 0;
            foreach ($get->result() as $dt) {
                $pesanan = json_decode($dt->pesanan, TRUE);
                $items = [];
                foreach ($pesanan as $item) {
                    if (substr($item['pesanan'], 0, 3) == "CTK") {
                        $cetak = $this->M_data->getWhere("tbl_cetak", array("id_cetak" => $item['pesanan']))->row();
                        $ukuran = $this->M_data->getWhere("tbl_ukuran", array("id_ukuran" => $cetak->id_ukuran))->row();
                        $nm_pesanan = "Cetak Foto - " . $ukuran->ukuran;
                        $harga = $ukuran->harga;
                        $qty = $cetak->qty;
                        $link =  base_url("/assets/img/cetak/" . $cetak->image);
                        $image = '<img src="' . $link . '" width="20%" style="float: left; padding-right: 10px;">';
                    } else {
                        $barang = $this->M_data->getWhere("tbl_barang", array("id_barang" => $item['pesanan']))->row();
                        $nm_pesanan = $barang->nm_barang;
                        $harga = $barang->harga;
                        $qty = $item["qty"];
                        $link =  base_url("/assets/img/barang/" . $barang->image);
                        $image = '<img src="' . $link . '" width="20%" style="float: left; padding-right: 10px;">';
                    }
                    $items[] = '<li>' . $image . '<h6><b>' . $nm_pesanan . '</b><br> x' . $item['qty'] . '</h6></li><br><br><br>';
                    $totalsemua += $harga * $qty;
            ?>
                    <tr>
                        <td><?= $nm_pesanan ?></td>
                        <td>Rp. <?= number_format($harga, 0, ",", ".") ?></td>
                        <td><?= $qty ?></td>
                        <td>Rp. <?= number_format($harga * $qty, 0, ",", ".") ?></td>
                    </tr>
            <?php
                }
            }
            ?>
            <tr>
                <td colspan="3"><b>TOTAL</b></td>
                <td>Rp. <?= number_format($totalsemua, 0, ",", ".") ?></td>
            </tr>
        </table>
    </div>
</body>

</html>