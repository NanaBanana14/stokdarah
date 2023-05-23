<?php
require 'function.php';
require 'cek.php';
?>
<html>
<head>
    <!-- Framework Datatables -->
  <title>Export Data</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
			<h2>Data Darah Masuk</h2>
				<div class="data-tables datatable-dark">
					
					<!-- Masukkan table nya disini, dimulai dari tag TABLE -->
                    <table class="table table-bordered" id="exportmasuk" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Darah</th>
                                                <th>Jumlah</th>
                                                <th>Pendonor</th>
                                                
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
                                            </tr>
                                            <?php
                                            };

                                            ?>


                                        </tbody>
                                    </table>
</div>
	
<script>
$(document).ready(function() {
    $('#exportmasuk').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>