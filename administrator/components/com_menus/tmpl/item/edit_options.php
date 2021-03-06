<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_menus
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

?>
<?php
	echo HTMLHelper::_('bootstrap.startAccordion', 'menuOptions', array('active' => 'collapse0'));
	$fieldSets = $this->form->getFieldsets('params');
	$i = 0;

	foreach ($fieldSets as $name => $fieldSet) :
		if (!(($this->item->link == 'index.php?option=com_wrapper&view=wrapper') && $fieldSet->name == 'request')
				&& !($this->item->link == 'index.php?Itemid=' && $fieldSet->name == 'aliasoptions')) :
			$label = !empty($fieldSet->label) ? $fieldSet->label : 'COM_MENUS_' . $name . '_FIELDSET_LABEL';
			echo HTMLHelper::_('bootstrap.addSlide', 'menuOptions', Text::_($label), 'collapse' . ($i++));
				if (isset($fieldSet->description) && trim($fieldSet->description)) :
					echo '<p class="tip">' . $this->escape(Text::_($fieldSet->description)) . '</p>';
				endif;
				?>
					<?php foreach ($this->form->getFieldset($name) as $field) : ?>
						<div class="control-group">
							<?php echo $field->label; ?>
							<?php echo $field->input; ?>
						</div>
					<?php endforeach;
			echo HTMLHelper::_('bootstrap.endSlide');
		endif;
	endforeach; ?>
<?php

echo HTMLHelper::_('bootstrap.endAccordion');
