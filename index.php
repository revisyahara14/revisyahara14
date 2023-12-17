<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang */
        }

        .container {
            margin-top: 20px; /* Jarak dari atas */
        }

        .navbar {
            background-color: #343a40; /* Warna navbar */
        }

        .navbar-brand {
            color: #ffffff !important; /* Warna teks navbar brand */
        }

        h4 {
            color: #007bff; /* Warna teks judul */
        }

        table {
            background-color: #ffffff; /* Warna latar belakang tabel */
        }

        th, td {
            text-align: center; /* Pusatkan teks di kolom tabel */
        }

        .btn {
            margin-right: 5px; /* Jarak antar tombol */
        }
    </style>
    <title>Revi Syahara</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">REVI SYAHARA WEBSITE</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>DAFTAR PESERTA PELATIHAN</center></h4>

        <?php
        // Sertakan file koneksi.php
        include "koneksi.php";

        // Cek apakah ada kiriman form dari method post
        if (isset($_GET['id_peserta'])) {
            // Konversi ke integer untuk keamanan
            $id_peserta = intval($_GET["id_peserta"]);

            // Gunakan prepared statement untuk mencegah SQL injection
            $sql = "DELETE FROM peserta WHERE id_peserta = ?";
            $stmt = mysqli_prepare($kon, $sql);

            // Bind parameter
            mysqli_stmt_bind_param($stmt, "i", $id_peserta);

            // Execute statement
            $hasil = mysqli_stmt_execute($stmt);

            // Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location: index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
            }

            // Tutup statement
            mysqli_stmt_close($stmt);
        }
        ?>

        <table class="my-3 table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Sekolah</th>
                    <th>Jurusan</th>
                    <th>No Hp</th>
                    <th>Alamat</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Pastikan variabel $kon telah didefinisikan dengan benar di koneksi.php
                $sql = "SELECT * FROM peserta ORDER BY id_peserta DESC";

                $hasil = mysqli_query($kon, $sql);
                $no = 0;
                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data["nama"]; ?></td>
                        <td><?php echo $data["sekolah"]; ?></td>
                        <td><?php echo $data["jurusan"]; ?></td>
                        <td><?php echo $data["no_hp"]; ?></td>
                        <td><?php echo $data["alamat"]; ?></td>
                        <td>
                            <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-warning" role="button">Update</a>
                            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id_peserta=<?php echo $data['id_peserta']; ?>" class="btn btn-danger" role="button" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
    </div>
</body>

</html>
