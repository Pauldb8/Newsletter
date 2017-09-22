
    <!-- backlink to repo on GitHub, and affiliate link to Rackspace if you want to support the project -->
    <div class="footer">
        &copy; Copyright <a href="http://onetec.eu/" target="_blank">OneTec Group</a> 2017
    </div>

    <!-- jQuery, loaded in the recommended protocol-less way -->
    <!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
            integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
            integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
            crossorigin="anonymous"></script>
    <!-- Font Awesome personal code -->
    <script src="https://use.fontawesome.com/dc07fe58a8.js"></script>

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL; ?>";
    </script>

    <!-- our JavaScript -->
    <script src="<?php echo URL; ?>js/application.js"></script>
    <!-- and our JS tools -->
    <script src="<?php echo URL; ?>js/tools.js"></script>
    <!-- Our Rich HTML Editor -->
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=6qrqkop0xfz2k081lhm4unejwplk8ratwgqrxu6lvjh7hynb"></script>
    <script>tinymce.init({ selector:'textarea', min_height: 400, });</script>

    <!-- This webpage has developped and is maintained by Paul R. De Buck for OneTec Group. -->
</body>
</html>
