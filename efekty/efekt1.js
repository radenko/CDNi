$(document).ready(function() {
    $('#btn1').on("click", function (){
       $('#detail').show(); 
    });
    $('#clickdiv').on("click", function (){
       $('#detail').show(); 
    });
    $('#detail').on("click", function (){
       $('#detail').hide(); 
    });    
});