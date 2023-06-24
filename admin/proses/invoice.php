    <!DOCTYPE html>
    <html>
    <head>
        <title>Invoice</title>
        <style>
            /* Gaya CSS untuk tampilan invoice */
            body {
                font-family: Arial, sans-serif;
            }

            .card {
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 20px;
                margin-bottom: 20px;
            }

            .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        
        .invoice-box table tr.top table td {
            padding-bottom: 0px;
        }
        
        .invoice-box table tr.top table td.title {
            font-size: 35px;
            line-height: 0px;
            color: #333;
        }
        
        .invoice-box table tr.information table td {
            padding-bottom: 0px;
        }
        
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            text-align:center;
        }
        
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        
        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
            text-align:center;
        }
        
        .invoice-box table tr.item.last td {
            border-bottom: none;

        }
        
        .invoice-box table tr.total {
            border-top: 2px solid #eee;
            font-weight: bold;

        }
        
        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
        
        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }
        
        .rtl table {
            text-align: right;
        }
        
        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
        </style>
    </head>
    <body>
        <div class="card">
            <div class="invoice-header">
            </div>
            <?php
            if (isset($_GET['orderid'])) {
                $orderid = $_GET['orderid'];

                include "connect.php";
                date_default_timezone_set("Asia/Bangkok");

                $liatcust = mysqli_query($conn, "SELECT * FROM pengguna l, pembelian_tiket c WHERE orderid='$orderid' AND l.id_pengguna=c.id_pengguna");
                $checkdb = mysqli_fetch_assoc($liatcust);

                if ($checkdb) {
                    ?>
                    <div class="invoice-box">
                    <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="5">
                        <table>
                            <tr>
                                <td >
                                    <h1 style="font-weight: bold">KUDUS FC TICKET STADION</h1>
                                    Jl. Gor No.3, Wergu Wetan, Kabupaten Kudus 59318<br>
                                    www.kudusfc.com - kudusfc@gmail.com
                                </td>
                                
                                <td>
                                    Invoice : <b><?php echo $checkdb['orderid']; ?></b><br>
                                    Created : <b><?=date('M, d Y')?></b><br>
                                    Due : <b><?=date('M, d Y',strtotime($checkdb['tanggal_pembelian'])) ?></b>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                    <div class="invoice-info">
                    <tr class="information">
                    <td colspan="5">
                        <table>
                            <tr>
                                <td colspan="2">
                                    <font style="font-size: 16px; font-weight: bold">Informasi Pelanggan :</font><br>
                                    <font style="font-size: 16px;">
                                        Pelanggan : <?php echo $checkdb['nama_pengguna']; ?><br>
                                        No Hp : <?php echo $checkdb['no_hp']; ?><br>
                                        Email : <?php echo $checkdb['email_pengguna']; ?><br>
                                    </font>
                                    <br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>   
                    </div>
                    <table class="invoice-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tiket</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = mysqli_query($conn, "SELECT * FROM pembelian_tiket d, pertandingan p, tiket t WHERE orderid = '$orderid' 
                                            AND d.id_pertandingan = p.id_pertandingan AND d.id_tiket = t.id_tiket ORDER BY d.id_pertandingan ASC");
                            while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data["kompetisi"]; ?> MATCH ANTARA <?php echo $data["club_1"]; ?>
                                        vs <?php echo $data["club_2"]; ?><br></td>
                                        <td><?php echo $data["tanggal_pembelian"]; ?></td>
                                    <td><?php echo $data['jumlah_tiket']; ?></td>
                                    <td><?php echo "Rp " . number_format($data['harga'], 0, ',', '.'); ?></td>
                                    <td><?php echo "Rp " . number_format($data['total_harga'], 0, ',', '.'); ?></td>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <tr>
                    <div style="margin-top: 50px; text-align: right;">
                     <a target="_blank" href="cetak-invoice.php?orderid=<?= $orderid ?>" class="btn btn-success">Cetak Invoice</a>
                </div> 
                <font  style="margin-top: 40px;"><WWW.KUDUSFC.COM, <?=date('d/m/Y')?></font>
                <br><br><br><br>
                
            </tr>
                <?php
                } else {
                    echo "<p>Data pesanan tidak ditemukan.</p>";
                }
            } else {
                echo "<p>ID order tidak diberikan.</p>";
            }
            ?>
        </div>
    </body>
    </html>
