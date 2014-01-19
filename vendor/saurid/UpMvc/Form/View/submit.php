<?php
/**
 * HTML-uppmärkning för en submitknapp.
 *
 * @package UpMvc2\Form
 * @author  Ola Waljefors
 * @version 2013.1.1
 * @link    https://github.com/saurid/UpMvc2
 * @link    http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\Form\View;

use UpMvc;

?>

<div class="UpMvc_Form_Submit">
    <input type="submit" name="<?php echo $field->getName() ?>" value="<?php echo $field->getLabel() ?>" />
    <?php echo $field->getError('<span class="UpMvc_Error">%s</span>') ?>
</div>
