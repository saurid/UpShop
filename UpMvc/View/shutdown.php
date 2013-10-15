<?php
/**
 * HTML-uppmärkning för Up MVC's felhantering
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.2.6
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\View;

use UpMvc;

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Up MVC/PHP har upptäckt ett fel</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <link type="text/css" rel="stylesheet" href="<?php echo UpMvc\Container::get()->site_path ?>/UpMvc/View/css/format.css" media="all" />
    <link type="text/css" rel="stylesheet" href="<?php echo UpMvc\Container::get()->site_path ?>/UpMvc/View/css/printformat.css" media="print" />
</head>
<body>

<article>
    <header>
        <img src="<?php echo UpMvc\Container::get()->site_path ?>/UpMvc/View/img/UpMVC.png" height="50" alt="Up MVC" />
    </header>

    <h2>Up MVC/PHP har upptäckt ett fel</h2>

    <div class="note">
        <p>
            <strong>Meddelande</strong>: (php&apos;s felmeddelande)<br />
            <?php echo $error['message'] ?>
        </p>
    </div>

    <p>
        <strong>Meddelande kastat i:</strong><br />
        <?php echo $error['file'] ?>, rad <?php echo $error['line'] ?>
    </p>
</article>

</body>
</html>
