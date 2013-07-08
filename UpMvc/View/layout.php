<?php
/**
 * Layout för dokumentation och felmeddelanden i Up MVC
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.2.10
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\View;

use UpMvc;

?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo $site_path ?>/UpMvc/View/css/format.css" media="all" />
    <link rel="stylesheet" href="<?php echo $site_path ?>/UpMvc/View/css/printformat.css" media="print" />
</head>
<body>

<nav>
    <ul>
        <li><h2>om up mvc</h2></li>
        <li><a href="<?php echo $site_path ?>/UpMvc/Manual/visa/inledning">Inledning</a></li>
        <li><a href="<?php echo $site_path ?>/UpMvc/Manual/visa/filstruktur">Filstruktur</a></li>
    </ul>
    <ul>
        <li><h2>ramverkets lager</h2></li>
        <li><a href="<?php echo $site_path ?>/UpMvc/Manual/visa/controllers">Controllers / Actions</a></li>
        <li><a href="<?php echo $site_path ?>/UpMvc/Manual/visa/view">Views</a></li>
        <li><a href="<?php echo $site_path ?>/UpMvc/Manual/visa/model">Models</a></li>
    </ul>
    <ul>
        <li><h2>övrigt</h2></li>
        <li><a href="<?php echo $site_path ?>/UpMvc/Manual/visa/container">Servicecontainern</a></li>
        <li><a href="<?php echo $site_path ?>/UpMvc/Manual/visa/moduler">Moduler</a></li>
        <li><a href="<?php echo $site_path ?>/UpMvc/Manual/visa/request">Requestobjektet</a></li>
        <li><a href="<?php echo $site_path ?>/UpMvc/Manual/visa/cache">Cachning</a></li>
        <li><a href="<?php echo $site_path ?>/UpMvc/Manual/visa/siduppdelning">Siduppdelning / Pagination</a></li>
        <li><a href="<?php echo $site_path ?>/UpMvc/Manual/visa/rattigheter">Rättigheter</a></li>
    </ul>
    <ul>
        <li><h2>detaljerat</h2></li>
        <li><a href="<?php echo $site_path ?>/UpMvc/Manual/visa/detaljer">UML-diagram och tidslinje</a></li>
        <li><h2>under utveckling</h2></li>
        <li><a href="<?php echo $site_path ?>/UpMvc/WebForm">Webbformulär</a></li>
    </ul>

    <br />
</nav>

<article>
    <header>
        <a href="<?php echo $site_path ?>/UpMvc/Manual/visa">
            <img src="<?php echo $site_path ?>/UpMvc/View/img/UpMVC.png" width="230" height="99" alt="<?php echo $title ?>" />
        </a>
        <h2>dokumentation</h2>
    </header>

    <?php echo $content ?>
</article>

</body>
</html>
