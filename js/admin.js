$(document).ready(function() {
    $.ajax({
        method: "POST",
        url: 'load-data.php',
        success: function(response) {
            var data = JSON.parse(response);

            $('#data').DataTable({
                data: data,
                columns: [
                    {data: 'firstname'},
                    {data: 'title'},
                    {data: 'post_text'},
                    {data: 'created_at'},
                ]
            });
        }
    });
});