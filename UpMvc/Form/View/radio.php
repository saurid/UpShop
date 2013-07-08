<?php
/**
 * HTML-uppmärkning för en radiobox
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

<div class="UpMvc_Form_Radio" id="<?php echo $field->getName() ?>[]">
    <span class="UpMvc_Form_Label"><?php echo $field->getLabel() ?></span>
    <?php foreach ($field->getParameters() as $key => $value): ?>
        <?php $selected = ($field->getRequest($field->getName()) == $key) ? ' checked="checked"' : '' ?>
        <span class="UpMvc_Form_Input_Span">
            <input type="radio" name="<?php echo $field->getName() ?>" value="<?php echo $key ?>"<?php echo $selected ?> /> <?php echo $value ?>
        </span>
    <?php endforeach ?>
    <?php echo $field->getError('<span class="UpMvc_Error">%s</span>') ?>
</div>
