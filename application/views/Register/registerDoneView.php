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
            <h4>Already registered?</h4>
            <p>If you're already registered then <?= Nav::BuildTextLink(array('go login', 'login')) ?>.
        </div>
        <div class="span9">
            <h2>Register</h2>
            <?php
                if($registered):
            ?>
                <p>Thank you for registering! You can now <?= Nav::BuildTextLink(array('go login', 'login')) ?>.</p>
            <?php
                else:
            ?>
                <p>There was an error processing your registration. Please try again.</p>
                <form id="RegisterForm" method="POST" action="<?= BASEURI ?>register/do_reg">
                    <input type="text" name="username" id="username" placeholder="User Name" /><br/>
                    <input type="text" name="email" id="username" placeholder="Email" /><br/>
                    <input type="password" name="password" id="password" placeholder="Password" /><br/>
                    <input type="password" name="password" id="password2" placeholder="Repeat Password" /><br/>

                    <input type="submit" class="btn btn-primary" value="Register" />
                    <button class="btn btn-danger">Cancel</button>
                </form>
            <?php
                endif;
            ?>
        </div>
    </div>
