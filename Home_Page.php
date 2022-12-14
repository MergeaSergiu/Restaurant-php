
<?php
session_start();
?>
<?php
include('top.php');
?>
<!DOCTYPE html>
<html>
<head>

  <title>Home Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <style>
            body{
                background: #f1f5d3;
            }
        </style>
</head>
<body >
  <div class="container">
<div class="container-fluid width">
        <div class="row">
            <div class="col-lg-12">
                <?php include('Navbar.php'); ?>
            </div>  
            </div>
</div>
  </div>
  <br>
  <br>
<div class="container">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="./imagini/poza1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./imagini/poza2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./imagini/poza3.jpg" alt="Third slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./imagini/poza4.jpg" alt="Fourth slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./imagini/poza5.jpg" alt="Fifth slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
<br>
<br>
<div class="container-2">
<button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Locatia Noastra" data-content="Resita, Str.Fara Nume, nr.10">Locatia Noastra</button>
<button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Programul Nostru" data-content="Luni- Duminica: 10-23">Orarul Nostru</button>
</div>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>

<style>
  .container-2{
    position:absolute;
    right:42%;
  }
  </style>
  
</body>
</html>