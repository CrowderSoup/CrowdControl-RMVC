<?php
    /* Prevent Direct Access to this file */
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
?>
    <?php 
        foreach($js as $script) {
            echo '<script type="text/javascript" scr="' . $script . '"></script>';
        }
    ?>
    </body>
</html>
