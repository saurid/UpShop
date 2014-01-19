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
    <title>Up MVC har upptäckt ett fel</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <link type="text/css" rel="stylesheet" href="<?php echo Up::site_path() ?>/vendor/saurid/UpMvc/View/css/format.css" media="all" />
    <link type="text/css" rel="stylesheet" href="<?php echo Up::site_path() ?>/vendor/saurid/UpMvc/View/css/printformat.css" media="print" />
</head>
<body>


<article>
    <header>
        <img src="<?php echo Up::site_path() ?>/vendor/saurid/UpMvc/View/img/UpMVC.png" height="50" alt="Up MVC" />
    </header>

    <h2>Up MVC har upptäckt ett fel</h2>

    <div class="note">
        <p>
            <strong>Meddelande:</strong><br />
            <?php echo $exception->getMessage() ?><br />
            <br />
            <strong>Modul:</strong> <?php echo $router->getModule() ?><br />
            <strong>Controller:</strong> <?php echo $router->getController() ?><br />
            <strong>Action:</strong> <?php echo $router->getAction() ?><br />
            <strong>Parametrar: </strong> <?php echo htmlspecialchars(rtrim(implode($router->getParameters(), ', '), ', ')) ?><br />
        </p>
    </div>

    <table>
        <tr>
            <th>meddelande kastat i</th>
            <th>rad</th>
            <th>typ</th>
        </tr>
        <tr>
            <td><?php echo $exception->getFile() ?></td>
            <td><?php echo $exception->getLine() ?></td>
            <td><?php echo get_class($exception) ?></td>
        </tr>
    </table>

    <h3>Stackspårning</h3>

    <table>
        <tr>
            <th>#</th>
            <th>sökväg / fil</th>
            <th>rad</th>
            <th>function</th>
        </tr>
        <?php foreach ($trace as $key => $stack): ?>
            <tr>
                <th><?php echo $key ?></th>
                <td><?php if (isset($stack['file'])) echo $stack['file'] ?></td>
                <td><?php if (isset($stack['line'])) echo $stack['line'] ?></td>
                <td><?php echo $stack['function'] ?> (<?php echo implode(', ', $stack['args']) ?>)</td>
            </tr>
        <?php endforeach ?>
        <tr>
            <th><?php echo ++$key ?></th>
            <td colspan="3">{main}</td>
        </tr>
    </table>
</article>

</body>
</html>
