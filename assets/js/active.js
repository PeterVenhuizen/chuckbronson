$(function() {
    var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
    //console.log(pgurl);
    $(".nav li a").each(function(){
        if($(this).attr("href") == pgurl ) {
            $(this).addClass("active");
            $(this).closest('.dropdown-toggle').addClass("active");
            $(this).closest("ul.dropdown-menu").siblings(".dropdown-toggle").addClass("active");
        }
    })
    
    pgurl == "index.php" || pgurl == "" ? ($("#home").show(), $("#away").hide()) : ($("#home").hide(), $("#away").show());

});