<?php
    /* Prevent Direct Access to this file */
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
?>
        <hr/>
        <footer>
            Copyright &copy; <a href="http://aaroncrowder.com" target="_blank">Aaron Crowder</a>
            <h6>URIdata</h6><?= util::var_dump($URIdata) ?>
            <h6>Request</h6><?= util::var_dump($request) ?>
        </footer>
    </div> <!-- /container -->
    <?php 
        foreach($js as $script) {
            echo '<script type="text/javascript" scr="' . $script . '"></script>';
        }
    ?>
    </body>
</html>
