<?php
$city=$temp=$feels_like=$pressure=$mintemp=$maxtemp=$visibility=$wind=$humidity=$desc=$maind="";
if(isset($_GET['submit'])){
$city=$_GET['city'];

$jsonfile = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&appid=ca8c6ec76045f8382dcf193fd7b48718");



$jsondata = json_decode($jsonfile);
$temp = $jsondata->main->temp;
$feels_like = $jsondata->main->feels_like;
//pressure in hPa
$pressure = $jsondata->main->pressure;
$mintemp = $jsondata->main->temp_min;
$maxtemp = $jsondata->main->temp_max;
$visibility= $jsondata->visibility;
//wind speed in m/s
$wind = $jsondata->wind->speed;
//humidity in percentages
$humidity = $jsondata->main->humidity;
$desc = $jsondata->weather[0]->description;
$maind = $jsondata->weather[0]->main;

// echo $temp."";
// echo "<br>";
// echo $feels_like;
// echo "<br>";
// echo $pressure;
// echo "<br>";
// echo $mintemp;
// echo "<br>";
// echo $maxtemp;
// echo "<br>";
// echo $desc;
// echo "<br>";
// echo $maind;

// echo "<pre>";
// print_r($jsondata);
// echo "<pre>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
      crossorigin="anonymous"
    />
  </head>
  <style>
    .bg{
      background-image: url('weather_image.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      height: 100vh;
      overflow: hidden;
      position: relative;
      color: white;
    }
    .overlay{
      height: 100vh;
      background-color: rgba(0,0,0,0.5);
    }
    .container{
      background-color:rgba(0,0,0,0.3);
      backdrop-filter: blur(20px);
      
    }
    .card{
      background-color: transparent;
    }
  </style>

  <body >
    <div class="bg">
  
    <div class="overlay">
    
    <div class="container col-xs-10 col-md-6 col-lg-4 mt-4">
      <h1 class="">Weather</h1>
      <form action="" method="GET" class="mb-3 align-items-center">
        <div class="mb-3">
          <label for="" class="form-label">City</label>
          <input
            type="text"
            name="city"
            id="city"
            class="form-control"
            placeholder=""
            aria-describedby="helpId"
          />
          <small id="helpId" class="text-muted">Help text</small>
        </div>

        <input type="submit" name="submit" class="btn btn-primary" />
      </form>

      <div class="card ">
        
        <div class="card-body row ">
          <h4 class="card-title text-center">Temperature in <?php echo $city?></h4>
          <div class="col-8 text-start">
            <p class="card-text">Temperature: </p>
            <p class="card-text">Feels Like: </p>
            <p class="card-text">Pressure: </p>
            <p class="card-text">Min. Temperature: </p>
            <p class="card-text">Max. Temperature: </p> 
            <p class="card-text">Visibility: </p>
            <p class="card-text">Wind Speed: </p>
            <p class="card-text">Humidity: </p>
            <p class="card-text">Description: </p>
          </div>
          <div class="result col-4 text-end fw-bold">
            <p class="card-text"><?php echo $temp?>C</p>
            <p class="card-text"><?php echo $feels_like?>C</p>
            <p class="card-text"><?php echo $pressure?>hPa</p>
            <p class="card-text"><?php echo $mintemp?>C</p>
            <p class="card-text"><?php echo $maxtemp?>C</p> 
            <p class="card-text"><?php echo $visibility?></p>
            <p class="card-text"><?php echo $wind?>m/s</p>
            <p class="card-text"><?php echo $humidity?>%</p>
            <p class="card-text"><?php echo $desc?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
      integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
