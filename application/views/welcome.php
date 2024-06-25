<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kedai Kopi Djawara</title>
    <!-- fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/welcome/css/style.css') ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,700;1,700&display=swap"
      rel="stylesheet"
    />
		<link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/logo-kedai.png') ?>">
    <!-- feather icons -->

    <script src="https://unpkg.com/feather-icons"></script>
    

    <!-- my sytle -->

  </head>
  <body>
    <!-- navbar start -->
    <nav class="navbar">
      <a href="#" class="navbar-logo">Kopi<span> Djawara</span>.</a>
      <div class="navbar-nav">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menu">Menu</a>
        <a href="#contact">Kontak</a>
        <!-- <a href="history/">Cek Pesanan</a> -->
      </div>
      <div class="navbar-extra">
        <!-- <a href="#" id="search"><i data-feather="search"></i></a> -->
        <!-- <a href="#" id="shopping-cart"><i data-feather="shopping-cart"></i></a> -->
        <!-- <a href="/order" >Pesan</a> -->
        <a href="<?php echo base_url('auth/') ?>" >Login</a>
        <!-- <a href="history/" >Cek pesanan</a> -->
      </div>
    </nav>
    <!-- navbar end -->

    <!-- Hero Section Start -->

    <section class="hero" id="home">
      <main class="content">
        <h1>Mari Nikmati Secangkir<span> Kopi</span></h1>
        <p>
          Membingkai pagi mewarnakan mentari, jangan lupa menyorekan hari dengan
          segelas kopi berbagi, agar hati menjadi pelangi di malam nanti.
        </p>
        <a href="order/" class="cta">Beli Sekarang</a>
        <!-- <form action="/order">
          <button class="cta">Beli Sekarang</button>
        </form> -->
      </main> 
    </section>
    <!-- Hero Section End -->

    <!-- About Section Start -->
    <section id="about" class="about">
      <h2><span>Tentang</span> Kami</h2>
      <div class="row">
        <div class="about-img">
          <img src="<?= base_url('assets/welcome/img/about-bg.jpg') ?>" alt="Tentang Kami" />
        </div>
        <div class="content">
          <h3>Kenapa Memilih Kopi Kami?</h3>
          <p style="text-align:justify">
            Kopi Djawara Kopi berkualitas Hasil Seni tangan petani Kopi
            Indonesia menghasilkan kopi authentic.
          </p>
          <p style="text-align:justify">
            Di Kedai Kopi Kami, kami memahami bahwa kopi bukan hanya minuman,
            tetapi juga sebuah seni. Kami berkomitmen untuk memberikan
            pengalaman kopi yang tak tertandingi kepada pelanggan kami. Dengan
            tekun, kami menggali rahasia di balik setiap biji kopi, dari proses
            panen hingga secangkir kopi yang sempurna.
          </p>
          <p style="text-align:justify"> 
            Kami percaya pada kualitas tanpa kompromi, keberlanjutan, dan
            komunitas. Kehadiran kami di dunia kopi bukan hanya tentang
            menciptakan rasa yang luar biasa, tetapi juga tentang membentuk
            hubungan dengan para petani kopi, berkontribusi pada lingkungan, dan
            membangun kedai yang menjadi tempat berkumpul yang nyaman bagi semua
            pecinta kopi.
          </p>
        </div>
      </div>
    </section>
    <!-- About Section End -->

    <!-- Menu Section Start -->
    <section id="menu" class="menu">
      <h2><span>Menu</span> Kami</h2>
      <p>
        Kami Menyediakan kopi terbaik untuk anda, dengan harga yang terjangkau
      </p>
      <div class="row">
		<?php
			foreach($product as $item){
				$price = number_format($item['price'],0,',','.');
		?>

		<div class="menu-card">
			<a style="text-decoration:none;" href="<?= base_url('/order') ?>">
				<img src="assets/<?php echo $item['img'] ?>" style='border-radius:10px;' alt="Cappucino" class="menu-card-img" />
			</a>
			<h3 class="menu-card-title"><?php echo $item['name'] ?></h3>
			<p class="menu-card-price">Rp. <?php echo $price ?></p>
			<?php
				if($item['stock'] < 1){
					echo "<p class='menu-card-price'>Habis</p>";
				} else {

					echo "<p class='menu-card-price'>Stock: {$item['stock']}</p>";
				}
			?>
		</div>

		<?php
			}
		?>
		
      </div>
    </section>
    <!-- Menu Section End -->

    <!-- Contact Section Start -->
    <section id="contact" class="contact">
      <h2><span>Kontak</span> Kami</h2>
      <p>
        silahkan hubgunki kami jika ada yang ingin ditanyakan
      </p>
      <div class="row">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63301.06345446958!2d109.19322357052866!3d-7.43018888781829!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655c3136423d1d%3A0x4027a76e352e4a0!2sPurwokerto%2C%20Kabupaten%20Banyumas%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1698823430158!5m2!1sid!2sid"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          class="map"
        ></iframe>
        <form action="mail/index.php" method="post">
          <div class="input-group">
            <i data-feather="user"></i>
            <input name="name" type="text" placeholder="masukan nama..." />
          </div>
          <div class="input-group">
            <i data-feather="mail"></i>
            <input name="email" type="email" placeholder="masukan email..." />
          </div>
          <div class="input-group">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M3 18L15 6l3 3L6 21H3zM16 5l2-2l3 3l-2.001 2.001z"/></svg>
            <input name="pesan" type="text" placeholder="pesan..." />
          </div>
          <button type="submit" class="btn">Kirim Pesan</button>
        </form>
      </div>
    </section>
    <!-- Contact Section End -->

    <!-- Footer Start -->
    <footer>
      <div class="social">
        <a href="https://instagram.com/rohidtzz"><i data-feather="instagram"></i></a>
        <a href=""><i data-feather="twitter"></i></a>
        <a href="#"><i data-feather="facebook"></i></a>
      </div>
      <div class="links">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#menu">Menu</a>
        <a href="#contact">Kontak</a>
      </div>
      <div class="credit">
        <p>Created by <a href="">Hidzz | Rey | Bay | Rev | Put</a>. | &copy;2024</p>
      </div>
    </footer>
    <!-- Footer End -->

    <!-- feather icons -->
    <script>
      feather.replace();
    </script>
    <!-- my javascript -->
    <!-- <script src="assets/js/script.js"></script> -->
  </body>
</html>
