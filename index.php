<?php 
   $ip = $_SERVER['REMOTE_ADDR']; //IP VARIABLE
   $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
   $city= $details->city;
   ?>
<!DOCTYPE html>
<html lang="en">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <head>
      <title>BlueWeather</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
      <!-- Google Fonts -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
      <!-- Bootstrap core CSS -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Bootstrap -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
      <!-- custom css -->
      <link rel="stylesheet" href="css/main.css">
      <!-- JQuery -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Bootstrap tooltips -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
      <!-- Bootstrap core JavaScript -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
      <!-- MDB core JavaScript -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
      <!-- custom js -->
      <script src="js/main.js"></script>
      <!-- favicon -->
      <link rel="icon" href="icons/favicon.svg">
   </head>
   <body onload="firstWeather()" class="disable-select">
      <div class="container mt-3 disable-select">
      <!-- Title -->
      <h2 class="card-title text-right" id="header"> <img id="logo" src="icons/logo.svg" class="mb-2"></i>&nbsp;<strong>BlueWeather</strong></h2>
      <!-- Card Wider -->
      <div class="card card-cascade wider rounded mb-0">
         <!-- Card image -->
         <div class="view view-cascade overlay">
            <!-- <img   alt="Card image cap"> -->
            <div id="w-data" class="card-img-top text-center text-white rounded-top">
               <br>
               <h1 id="temp"></h1>
               <h5 id="cname" class=" ml-5"></h5>
               <h5 id="desc"></h5>
               <h5 id="ws"></h5>
               <h5 id="humid"></h5>
               <br>
            </div>
         </div>
         <div class="card-body card-body-cascade  pb-0">
            <div class="md-form">
               <input type="text" id="city" class="form-control  pl-5">
               <i class="fas fa-map-marker-alt prefix"></i>
               <label for="city">City</label>
            </div>
            <div class="text-center">
               <button type="submit" id="sub-btn" class="btn btn-primary btn-md" onclick="getWeather()">Get Weather</button>
            </div>
            <br>
         </div>
      </div>
      <br>
      <footer id="footer" class="page-footer font-small pt-4 rounded">
         <div class="container">
            <ul class="list-unstyled list-inline text-right  disable-select">
               <li class="list-inline-item">
                  <a class="btn-floating btn-fb mx-1" href="https://github.com/akshayitzme/blueweather">
                  <i class="fab fa-github black-text fa-2x"> </i>
                  </a>
               </li>
               <li class="list-inline-item">
                  <a class="btn-floating btn-gplus mx-1" href="https://instagram.com/akshayitzme">
                  <i class="fab fa-instagram  pink-text fa-2x"> </i>
                  </a>
               </li>
               <li class="list-inline-item">
                  <a class="btn-floating btn-gplus mx-1" href="https://t.me/coderitzme">
                  <i class="fab fa-telegram fa-2x light-blue-text"></i>
                  </a>
               </li>
            </ul>
         </div>
   </body>
   </footer>
   <br><br>
</html>
<script>
   //firstWeather
   function firstWeather() {
   var city = "<?php echo $city ?>";
   console.log(city);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function () {
       if (this.readyState == 4 && this.status == 200) {
           var data = JSON.parse(this.responseText);
   
           /* Extracting Data */
           let temp = data.data[0]["app_temp"];
           temp += "<sup>&#8451;</sup>";
           let country = data.data[0]["country_code"];
           //CityName
           let cname = data.data[0]["city_name"];
           //Country
           cname += ", " + country;
           //Description
           let desc = data.data[0]["weather"].description;
           //Code
           var code = data.data[0]["weather"].code;
           code = parseInt(code);
           //Humidity
           var humid=data.data[0]["rh"];
           humid+="% Humidity";
           //Wind Speed
           var ws=parseInt(data.data[0]["wind_spd"]);
           ws=Math.round(ws*1.609);
           ws+= " km/h Wind";
           //Outputing Data
           document.getElementById("temp").innerHTML = temp;
           document.getElementById("cname").innerHTML = cname;
           document.getElementById("desc").innerHTML = desc;
           document.getElementById("humid").innerHTML = humid;
           document.getElementById("ws").innerHTML = ws;
   
          
         }
   };
   var apiKey=""; //API Key
   var url = "https://api.weatherbit.io/v2.0/current?city=" + city + "&key="+apiKey;
   xmlhttp.open("GET", url, true);
   xmlhttp.send();
   }
</script>

