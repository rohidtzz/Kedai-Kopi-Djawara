<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,700;1,700&display=swap"
      rel="stylesheet"
    />
    <style>
        *{
            font-family: "Poppins", sans-serif;
        }
    </style> -->
</head>
<body>
    
    <form action="<?php echo base_url('order/store'); ?>" method="post">

        <div class="container mt-5">
            <?php

                $gets = isset($_GET['status']);
                if($gets){
                    
                    if($_GET['status'] == 'success'){
    
                        echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>";
                            echo "Pesanan Berhasil dipesan";
                            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo "</div>";
                    } else if($_GET['status'] == 'failed'){
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
                            echo "Pesanan gagal <br>";
                            if(isset($_GET['message'])){

                                echo str_replace('_',' ',$_GET['message']);
                            } else {
    
                            }
                            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                        echo "</div>";
                    }
                } else {

                }
            ?>
            
             
            <div class="row">
                <div style="margin-top:10px" class="col-sm-12 col-md-6">
                    <div class="card" >
                        <div style="background-color:#b6895b;" class="card-header text-white">Pesan Kopi</div>
                        <div class="card-body">
                            <select name="product" id="pro" class='form-control' required>
                                <!-- <option value="" selected></option> -->
								 <?php foreach($product as $row) : ?>
									<?php
									if($row['stock'] < 1){
										$disabled = 'disabled';
									} else {
										$disabled = '';
									}
									?>
									<option <?php echo $disabled ?> value="<?= $row['id'] ?>" data-id="<?= $row['price'] ?>"><?= $row['name'] ?> Rp. <?= number_format($row['price'],0,',','.') ?></option>
								<?php endforeach; ?>
                            </select>
                            <br>
                            <input type="number" name="unit" id="units" required class="form-control" placeholder="Masukan Berapa Yang ingin anda beli">
                            <br>
                            <h6 for="form">Total:</h6>
                            <input class="form-control" id="totals" name="total" type="text"  disabled>
                            
                        </div>
                    </div>
                </div>
                <div style="margin-top:10px" class="col-sm-12 col-md-6">
                    <div class="card" >
                        <div style="background-color:#b6895b;" class="card-header text-white">Data Pelanggan</div>
                        <div class="card-body">
                            <input value="<?php echo $this->session->userdata('name') ?>" name="name"  type="text" class="form-control" required placeholder="Masukan nama anda">
                            <br>
                            <input value="<?php echo $this->session->userdata('email') ?>" name="email"  type="email"  class="form-control" required placeholder="Masukan Email anda">
                            <br>
                            <input value="<?php echo $this->session->userdata('phone') ?>" name="phone"  type="number" class="form-control" required placeholder="Masukkan No hp Anda">
                        </div>
                    </div>
                </div>
                
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-2">
                    <div class="card">
                        <button onclick="return confirm('yakin ingin beli?')" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
            
    
        </div>
    </form>

                                    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#pro').on('change', function (e) {
                $('#units').val('')
                $('#totals').val('')
            });


            $("#units").on("keyup", function() {
                let jumlah = $('#pro').find(':selected').data('id') * $(this).val();
                console.log(jumlah);
                $('#totals').val(formatRupiah(jumlah));

                
            });

            function formatRupiah(angka){
                var number_string = angka.toString(),
                split   		= number_string.split(','),
                sisa     		= split[0].length % 3,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
    
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
    
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return 'Rp. '+rupiah;
		    }
        });

    </script>
</body>
</html>
