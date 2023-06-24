

    <div class="container">
        <h2>Tambah Pertandingan</h2>

        <form action="proses/tambah-pertandingan.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Tanggal Pertandingan</label>
                <input type="date" class="form-control" name="tanggal" required>
            </div>
            <div class="form-group">
                <label>Tempat Pertandingan</label>
                <input type="text" class="form-control" name="tempat" required>
            </div>
            <div class="form-group">
                <label>Club 1</label>
                <input type="text" class="form-control" name="club1" required>
            </div>
            <div class="form-group">
                <label>Club 2</label>
                <input type="text" class="form-control" name="club2" required>
            </div>
            <div class="form-group">
                <label>Gambar Pertandingan</label>
                <input type="file" class="form-control-file" name="gambar" required>
            </div>
            <div class="form-group">
                <label>Waktu (Format: Jam)</label>
                <input type="text" class="form-control" name="waktu" required>
            </div>
            <div class="form-group">
                <label>Kompetisi</label>
                <select class="form-control" name="kompetisi" required>
                    <option value="PIALA NASIONAL 2023">PIALA NASIONAL 2023</option>
                    <option value="LIGA NASIONAL 2023">LIGA NASIONAL 2023</option>
                </select>
            </div>
            <div class="form-group">
                <label>Kota</label>
                <input type="text" class="form-control" name="kota" required>
            </div>
            <div class="form-group">
                <label>Provinsi</label>
                <input type="text" class="form-control" name="provinsi" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="index.php?page=kelola-pertandingan" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

