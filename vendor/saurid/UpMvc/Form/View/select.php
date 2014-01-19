<?php
/**
 * HTML-uppmärkning för ett selectfält.
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

<div class="UpMvc_Form_Select">
    <label for="<?php echo $field->getName() ?>" class="UpMvc_Form_Label"><?php echo $field->getLabel() ?></label>
    <select id="<?php echo $field->getName() ?>" name="<?php echo $field->getName() ?>">
        <?php foreach ($field->getParameters() as $key => $value): ?>
            <?php $selected = ($field->getRequest($field->getName()) == $key) ? ' selected="selected"' : '' ?>
            <option value="<?php echo $key ?>" class="UpMvc_Form_option"<?php echo $selected ?>><?php echo $value ?></option>
        <?php endforeach ?>
    </select>
    <?php echo $field->getError('<span class="UpMvc_Error">%s</span>') ?>
</div>
