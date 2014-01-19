<?php
/**
 * HTML-uppmärkning för checkbox.
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

<div class="UpMvc_Form_Checkbox" id="<?php echo $field->getName() ?>[]">
    <span class="UpMvc_Form_Label"><?php echo $field->getLabel() ?></span>
    <?php foreach ($field->getParameters() as $key => $value): ?>
        <?php
        $selected = '';
        if ($field->getRequest($field->getName()) != '') {
            if (in_array($key, $field->getRequest($field->getName()))) {
                $selected = ' checked="checked"';
            }
        }
        ?>
        <span class="UpMvc_Form_Input_Span">
            <input type="checkbox" name="<?php echo $field->getName() ?>[]" value="<?php echo $key ?>"<?php echo $selected ?> /> <?php echo $value ?>
        </span>
    <?php endforeach ?>
    <?php echo $field->getError('<span class="UpMvc_Error">%s</span>') ?>
</div>
