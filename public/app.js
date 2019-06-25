$(document).ready(function() {
    console.log("jquery working!");

$('#search-movie').on('click',function($var){

$("#search-result").html("")
$imdburl = "http://localhost:8000/movie_ajax/search/"

$.ajax({
        url:$imdburl +"?keyword=" + $("#search-console-input").val(),
        method: 'GET',
        headers:{
            'Access-Control-Allow-Origin':'*'
        },
        success: function(response) {
            jsonResponse = JSON.parse(response); 
            $.each(jsonResponse["d"],function(index,movies){
                var image = movies.i;
                //console.log(image);
            var html = '<div class="border p-3">'
                        + 'Movie Name: ' + movies.l + ' ,Stars: '+ movies.s + ', Released: ' + movies.y 
                        + '<div type="button" id="' + index 
                        + '" class="save-to-db-button float-right btn btn-primary" name="' 
                        + movies.l + '" cast="' + movies.s + '" released="' + movies.y + '">'
                        + 'Save to DB</div>';
            $("#search-result").animate().append(html);
            });
            console.log(jsonResponse);
        }
});
});


$('#search-result').on('click','.save-to-db-button',function(){
    console.log($(this).attr("name"));
    var saveBtn = $(this);
    saveBtn.html("Saving...")
    $saveUrl = "http://localhost:8000/movie_ajax/add"
    $.ajax({
        url:$saveUrl,
        method:"POST",
        data:{
            title:$(this).attr("name"),
            releasedate:$(this).attr("released"),
            cast:$(this).attr("cast")
        },
        headers:{
            'Access-Control-Allow-Origin':'*'
        },
        success:function(response)
        {
            console.log(response);
            saveBtn.addClass("btn-success");
            saveBtn.removeClass("btn-primary");
            saveBtn.prop('disabled');
            saveBtn.html("saved ✔");
        },
        error:function(response)
        {
            console.log("error");
            saveBtn.addClass("btn-error");
            saveBtn.removeClass("btn-primary");
           saveBtn.html("error. 🐞");
        }
    })
});

//$.ajax($settings);
});

