$(document).ready(function()
{

    $("#myForm").submit(function(event)
    {
        var atpos = $('#email').val().indexOf("@");
        var dotpos = $('#email').val().lastIndexOf(".");
        
        if ($("#name").val() == "") //Name Validation
        {  
            alert("Please select first name");
            event.preventDefault();
        }
        else if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=$('#email').val().length) //e-mail validation
        {
            alert("Not a valid e-mail address");
            event.preventDefault();
        }
        else if (($('#mobile').val().indexOf(" ")!=-1) || $('#mobile').val().length!=10 || isNaN($('#mobile').val())) //Mobile Validation 
        {
            alert("Mobile Number Not Valid");
            event.preventDefault();
        }
        else if ($("#reason").val() == "") //Reason Validation
        {  
            alert("Please state the reason for contact");
            event.preventDefault();
        }
    });
});