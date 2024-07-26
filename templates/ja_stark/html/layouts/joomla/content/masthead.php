<?php
/**
 * ------------------------------------------------------------------------
 * JA Stark Template
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2018 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - Copyrighted Commercial Software
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites:  http://www.joomlart.com -  http://www.joomlancers.com
 * This file may not be redistributed in whole or significant part.
 * ------------------------------------------------------------------------
 */
defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Associations;

$params 	= $displayData['params'];
$title 		= $displayData['title'];
$item 		= $displayData['item'];
$canEdit = $params->get('access-edit');

$templateSettings =  $displayData['templateSettings'];

$info    	= $params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (Associations::isEnabled() && $params->get('show_associations'));

// Todo Not that elegant would be nice to group the params
$useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam);

$imageBg = $displayData['imageBg'];
?>

<?php if($imageBg != ''): ?>
	<div class="ja-masthead<?php echo $params->get('moduleclass_sfx','')?>">
		<div class="container">
			<div class="ja-masthead-detail">
				<?php if ($params->get('show_title')) : ?>
					<h3 class="ja-masthead-title"><?php echo $title; ?></h3>
				<?php endif; ?>

		        <?php if (($useDefList && ($info == 0 || $info == 2)) ) : ?>
					<div class="article-info">
						<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
							<?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
							<?php echo LayoutHelper::render('joomla.content.info_block', array('item' => $item, 'params' => $params, 'position' => 'above')); ?>
						<?php endif; ?>

						<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
						<?php echo $item->event->afterDisplayTitle; ?>
					</div>

				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>