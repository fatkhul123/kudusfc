<?php 

	include "proses/connect.php";

?>

            <div class="main-content-inner">
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header"><h3>Laporan Penjualan</h3></div>
                            <form method="post"  action="proses/cetak-laporan.php" target="_blank">
                            <div class="card-body ">
                                <div class="row">
                                     <div class="col-md-8">
                                        <div class="form-group">
                                            <select name="bulan"  class="form-control" required="">
                                                <option selected="" disabled="">--Pilih Bulan--</option>
                                                <?php $bln = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                                $no = 1;
                                                for ($i=0; $i < 12 ; $i++) { ?>
                                                    <option value="<?=$no++?>"><?=$bln[$i]?></option>
                                                <?php } ?>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" name="submit" class="btn btn-primary">Export</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
	
	<script>
	
	$(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
	} );
	</script>
	
