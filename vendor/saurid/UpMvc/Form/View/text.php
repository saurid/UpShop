<?php
/**
 * HTML-uppmärkning för ett textfält.
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

<div class="UpMvc_Form_Text">
    <label for="<?php echo $field->getName() ?>" class="UpMvc_Form_Label"><?php echo $field->getLabel() ?></label>
    <input type="text" id="<?php echo $field->getName() ?>" name="<?php echo $field->getName() ?>" value="<?php echo $field->getRequest($field->getName()) ?>" />
    <?php echo $field->getError('<span class="UpMvc_Error">%s</span>') ?>
</div>
