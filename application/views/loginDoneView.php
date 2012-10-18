<?php
    /**
     * loginView.php contains the view definition for our main
     * controller / action.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    // Prevent Direct Access to this file
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
?>
    
    <div class="row">
        <div class="span3">
            <h4>Not a member?</h4>
            <p>If you're not a member yet, then <?= Nav::BuildTextLink(array('go register', 'register')) ?>.</p>
        </div>
        <div class="span9">
            <h2>Login</h2>
            <?php
                if($loggedIn):
            ?>
                <p>Thank you for logging in!</p>
            <?php
                else:
            ?>
            <form id="LoginForm" method="POST" action="<?= BASEURI ?>login/do">
                <input type="text" name="username" id="username" placeholder="User Name" /><br/>
                <input type="password" name="password" id="password" placeholder="Password" /><br/>

                <input type="submit" class="btn btn-primary" value="Login" />
                <button class="btn btn-danger">Cancel</button>
            </form>
            <?php
                endif;
            ?>
        </div>
    </div>
