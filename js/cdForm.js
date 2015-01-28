$(document).ready(function()
{

    $("#cdForm").submit(function(event)
    {
        if ($("#name").val() == "") //Name Validation
        {  
            alert("Please select your name");
            event.preventDefault();
        }
    });
});