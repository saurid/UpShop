<?php
/**
 * HTML-uppmärkning formuläret
 *
 * @author Ola Waljefors
 * @package UpMvc2
 * @subpackage Form
 * @version 2013.2.6
 * @link https://github.com/saurid/UpMvc2
 * @link http://www.phpportalen.net/viewtopic.php?t=116968
 */

namespace UpMvc\Form\View;

use UpMvc;

?>

<form id="<?php echo $form->getId() ?>" method="<?php echo $form->getMethod() ?>" action="<?php echo $form->getAction() ?>">
<?php foreach ($form->getFields() as $field): ?>
    <?php echo $field->render() ?>
<?php endforeach ?>
</form>
