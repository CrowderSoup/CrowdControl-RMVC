<?php
    /**
     * indexView.php contains the view definition for our main
     * controller / action.
     * @author Aaron Crowder <aaron@aaroncrowder.com>
     */
    
    // Prevent Direct Access to this file
    if (!defined('BASEPATH') && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        header('HTTP/1.0 403 Forbidden');
        exit;
    }
?>

<article>
    <h3>Users</h3>

    <?php
        if ($users != null) {
    ?>
            <table>
                <tr>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Email</th>
                </tr>
    <?php
            foreach ($users as $user) {
    ?>
                <tr>
                    <td><?= $user->uName ?></td>
                    <td><?= $user->password ?></td>
                    <td><?= $user->email ?></td>
                </tr>
    <?php
            }
    ?>
            </table>
    <?php
        } else {
    ?>
            <p>No Users found!</p>
    <?php
        }
    ?>

    <ul>
        <?php

            if (isset($data)) {
                foreach ($data as $key => $value) {
                    echo "<li>" . $key . " => " . $value . "</li>";
                }
            }
        ?>
    </ul>
</article>
