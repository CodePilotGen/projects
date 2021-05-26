$(document).ready(function() {
    init();
    $(".menu-link").click(function(event){
       console.log(event)
       $(".menu-link.active").removeClass("active");
       $(event.target).parents(".menu-link").addClass("active");
       console.log($(event.target).html())
       if ($(event.target).html() == "Users List") {
         $("#kt_post").load("/home/getuserlist");
       }
       else if ($(event.target).html() == "Users List") {
         $("#kt_post").load("/home/getdashboard");
       }
    });
 });

 function init() {
    $("#kt_post").load("/home/getdashboard");
 }