<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Data Buku
            <small>
                <script type='text/javascript'>
                    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                        'Oktober', 'November', 'Desember'
                    ];
                    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                    var date = new Date();
                    var day = date.getDate();
                    var month = date.getMonth();
                    var thisDay = date.getDay(),
                        thisDay = myDays[thisDay];
                    var yy = date.getYear();
                    var year = (yy < 1000) ? yy + 1900 : yy;
                    document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                    //
                </script>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Data Buku</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Data Buku
                        </h3>
                        <div class="form-group m-b-2 text-right" style="margin-top: -20px; margin-bottom: -5px;">
                            <button type="button" onclick="tambahBuku()" class="btn btn-info"><i class="fa fa-plus"></i>
                                Tambah Buku</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>ISBN</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Buku Baik</th>
                                    <th>Buku Rusak</th>
                                    <th>Jumlah Buku</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "../../config/koneksi.php";

                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM buku");
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['judul_buku']; ?></td>
                                        <td><?= $row['isbn']; ?></td>
                                        <td><?= $row['pengarang']; ?></td>
                                        <td><?= $row['penerbit_buku']; ?></td>
                                        <td><?= $row['j_buku_baik']; ?></td>
                                        <td><?= $row['j_buku_rusak']; ?></td>
                                        <td><?php
                                            $j_buku_rusak = $row['j_buku_rusak'];
                                            $j_buku_baik = $row['j_buku_baik'];

                                            echo $j_buku_rusak + $j_buku_baik;
                                            ?></td>
                                        <td>
                                            <a href="#" data-target="#modalEditBuku<?= $row['id_buku']; ?>" data-toggle="modal" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="pages/function/Buku.php?act=hapus&id=<?= $row['id_buku']; ?>" class="btn btn-danger btn-sm btn-del"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="modalEditBuku<?= $row['id_buku']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content" style="border-radius: 5px;">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
                                                        Edit Buku ( <?= $row['judul_buku']; ?> - <?= $row['pengarang']; ?> )
                                                    </h4>
                                                </div>
                                                <form action="pages/function/Buku.php?act=edit" enctype="multipart/form-data" method="POST">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_buku" value="<?= $row['id_buku']; ?>">
                                                        <div class="form-group">
                                                            <label>Judul Buku <small style="color: red;">* Wajib
                                                                    diisi</small></label>
                                                            <input type="text" class="form-control" value="<?= $row['judul_buku']; ?>" name="judulBuku">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kategori Buku <small style="color: red;">* Wajib
                                                                    diisi</small></label>
                                                            <select class="form-control" name="kategoriBuku">
                                                                <option selected value="<?= $row['kategori_buku']; ?>">
                                                                    <?= $row['kategori_buku']; ?> ( Dipilih Sebelumnya )
                                                                </option>
                                                                <?php
                                                                include "../../config/koneksi.php";

                                                                $sql = mysqli_query($koneksi, "SELECT * FROM kategori");
                                                                while ($data = mysqli_fetch_array($sql)) {
                                                                ?>
                                                                    <option value="<?= $data['nama_kategori']; ?>">
                                                                        <?= $data['nama_kategori']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Penerbit Buku <small style="color: red;">* Wajib
                                                                    diisi</small></label>
                                                            <select class="form-control select2" name="penerbitBuku">
                                                                <option selected value="<?= $row['penerbit_buku']; ?>">
                                                                    <?= $row['penerbit_buku']; ?> ( Dipilih Sebelumnya )
                                                                </option>
                                                                <?php
                                                                include "../../config/koneksi.php";

                                                                $sql = mysqli_query($koneksi, "SELECT * FROM penerbit");
                                                                while ($data = mysqli_fetch_array($sql)) {
                                                                ?>
                                                                    <option value="<?= $data['nama_penerbit']; ?>">
                                                                        <?= $data['nama_penerbit']; ?> (
                                                                        <?= $data['verif_penerbit']; ?> )</option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Pengarang <small style="color: red;">* Wajib
                                                                    diisi</small></label>
                                                            <input type="text" class="form-control" value="<?= $row['pengarang']; ?>" name="pengarang" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tahun Terbit <small style="color: red;">* Wajib
                                                                    diisi</small></label>
                                                            <input type="number" min="2000" max="2100" class="form-control" value="<?= $row['tahun_terbit']; ?>" name="tahunTerbit" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>ISBN <small style="color: red;">* Wajib
                                                                    diisi</small></label>
                                                            <input type="number" class="form-control" value="<?= $row['isbn']; ?>" name="iSbn" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jumlah Buku Baik <small style="color: red;">* Wajib
                                                                    diisi</small></label>
                                                            <input type="number" class="form-control" value="<?= $row['j_buku_baik']; ?>" name="jumlahBukuBaik" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jumlah Buku Rusak <small style="color: red;">* Wajib
                                                                    diisi</small></label>
                                                            <input type="number" class="form-control" value="<?= $row['j_buku_rusak']; ?>" name="jumlahBukuRusak" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /. Modal Edit -->
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>




                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                                <div>
                                    <!-- Dropdown menu -->
                                    <div id="dropdownAction" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-lg text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reward</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Promote</a>
                                            </li>
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activate
                                                    account</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                                                User</a>
                                        </div>
                                    </div>
                                </div>
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="table-search-users" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">
                                </div>
                            </div>
                            <table class="w-full text-lg text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            No
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Judul Buku
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            ISBN
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            PENGARANG
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            PENERBIT
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            BUKU BAIK
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            BUKU RUSAK
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            JUMLAH BUKU
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            AKSI
                                        </th>
                                    </tr>
                                </thead>



                                <?php
                                include "../../config/koneksi.php";

                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM buku");
                                while ($row = mysqli_fetch_assoc($query)) {
                                ?>

                                    <tbody>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="checkbox-table-search-1" class="sr-only">Online</label>
                                                </div>
                                            </td>
                                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                <img class="w-10 h-10 rounded-full" src="https://mediaasuransinews.co.id/wp-content/uploads/2022/01/Andre-Taulany.jpg" alt="Jese image">
                                                <div class="ps-3">
                                                    <div class="text-xl font-semibold"><?= $row['judul_buku']; ?></div>
                                                    <div class="font-normal text-gray-500">neil.sims@flowbite.com</div>
                                                </div>
                                            </th>
                                            <td class="px-6 py-4">
                                                <?= $row['isbn']; ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="modalTambahBuku">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Tambah Buku
                </h4>
            </div>
            <form action="pages/function/Buku.php?act=tambah" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul Buku <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Judul Buku" name="judulBuku">
                    </div>
                    <div class="form-group">
                        <label>Kategori Buku <small style="color: red;">* Wajib diisi</small></label>
                        <select class="form-control" name="kategoriBuku">
                            <option selected>-- Harap pilih kategori buku --</option>
                            <?php
                            include "../../config/koneksi.php";

                            $sql = mysqli_query($koneksi, "SELECT * FROM kategori");
                            while ($data = mysqli_fetch_array($sql)) {
                            ?>
                                <option value="<?= $data['nama_kategori']; ?>"> <?= $data['nama_kategori']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Penerbit Buku <small style="color: red;">* Wajib diisi</small></label>
                        <select class="form-control select2" name="penerbitBuku">
                            <option selected disabled>-- Harap Pilih Penerbit Buku --</option>
                            <?php
                            include "../../config/koneksi.php";

                            $sql = mysqli_query($koneksi, "SELECT * FROM penerbit");
                            while ($data = mysqli_fetch_array($sql)) {
                            ?>
                                <option value="<?= $data['nama_penerbit']; ?>"><?= $data['nama_penerbit']; ?> (
                                    <?= $data['verif_penerbit']; ?> )</option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pengarang <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Nama Pengarang" name="pengarang" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Terbit <small style="color: red;">* Wajib diisi</small></label>
                        <input type="number" min="2000" max="2100" class="form-control" placeholder="Masukan Tahun Terbit ( Contoh : 2003 )" name="tahunTerbit" required>
                    </div>
                    <div class="form-group">
                        <label>ISBN <small style="color: red;">* Wajib diisi</small></label>
                        <input type="number" class="form-control" placeholder="Masukan ISBN" name="iSbn" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Buku Baik <small style="color: red;">* Wajib diisi</small></label>
                        <input type="number" class="form-control" placeholder="Masukan Jumlah Buku Baik" name="jumlahBukuBaik" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Buku Rusak <small style="color: red;">* Wajib diisi</small></label>
                        <input type="number" class="form-control" placeholder="Masukan Jumlah Buku Rusak" name="jumlahBukuRusak" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>

    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    function tambahBuku() {
        $('#modalTambahBuku').modal('show');
    }
</script>
<!-- jQuery 3 -->
<script src="../../assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../assets/dist/js/sweetalert.min.js"></script>
<!-- Pesan Berhasil Edit -->
<script>
    <?php
    if (isset($_SESSION['berhasil']) && $_SESSION['berhasil'] <> '') {
        echo "swal({
            icon: 'success',
            title: 'Berhasil',
            text: '$_SESSION[berhasil]'
        })";
    }
    $_SESSION['berhasil'] = '';
    ?>
</script>
<!-- Notif Gagal -->
<script>
    <?php
    if (isset($_SESSION['gagal']) && $_SESSION['gagal'] <> '') {
        echo "swal({
                icon: 'error',
                title: 'Gagal',
                text: '$_SESSION[gagal]'
              })";
    }
    $_SESSION['gagal'] = '';
    ?>
</script>
<!-- Swal Hapus Data -->
<script>
    $('.btn-del').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        swal({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Apakah anda yakin ingin menghapus data buku ini ?',
                buttons: true,
                dangerMode: true,
                buttons: ['Tidak, Batalkan !', 'Iya, Hapus']
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.location.href = href;
                } else {
                    swal({
                        icon: 'error',
                        title: 'Dibatalkan',
                        text: 'Data buku tersebut aman !'
                    })
                }
            });
    })
</script>