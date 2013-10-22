<?php
/**
 * HTML-uppmärkning för sidnavigation (pagination)
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @version 2013.10.2
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\View;

use UpMvc;
use UpMvc\Container as Up;

?>
<nav class="UpMvc_Pagination">
    <ul>
        <?php if ($pagination->getCurrent() != 1): ?>
            <li class="UpMvc_Page_First"><a href="?page=1" title="Gå till första sidan">&laquo; Första</a></li>
            <li class="UpMvc_Page_Previous"><a href="?page=<?php echo $pagination->getCurrent() - 1 ?>" title="Gå till förra sidan">&lsaquo; Förra</a></li>
        <?php endif; ?>

        <?php if ($pagination->getArray()[0] > 1): ?>
            <li class="UpMvc_Page_Paus">...</li>
        <?php endif; ?>

        <?php foreach ($pagination->getArray() as $page): ?>
            <?php if ($pagination->getCurrent() != $page): ?>
                <li class="UpMvc_Page"><a href="?page=<?php echo $page ?>" title="Gå till sida <?php echo $page ?>"><?php echo $page ?></a></li>
            <?php else: ?>
                <li class="UpMvc_Page_Current"><?php echo $page ?></li>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if ($pagination->getArray()[count($pagination->getArray())-1] < $pagination->getPages()): ?>
            <li class="UpMvc_Page_Paus">...</li>
        <?php endif; ?>

        <?php if ($pagination->getCurrent() != $pagination->getPages()): ?>
            <li class="UpMvc_Page_Next"><a href="?page=<?php echo $pagination->getCurrent() + 1 ?>" title="Gå till nästa sida">Nästa &rsaquo;</a></li>
            <li class="UpMvc_Page_Last"><a href="?page=<?php echo $pagination->getPages() ?>" title="Gå till sista sidan">Sista &raquo;</a></li>
        <?php endif; ?>

        <li class="UpMvc_Page_Sum"><small>Visar <?php echo $pagination->getOffset() + 1 ?> - <?php echo $pagination->getOffset() + $pagination->getLimit() ?> av <?php echo $pagination->getTotal() ?> poster</small></li>
    </ul>
</nav>