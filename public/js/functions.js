$(function(){
    //put all cards descriptions to 80 characters max
    $(".description").each(function(i){
        len=$(this).text().length;
        if(len>80)
        {
            $(this).text($(this).text().substr(0,80)+'...');
        }
    });
});