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
            <?php
                if(DEBUGMODE) {
                    echo "<h4>Debug</h4>";
                    util::var_dump($registry);
                }
            ?>
        </footer>
    </div> <!-- /container -->
    <?php 
        foreach($js as $script) {
            echo '<script src="' . $script . '"></script>';
        }
    ?>
    </body>
</html>
