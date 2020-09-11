<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Comp atible" content="ie=edge">
    <title>Detai Pesanan [<?= $n_struk ?>]</title>
</head>

<body>
    <style>
        @page {
            size: 58mm 100mm
        }
    </style>

    <style>
        * {
            font-size: 12px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        td.quantity,
        th.quantity {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 240px;
            max-width: 240px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
    <div class="ticket">
        <center>
            <img src="<?= base_url('assets/img/' . $this->properti->identitas('logo')) ?>" alt="Logo" style="height: 40px; width:40px;">
        </center>
        <p class="centered">No Struk <?= $render->row()->no_penjualan ?>
            <br><?= $this->properti->identitas('alamat_lengkap') ?>
            <table>
                <thead>
                    <tr>
                        <th class="quantity">Qty</th>
                        <th class="description">Description</th>
                        <th class="price">Harga</th>
                        <th class="description">Disc</th>
                        <th class="price">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $r_tot = 0;
                    foreach ($render->result_array() as $ls) {
                        $total += $ls['hargabeli'];
                        //get total disc
                        $allcount = (int)$ls['hargabeli'] * (int) $ls['jumlah'];
                        $disc     = ((int)$ls['diskon'] / (int)100) * $allcount;
                        $hasil    = (int)$allcount - $disc;
                        $r_tot    += $hasil;

                    ?>
                        <tr>
                            <td class="quantity"><?= $ls['jumlah'] ?></td>
                            <td class="description"><?= $ls['nm_barang'] ?></td>
                            <td class="description"><?= number_format((int)$ls['hargabeli'], 0, 0, '.') ?></td>
                            <td class="diskon">0.<?= $ls['diskon'] ?></td>
                            <td class="price"><?= number_format($hasil, 0, 0, '.') ?></td>
                        </tr>
                    <?php  } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: right;">Total</td>
                        <td colspan="3"><?= number_format($r_tot, 0, 0, '.') ?></td>
                    </tr>
                </tfoot>
            </table>
            <p class="centered">Terima Kasih Telah berbelanja</p>
    </div>
    <button id="btnPrint" class="hidden-print">Print</button>
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>
</body>

</html>