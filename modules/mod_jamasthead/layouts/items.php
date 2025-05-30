<?php

/**
 * ------------------------------------------------------------------------
 * JA Masthead Module 
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - Copyrighted Commercial Software
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites:  http://www.joomlart.com -  http://www.joomlancers.com
 * This file may not be redistributed in whole or significant part.
 * ------------------------------------------------------------------------
 */

defined('JPATH_BASE') or die;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Layout\FileLayout;

$field 		= $displayData['field'];
$attributes = $displayData['attributes'];
$items 		= $displayData['items'];
//$value 		= htmlspecialchars($field->value, ENT_COMPAT, 'UTF-8');
$value 		= $field->value;
$id 		= $field->id;
$name 		= $field->name;
$hideLabel 	= (bool) $attributes['hiddenLabel'];
$label 		= Text::_((string) $attributes['label']);
$desc 		= Text::_((string) $attributes['description']);

$width 		= 90 / count($items);

$field_items = array();
if (is_array($value) && count($value)) {
	foreach ($value as $f_name => $f_items) {
		if (is_array($f_items) && (count($f_items) > count($field_items))) {
			$field_items = $f_items;
		}
	}
}
if (!count($field_items)) {
	$field_items = array(0 => null);
}
$j4 = version_compare(JVERSION, '4', '>=');
?>
<div class="jaacm-list <?php echo $id ?>" data-index="<?php echo count($field_items); ?>">
	<?php if ($hideLabel) : ?>
		<h4><?php echo $label ?></h4>
		<p><?php echo $desc ?></p>
	<?php endif ?>
	<div class="jalist <?php echo $j4 ? 'j4' : '' ?>" width="100%">
		<?php $cnt = 0; ?>
		<?php foreach ($field_items as $index => $v) : ?>
			<div class="ja-item <?php if (!$cnt) echo 'first'; ?>">
				<?php foreach ($items as $_item) :
					$item = clone $_item;
					//$item->id .= '_'.$cnt;
					$item->value = (isset($value[$item->fieldname][$index]) ? $value[$item->fieldname][$index] : '');
					if ($item->type == 'Calendar') {
						$item->class = ($field->class) ? $field->class . ' type-calendar' : 'type-calendar';
					}
					$input = $item->getInput();
					if (substr($item->name, -2) == '[]') {
						$name = substr($item->name, 0, -2) . '[' . $cnt . '][]';
					} else {
						$name = $item->name . '[' . $cnt . ']';
					}

					if ($item->type == 'Calendar') {
						if ($cnt == 0) {
							$input = str_replace(array($item->name), array($name), $input);
						} else {
							$input = str_replace(array($item->name, $item->id), array($name, $item->id . '_' . $cnt), $input);
							HTMLHelper::_('calendar', $item->value, $name, $item->id . '_' . $cnt);
						}
					} else {
						$input = str_replace(array($item->name, $item->id), array($name, $item->id . '_' . $cnt), $input);
					}
					if ($item->type == 'Media') {
						if (version_compare(JVERSION, '4.0', 'ge')) {
							$input = '';
							$options = [
								'preview' => false,
								'name' => $item->name . '[' . $cnt . ']',
								'value' => $item->value,
								'disabled' => false,
								'folder' => '',
								'authorId' => 0,
								'asset' => '',
								'link' => false,
								'readonly' => false,
								'previewWidth' => 200,
								'previewHeight' => 200,
								'dataAttribute' => "",
								'mediaTypes' => '0,2',
								'imagesAllowedExt' => array(),
								'audiosAllowedExt' => array(),
								'videosAllowedExt' => array(),
								'documentsAllowedExt' => array(),
								'id' => $item->id . '_' . rand(0, 1000),
							];
							$layout = new FileLayout('joomla.form.field.media');
							$input = $layout->render($options);
						} else {
							$script = '
										jQuery(document).ready(function($){
											$("input#' . $item->id . '_' . $cnt . '").removeAttr("readonly");
										});
									  ';

							Factory::getDocument()->addScriptDeclaration($script);
						}
					}
				?>
				<div class="ja-item-<?php echo strtolower($item->type) ?>">
					<div>
						<?php echo $item->getLabel() ?>
					</div>
					<div>
						<?php echo $input; ?>
					</div>
				</div>
				<?php endforeach; ?>
				<div class="ja-action">
					<span class="btn action btn-clone" data-action="clone_row" title="<?php echo Text::_('JTOOLBAR_DUPLICATE'); ?>">
						<i class="icon-plus fa fa-plus-circle"><?php //echo Text::_('JTOOLBAR_DUPLICATE'); ?></i>
					</span>
					<span class="btn action btn-delete" data-action="delete_row" title="<?php echo Text::_('JTOOLBAR_REMOVE'); ?>">
						<i class="icon-minus fa fa-minus-circle"><?php //echo Text::_('JTOOLBAR_REMOVE'); ?></i>
					</span>
				</div>
			</div>
			<?php $cnt++; ?>
		<?php endforeach; ?>
	</div>
</div>
<script type="text/javascript">
	jQuery('.<?php echo $id ?>').jalist();
</script>