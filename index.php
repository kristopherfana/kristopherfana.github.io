<?php
$result="";
if (isset($_GET['submit'])){

    if (!($_GET['city'])){
        $result='<div class="alert alert-danger"><h4 class="alert-heading">Oops! Error:</h4>Could not find weather forecast for the given city. Please try again.</div>';
    }else{
        $city=$_GET['city'];
        $city_nospace=str_replace(" ","",$city);
    

        $content=@file_get_contents('https://www.weather-forecast.com/locations/'.$city_nospace.'/forecasts/latest');
        if($content==false){
            $result='<div class="alert alert-danger"><h4 class="alert-heading">Oops! Error:</h4>Could not find weather forecast for the given city. Please try again.</div>';
        } else{

            preg_match('/<p class="b-forecast__table-description-content"><span class="phrase">(.*?)<\/span><\/p><\/td>/',$content,$matches);
            $answer=$matches[0];
            $result='<div class="alert alert-info"><h4 class="alert-heading">Weather Forecast</h4><strong>'.$city.' Weather Today(1-3days):</strong>'.$answer.'</div>';
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Weather Predicator</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--CSS Bootstrap to be placed in the head of the document-->
        <!-- <link rel="stylesheet" href="C:\xampp\htdocs\ALL_DEMO\css\bootstrap.min.css" type="text/css" >
        <link rel="stylesheet" href="C:\xampp\htdocs\bootstrap-5.2.2-dist\css\bootstrap.min.css" > -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <style>
        html, body{
            width:100%
        }
        body{
            background-color: black;
            color: white;
            background-image: url('weather_image.jpg');
            background-size:cover;
            
            
        }
        .center {
        text-align:center;
        }
        .white {
        color:white;
        }
        .container{
            width:75%;
            
            padding-top:30px;
            margin-top: 100px;
            background-color: rgba(0, 0, 0, 0.4);
            text-align:center;
            border-radius: 20px;
            padding-bottom:10px;
           
        }
        button{
            margin-top:25px;
            margin-bottom: 0px;
        }
        svg{
            margin-bottom: 10px;
        }
        .alert{
            
        }
    </style>
    <body>
        <div class="container center white">
           
                <div class=" col-md-6 offset-md-3 center white"> 
                
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-cloud-sun" viewBox="0 0 16 16">
                <path d="M7 8a3.5 3.5 0 0 1 3.5 3.555.5.5 0 0 0 .624.492A1.503 1.503 0 0 1 13 13.5a1.5 1.5 0 0 1-1.5 1.5H3a2 2 0 1 1 .1-3.998.5.5 0 0 0 .51-.375A3.502 3.502 0 0 1 7 8zm4.473 3a4.5 4.5 0 0 0-8.72-.99A3 3 0 0 0 3 16h8.5a2.5 2.5 0 0 0 0-5h-.027z"/>
                <path d="M10.5 1.5a.5.5 0 0 0-1 0v1a.5.5 0 0 0 1 0v-1zm3.743 1.964a.5.5 0 1 0-.707-.707l-.708.707a.5.5 0 0 0 .708.708l.707-.708zm-7.779-.707a.5.5 0 0 0-.707.707l.707.708a.5.5 0 1 0 .708-.708l-.708-.707zm1.734 3.374a2 2 0 1 1 3.296 2.198c.199.281.372.582.516.898a3 3 0 1 0-4.84-3.225c.352.011.696.055 1.028.129zm4.484 4.074c.6.215 1.125.59 1.522 1.072a.5.5 0 0 0 .039-.742l-.707-.707a.5.5 0 0 0-.854.377zM14.5 6.5a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
                </svg>
                    <h1 class="center white">Weather Predicator</h1>

                    <form class="center white">
                        <p class="center white">Enter the name of your city to have a forecast of the weather.</p>
                        <div class="form-group center white">
                            <input class="form-control" type="text" name="city" placeholder="E.g. London, Paris, Douala, Harare...">
                            <button class="btn btn-lg btn-success " name="submit">Find Weather</button>

                        </div>
                    <?php echo $result?>
                    </form>

                
            </div>

        </div>
            <!--jQUery, Javascipt and popperjs to be pasted before the the end of the body-->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            
    </body>
</html>