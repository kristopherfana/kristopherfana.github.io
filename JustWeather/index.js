var temp_html = document.getElementById("temp");
var city_name_html = document.getElementById("city_name");
var main_desc_html = document.getElementById("main_desc");
var country_html = document.getElementById("country");
var feels_like_html = document.getElementById("feels_like");
var pressure_html = document.getElementById("pressure");
var humidity_html = document.getElementById("humidity");
var visibility_html = document.getElementById("visibility");
var speed_html = document.getElementById("speed");
var temp_min_html = document.getElementById("temp_min");
var temp_max_html = document.getElementById("temp_max");
var degree_html = document.getElementById("degree");

var thunderstorm = "fi-rr-thunderstorm";
var drizzle = "fi-rr-cloud-drizzle";
var raindrops = "fi-rr-raindrops";
var atmosphere = "fi-rr-smog";
var snow = "fi-rr-snow-blowing";
var clear = "fi-rr-cloud-sun";
var clouds = "fi-rr-smoke";
var icon_class;

var obj = "";
var city_search = document.getElementById("search");
city_search.value = "London";

function fetchWeather() {
  let url = `http://api.openweathermap.org/data/2.5/weather?q=${city_search.value}&units=metric&appid=ca8c6ec76045f8382dcf193fd7b48718`;
  fetch(url, {})
    .then((response) => {
      if (!response.ok) {
        throw response; //check the http response code and if isn't ok then throw the response as an error
      }

      return response.json(); //parse the result as JSON
    })
    .then((response) => {
      //response now contains parsed JSON ready for use
      obj = response;

      //Weather Object
      city_name = obj.name;
      country = obj.sys.country;

      weather = obj.weather[0];

      description = weather.description;
      main_desc = weather.main;
      main_desc_html.innerHTML = main_desc;

      id = weather.id;

      //Main Object
      main = obj.main;

      feels_like = main.feels_like;
      pressure = main.pressure;
      temp = main.temp;
      temp_max = main.temp_max;
      temp_min = main.temp_min;
      humidity = main.humidity;

      //Wind Object
      visibility = obj.visibility;
      wind = obj.wind;
      degree = wind.deg;
      speed = wind.speed;

      //html declaration
      feels_like_html.innerHTML = feels_like + "&#8451";
      temp_min_html.innerHTML = temp_min + "&#8451";
      temp_max_html.innerHTML = temp_max + "&#8451";
      humidity_html.innerHTML = humidity + "%";
      speed_html.innerHTML = speed + "m/s";
      pressure_html.innerHTML = pressure + "hPa";
      visibility_html.innerHTML = visibility + "m";
      degree_html.innerHTML = degree + "&#176;";
      city_name_html.innerHTML = city_name;
      country_html.innerHTML = country;
      temp_html.innerHTML = Math.round(temp) + "&#8451";

      //unsplash fetch api
      fetch(
        `https://api.unsplash.com/search/photos?page=${Math.round(
          Math.random() * 5
        )}&orientation=landscape&order_by=relevant&query=${description}&client_id=ReiS6oUAYnG6C0sC4SG_bNWkSmnXxk0sy5d7uhtPTkY`
      )
        .then((response) => response.json())
        .then((result) => {
          image_url =
            result.results[Math.round(Math.random() * 9)].urls.regular;
          document.getElementById(
            "bg"
          ).style.backgroundImage = `url('${image_url}')`;
        });

      //Adding Icons
      if (main_desc == "Rain") {
        icon_class = raindrops;
      } else if (main_desc == "Clouds") {
        icon_class = clouds;
      } else if (main_desc == "Snow") {
        icon_class = snow;
      } else if (main_desc == "Drizzle") {
        icon_class = clouds;
      } else if (main_desc == "Thunderstorm") {
        icon_class = thunderstorm;
      } else if (main_desc == "Clear") {
        icon_class = clear;
      } else {
        icon_class = atmosphere;
      }
      document.getElementById("weather_icon").className = "fi";
      document.getElementById("weather_icon").classList.add(icon_class);
    })
    .catch((errorResponse) => {
      if (errorResponse.text) {
        //additional error information
        errorResponse.text().then((errorMessage) => {
          //errorMessage now returns the response body which includes the full error message
        });
      } else {
        //no additional error information
      }
    });
}

fetchWeather();

// preventing the submit from loading
var form = document.getElementById("mySearchForm");
function handleForm(event) {
  event.preventDefault();
}
form.addEventListener("submit", handleForm);

//setting time
const element = document.getElementById("time");
setInterval(function () {
  const d = new Date();
  element.innerHTML = d.toLocaleTimeString();
}, 1000);

var searchClicked = "false";

//event handling of submit
document.getElementById("mySearchForm").addEventListener("submit", () => {
  city_search.value = city_search.value;
  fetchWeather();
  // document.body.style.animation = "fadeIn 1s";
  // setTimeout(() => (document.body.style.animation = ""), 1000);
});

let suggestion = [
  "Hello",
  "Hie",
  "Morning",
  "Afternoon",
  "Evening",
  "utopia",
  "Underneath",
  "Comprehensive",
  "Valuable",
  "30",
  "40",
];

city_search.onkeyup = (e) => {
  let userInput = e.target.value;
  newArray = [];
  if (userInput) {
    newArray = suggestion.filter((data) => {
      return data.toLowerCase().startsWith(userInput.toLowerCase());
    });
    newArray = newArray.map((data) => {
      return "<li>" + data + "</li>";
    });
    console.log(suggestion.join(" "));
    document.getElementById("datalist").style.display = "block";
  } else {
    document.getElementById("datalist").style.display = "none";
  }
  console.log(city_search === document.activeElement);
};
