<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <style>
    .top-banner-container {
      padding-top: 70px;
    }
  </style>
  <div class="top-banner-container">
    <div id="demo" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
      </ul>
      <!-- The slideshow -->
      <div class="carousel-inner">

        <div class="carousel-item active">
          <img src="banner/banner3.png" width="100%" height="625px">
        </div>
        <div class="carousel-item">
          <img src="banner/banner2.png" width="100%" height="625px">
        </div>
        <div class="carousel-item">
          <img src="banner/banner1.png" width="100%" height="625px">
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev"></a>
        <a class="carousel-control-next" href="#demo" data-slide="next"></a>
      </div>
    </div>
  </div>
</body>

</html>