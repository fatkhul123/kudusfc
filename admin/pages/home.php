<?php 

include '../proses/connect.php';
if (isset($_SESSION['username'])) {
    // The "username" key is set, you can use it in your code
    $username = $_SESSION['username'];
}   
$itungcust = mysqli_query($conn, "SELECT COUNT(id_pengguna) AS jumlahcust FROM pengguna WHERE role_pengguna='user'");
if ($itungcust === false) {
    echo "Error executing query: " . mysqli_error($conn);
    // Handle the error appropriately, such as logging or displaying an error message
} else {
    $itungcust2 = mysqli_fetch_assoc($itungcust);
    $itungcust3 = $itungcust2['jumlahcust'];
}

$itungorder = mysqli_query($conn, "SELECT count(id_pembelian_tiket) as jumlahorder from pembelian_tiket where status not like 'Selesai' and status not like 'Canceled'");
if ($itungorder === false) {
    echo "Error executing query: " . mysqli_error($conn);
    // Handle the error appropriately, such as logging or displaying an error message
} else {
    $itungorder2 = mysqli_fetch_assoc($itungorder);
    $itungorder3 = $itungorder2['jumlahorder'];
}

$itungtrans = mysqli_query($conn, "SELECT count(orderid) as jumlahtrans from pembelian_tiket where status not like 'Canceled'and status not like 'waiting'");
if ($itungtrans === false) {
    echo "Error executing query: " . mysqli_error($conn);
    // Handle the error appropriately, such as logging or displaying an error message
} else {
    $itungtrans2 = mysqli_fetch_assoc($itungtrans);
    $itungtrans3 = $itungtrans2['jumlahtrans'];
}	


// Check if the "username" key is set in the $_SESSION array
if (isset($_SESSION['username'])) {
    // The "username" key is set, you can use it in your code
    $username = $_SESSION['username'];
} else {
    // The "username" key is not set, handle the error or redirect the user
    echo "Username not found in session.";
    // or redirect the user to a login page
    // header("Location: login.php");
    // exit();
}

?>	
            
<!-- page title area end -->
<div class="main-content-inner">
    <div class="sales-report-area mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-user"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0">Pelanggan</h4>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h1><?php echo $itungcust3 ?></h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="single-report">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-book"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0">Pesanan</h4>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h1><?php echo $itungorder3 ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-link"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0">Konfirmasi Pembayaran</h4>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h1><?php echo $itungtrans3 ?></h1>
                        </div>
                        <!--
                        <button type="button" class="<?php 
                        if($itungtrans3==0){
                            echo 'btn btn-secondary btn-block';
                        } else {
                            echo 'btn btn-primary btn-block';
                        }
                        ?>
                        ">Lihat Transaksi</button>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- overview area end -->
    <!-- market value area start -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h2>Selamat Datang</h2>
                    </div>
                    <div class="market-status-table mt-4">
                        Anda masuk sebagai <strong><?php echo $_SESSION['username']; ?></strong>
                        <br>
                        <p>Pada halaman admin, Anda dapat mengelola tiket, mengelola tiket, 
                            mengelola user dan admin, melihat konfirmasi pembayaran</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- row area start-->
</div>
</div>
