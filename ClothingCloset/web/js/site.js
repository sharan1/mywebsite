$(document).ready(function() 
{
    $(".select2").select2();

    $(".buy-item").on('click', function (event) {
        //event.preventDefault();
        swal("Congratulations!", "You bought this item!", "success");
    });
    
    $(".export-data").on('click', function (event) {
        exportTableToCSV.apply(this, [$('#booking-data'), 'Booking_Availability.csv']);
    });

    $('.rp-button').on('click', function(e) {
        e.preventDefault();
        email_val = $('.email-text').val();
        //alert(email_val);
        $.ajax({
           url: "?r=ajax/message",
           type: 'post',
           data: {email: $('.email-text').val()},
           success: function (data) {
              $('#show-message').html(data);
           }

        });
    });

    $('#signup-form').on('beforeSubmit', function (e) {
      username = $('#available-username').val();
      email = $('#available-email').val();
        $.ajax({
            url: "?r=ajax/signupform",
            type: 'post',
            data: {username:username,email:email},
            success: function (data) {
                if(data!='')
                {
                  alert(data);
                  return false;
                }
            },
            error: function () {
                return false;
            }

        });
        return true;
    });

    function exportTableToCSV($table, filename) {
        var $rows = $table.find('tr'),
                
            tmpColDelim = String.fromCharCode(11), 
            tmpRowDelim = String.fromCharCode(0),
            colDelim = '","',
            rowDelim = '"\r\n"',
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                        $cols = $row.find('td , th');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                            text = $col.text();

                    return text.replace('"', '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
            .split(tmpRowDelim).join(rowDelim)
            .split(tmpColDelim).join(colDelim) + '"',
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
            $(this).attr({
                'download': filename,
                'href': csvData,
                'target': '_blank'
            });
    }
});


function showLogin() {
	document.getElementById('login-wrapper').style.display = "inline";
	document.getElementById('rp-wrapper').style.display = "none";
	document.getElementById('loginbutton').style.background = "#7BA31C";
	document.getElementById('rstPass').style.background = "#000";
}		
function showRP() {
	document.getElementById('login-wrapper').style.display = "none";
	document.getElementById('rp-wrapper').style.display = "inline";
	document.getElementById('loginbutton').style.background = "#000";
	document.getElementById('rstPass').style.background = "#7BA31C";
}
