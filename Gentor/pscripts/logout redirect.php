<?php
    session_start();
    session_unset();
    session_destroy();


    ?><script>
        window.location="../views/index.html";
    </script>

    <?php
?>