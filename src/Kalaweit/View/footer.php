
<script src="<?php echo $adminlte ?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo $adminlte ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo $adminlte ?>/dist/js/adminlte.min.js"></script>
<script src="<?php echo $adminlte ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=z3qrbn82jvuqr9727jayyaywqeq57qc2tzvidct7bzzrnt6t"></script>
<script> tinymce.init({ selector:'.mytextarea' }); </script>
<script> document.getElementById("return").addEventListener("click", function(){document.location.href='http://localhost:8888/www/home';})</script>

<?php

if(isset($_SESSION["info"]) && $_SESSION["info"] != ''){

    echo '<script>alert("'.$_SESSION["info"].'")</script>';

    $_SESSION["info"] = '';
}

?>
