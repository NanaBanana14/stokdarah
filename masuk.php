<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Darah Masuk</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Stok Darah PMI</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>   
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stok Darah
                            </a>
                            <a class="nav-link" href="detailstokdarah.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Detail Stok Darah
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Data Darah Masuk
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Data Darah Keluar
                            </a>
                            <a class="nav-link" href="detaildarah.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Informasi Detail Darah
                            </a>
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Kelola Admin
                            </a>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">This website was created by:</div>
                        Pandas 2023
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Darah Masuk</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Data
                                </button>
                                <button type="button">
                                    <a href="exportmasuk.php" class="btn btn info ">Export Data</a>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Darah</th>
                                                <th>Jumlah</th>
                                                <th>Pendonor</th>
                                                <th>Aksi</th>
                                                
                                            </tr>
                                        </thead>
                                
                                        <tbody>
                                        <?php
                                            $ambilsemuadatastok = mysqli_query($conn, "select * from data_darah_masuk m, stok_darah s where s.id_stok = m.id_stok");
                                            while($data=mysqli_fetch_array($ambilsemuadatastok)){
                                                $idstok = $data['id_stok'];
                                                $idm = $data['idmasuk'];
                                                $tanggal = $data['tanggal'];
                                                $darah = $data['darah'];
                                                $qty = $data['qty'];
                                                $pendonor = $data['pendonor'];

                                            
                                            ?>
                                            <tr>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$darah;?></td>
                                                <td><?=$qty;?></td>
                                                <td><?=$pendonor;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idm;?>">
                                                        Edit
                                                    </button>
                                                    <input type="hidden" name="idstokyangmaudihapus" value="<?=$idstok;?>">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idm;?>">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                                <!-- Edit Modal (container nya-->
                                                <div class="modal fade" id="edit<?=$idm;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Tambah Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                            <input type="text" name="pendonor" value="<?=$pendonor;?>" placeholder="Pendonor" class="from-control" required><br>
                                                            <input type="number" name="qty" value="<?=$qty;?>" placeholder="Jumlah" class="from-control" required><br>
                                                            <input type="hidden" name="id_stok" value="<?=$idstok;?>" > 
                                                            <input type="hidden" name="idmasuk" value="<?=$idm;?>" > 
                                                            <button type="submit" class="btn btn-primary" name="updatedatamasuk">Edit</button>
                                                            </div>
                                                        </form>
                                                        
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                        
                                                    </div>
                                                    </div>
                                                </div>
                                            

                                                 <!-- Delete Modal -->
                                                 <div class="modal fade" id="delete<?=$idm;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus data <?=$darah;?> ?
                                                                <input type="hidden" name="id_stok" value="<?=$idstok;?>" >
                                                                <input type="hidden" name="kty" value="<?=$qty;?>" >
                                                                <input type="hidden" name="idmasuk" value="<?=$idm;?>" >
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-danger" name="hapusdatamasuk">Delete</button>
                                                                <br>
                                                            </div>
                                                        </form>
                                                        
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                        
                                                    </div>
                                                    </div>
                                                </div>
                                            <?php
                                            };

                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Pandas 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
        <!-- The Modal (container nya-->
        <div class="modal fade" id="myModal">
        <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Tambah Data Masuk</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <select name="darahnya" class="form-control">
                        <?php
                            $ambilsemuadatanya = mysqli_query($conn, "select * from stok_darah");
                            while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                                $namadarahnya = $fetcharray['darah'];
                                $iddarahnya = $fetcharray ['id_stok'];
                        ?>
                        <option value="<?=$iddarahnya;?>"><?=$namadarahnya;?></option>
                        <?php
                            }
                        ?>
                    </select>
                <input type="number" name="qty" placeholder="Quantity" class="from-control" required><br>
                <input type="text" name="pendonor" placeholder="pendonor" class="from-control" required><br>
                <button type="submit" class="btn btn-primary" name="datamasuk">Submit</button>
                </div>
            </form>
            
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
        </div>
        </div>
    </div>
</html>
