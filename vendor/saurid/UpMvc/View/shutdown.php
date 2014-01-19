<?php
/**
 * HTML-uppmärkning för Up MVC's felhantering.
 *
 * @package UpMvc2
 * @author  Ola Waljefors
 * @version 2014.1.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\View;

use UpMvc;
use UpMvc\Container as Up;

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Up MVC/PHP har upptäckt ett fel</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <link type="text/css" rel="stylesheet" href="<?php echo Up::site_path() ?>/vendor/saurid/UpMvc/View/css/format.css" media="all" />
    <link type="text/css" rel="stylesheet" href="<?php echo Up::site_path() ?>/vendor/saurid/UpMvc/View/css/printformat.css" media="print" />
</head>
<body>

<article>
    <header>
        <img src="<?php echo Up::site_path() ?>/vendor/saurid/UpMvc/View/img/UpMVC.png" height="50" alt="Up MVC" />
    </header>

    <h2>Up MVC/PHP har upptäckt ett fel</h2>

    <div class="note">
        <p>
            <strong>Meddelande</strong>: (php&apos;s felmeddelande)<br />
            <?php echo $error['message'] ?>
        </p>
    </div>

    <table>
        <tr>
            <th>Meddelande kastat i</th>
        </tr>
        <tr>
            <td><?php echo $error['file'] ?>, rad <?php echo $error['line'] ?></td>
        </tr>
    </table>        
</article>

</body>
</html>
