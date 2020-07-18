function getWeather() {
  city = document.getElementById("city").value;
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
  var apiKey=""; //Put your api key here
  var url = "https://api.weatherbit.io/v2.0/current?city=" + city + "&key=" + apiKey;
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}
