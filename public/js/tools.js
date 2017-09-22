$(function() {

    <!-- for the are you sure dialog -->
    $('.confirm').click(function () {
        return window.confirm("Are you sure?");
    });

    <!-- for uploading picture with ajax -->
    /*$("#uploadimage").on('submit',(function(e) {
        e.preventDefault();
        $("#message").empty();
        $('#loading').show();
        $.ajax({
            url: this.action, // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                $('#loading').hide();
                $("#uploadimage").submit();
            }
        });
    }))*/

// Function to preview image after validation
    $("#easy_file").change(function() {
        $("#message").empty(); // To remove the previous error message
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
        {
            $('#previewing').attr('src','http://via.placeholder.com/700x250');
            $("#message").html("<p class='text-danger'>Please select a valid image file.<br />"+
                "<strong>Note: </strong>"+
                "Only jpeg, jpg and png Images type allowed.</p>");
            return false;
        }
        else
        {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });

    function imageIsLoaded(e) {
        $("#file").css("color","green");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '700px');
        $('#previewing').attr('height', '250px');
    };

});