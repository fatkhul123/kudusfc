<?php
require('../assets/fpdf/fpdf.php');
include "connect.php";

// Extend class FPDF untuk membuat kelas PDF kustom
class InvoicePDF extends FPDF {
    // Fungsi untuk menghasilkan halaman PDF
    function generateInvoice($orderid, $conn) {
        // Membuat halaman baru
        $this->AddPage();

        // Mengatur font dan ukuran teks
        $this->SetFont('Arial', '', 12);

        // Judul
        $this->Cell(0, 10, 'KUDUS FC TICKET STADION', 0, 1, 'C');
        $this->Ln(5);

        // Informasi invoice
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'Invoice: ' . $orderid, 0, 1, 'R');
        $this->Cell(0, 10, 'Created: ' . date('M, d Y'), 0, 1, 'R');

        // Execute the query
        $query = "SELECT * FROM pengguna l, pembelian_tiket c WHERE orderid='" . mysqli_real_escape_string($conn, $orderid) . "' AND l.id_pengguna=c.id_pengguna";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
            $checkdb = mysqli_fetch_assoc($result);

            // Check if the order was found
            if ($checkdb) {
                $this->Cell(0, 10, 'Due: ' . date('M, d Y', strtotime($checkdb['tanggal_pembelian'])), 0, 1, 'R');
                $this->Ln(10);

                // Informasi pelanggan
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(0, 10, 'Informasi Pelanggan:', 0, 1);
                $this->SetFont('Arial', '', 12);
                $this->Cell(0, 10, 'Pelanggan: ' . $checkdb['nama_pengguna'], 0, 1);
                $this->Cell(0, 10, 'No Hp: ' . $checkdb['no_hp'], 0, 1);
                $this->Cell(0, 10, 'Email: ' . $checkdb['email_pengguna'], 0, 1);
                $this->Ln(10);

                // Tabel daftar tiket
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(20, 10, 'No', 1, 0, 'C');
                $this->Cell(80, 10, 'Tiket', 1, 0, 'C');
                $this->Cell(30, 10, 'Tanggal Pertandingan', 1, 0, 'C');
                $this->Cell(30, 10, 'Jumlah', 1, 0, 'C');
                $this->Cell(30, 10, 'Harga', 1, 0, 'C');
                $this->Cell(50, 10, 'Total Harga', 1, 1, 'C');

                $this->SetFont('Arial', '', 12);
                $no = 1;
                $total = 0;

                $query = "SELECT * FROM pembelian_tiket d, pertandingan p, tiket t WHERE orderid = '$orderid' 
                            AND d.id_pertandingan = p.id_pertandingan AND d.id_tiket = t.id_tiket ORDER BY d.id_pertandingan ASC";
                    $result = mysqli_query($conn, $query);


                while ($data = mysqli_fetch_assoc($result)) {
                    $this->Cell(20, 10, $no++, 1, 0, 'C');
                    $this->Cell(80, 10, $data["kompetisi"] . ' MATCH ANTARA ' . $data["club_1"] . ' vs ' . $data["club_2"], 1, 0);
                    $this->Cell(30, 10, $data['tanggal_pertandingan'], 1, 0, 'C');
                    $this->Cell(30, 10, $data['jumlah_tiket'], 1, 0, 'C');
                    $this->Cell(30, 10, 'Rp ' . number_format($data['harga'], 0, ',', '.'), 1, 0, 'R');
                    $this->Cell(50, 10, 'Rp ' . number_format($data['total_harga'], 0, ',', '.'), 1, 1, 'R');

                    $total += $data['total_harga'];
                }
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(160, 10, 'Total', 1, 0, 'R');
                $this->Cell(50, 10, 'Rp ' . number_format($total, 0, ',', '.'), 1, 1, 'R');

                // Menutup koneksi database
                mysqli_close($conn);

                // Menyimpan file PDF
                $this->Output('invoice.pdf', 'D');
            } else {
                echo "Pesanan tidak ditemukan.";
            }
        } else {
            echo "Query error: " . mysqli_error($conn);
        }
    }
}

// Membuat instance kelas PDF
$pdf = new InvoicePDF();

// Memanggil fungsi generateInvoice dengan orderid yang diperoleh dari URL
if (isset($_GET['orderid'])) {
    $orderid = $_GET['orderid'];
    $pdf->generateInvoice($orderid, $conn);
} else {
    echo "ID order tidak diberikan.";
}
?>
