<?php 
include '../proses/connect.php';
date_default_timezone_set("Asia/Bangkok");
?>
<div class="main-content-inner">
    <!-- market value area start -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h2>Daftar Pesanan</h2>
                    </div>
                    <div class="data-tables datatable-dark">
                        <table id="dataTable3" class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>ID Pesanan</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal Order</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $brgs = mysqli_query($conn, "SELECT * FROM pembelian_tiket c, pengguna l WHERE c.id_pengguna=l.id_pengguna ORDER BY id_pembelian_tiket DESC");
                                $no = 1;
                                while($p = mysqli_fetch_array($brgs)){
                                    $orderid = $p['orderid'];
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><strong><a href="index.php?page=pesanan&orderid=<?php echo $p['orderid'] ?>">#<?php echo $p['orderid'] ?></a></strong></td>
                                    <td><?php echo $p['username'] ?></td>
                                    <td><?php echo $p['tanggal_pembelian'] ?></td>
                                    <td>Rp<?php echo $p['total_harga'] ?></td>
                                    <td><?php echo $p['status']; ?></td>
                                </tr>		
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row area start -->
</div>
</div>
<!-- main content area end -->

<script>	
$(document).ready(function() {
    $('#dataTable3').DataTable({
        dom: 'Bfrtip',
        buttons: ['print']
    });
});
</script>
