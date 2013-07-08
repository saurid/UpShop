<?php
/**
 * HTML-uppmärkning för ett passwordfält
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Form
 * @version 2013.1.1
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\Form\View;

use UpMvc;

?>

<div class="UpMvc_Form_Password">
    <label for="<?php echo $field->getName() ?>" class="UpMvc_Form_Label"><?php echo $field->getLabel() ?></label>
    <input type="password" id="<?php echo $field->getName() ?>" name="<?php echo $field->getName() ?>" value="<?php echo $field->getRequest($field->getName()) ?>" />
    <?php echo $field->getError('<span class="UpMvc_Error">%s</span>') ?>
</div>
