$(document).ready(function(){
    $("#imgModalLink").click(function(event){
        $("#modalImgContainer").attr("src", $(this).attr("data-image"));
    });
});
