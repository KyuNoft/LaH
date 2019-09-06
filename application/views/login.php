<html>

<head>
  <title>Look at Hijab</title>
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('AP3/'); ?>assets/images/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="<?php echo base_url('AP3/Login/'); ?>css/style.css">
  <link rel="stylesheet" href="<?php echo base_url('AP3/Login/'); ?>scss/style.scss">
  <style type="text/css">
    body {
      background-image: url(http://images1.fanpop.com/images/image_uploads/Golden-Gate-Bridge-san-francisco-1020074_1024_768.jpg);
    }
  </style>
</head>

<?php if(isset($gagal)){
  echo "<body onload='salah()'>";
}else{
  echo "<body>";
} ?>

  <div class="wrapper">
    <form class="login" method="POST" action="<?php echo site_url('Login/Cek'); ?>">
      <p class="title">Login</p>
      <input type="text" name="username" placeholder="Username" autofocus/>
      <input type="password" name="password" placeholder="Password" />

      <button><i class="spinner"></i><span class="state">Login</span></button>
    </form>

    <footer><a target="blank">Look at Hijab</a></footer>
  </div>

  <script  src="<?php echo base_url('AP3/Login/'); ?>js/index.js"></script>

</body>
</html>

<script>
  function salah(){
    alert("Username atau Password salah");
  }
</script>