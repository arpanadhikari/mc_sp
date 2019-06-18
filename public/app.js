$(document).ready(function() {
    console.log("jquery working!");

$('#search-console-input').on('keydown',function($var){
    console.log($var.key);
});
$eventcinemasurl = "https://www.eventcinemas.com.au/movies/getnowshowing/"

$settings = {
    'url':$eventcinemasurl,
    'method':"GET"
}
$.ajax($settings);
});