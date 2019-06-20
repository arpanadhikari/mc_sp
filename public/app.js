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
$.ajax({
        url:'https://www.eventcinemas.com.au/movies/getnowshowing/',
        method: 'GET',
        headers:{
            'Access-Control-Allow-Origin':'*'
        },
        success: function(response) {
            console.log(response);
        }
})
//$.ajax($settings);
});