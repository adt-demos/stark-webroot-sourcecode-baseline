<?php
/**
T4 Overide
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\HTML\HTMLHelper;
//use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use T4\Helper\J3J4;

// Create a shortcut for params.
$params = $this->item->params;
$canEdit = $this->item->params->get('access-edit');
$info    = $params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (Associations::isEnabled() && $params->get('show_associations'));

?>
<div class="item-content-wrap">
	<?php echo LayoutHelper::render('joomla.content.intro_image', $this->item); ?>
	<div class="item-info">
		<div class="inner item-content">
			<?php if (J3J4::checkUnpublishedContent($this->item) || strtotime($this->item->publish_up) > strtotime(Factory::getDate())
				|| ((strtotime($this->item->publish_down??'') < strtotime(Factory::getDate()??'')) && $this->item->publish_down != Factory::getDbo()->getNullDate())) : ?>
				<div class="system-unpublished">
			<?php endif; ?>

			<?php echo LayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>

			<?php // Todo Not that elegant would be nice to group the params ?>
			<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
				|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>

			<?php if (!$params->get('show_intro')) : ?>
				<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
				<?php echo $this->item->event->afterDisplayTitle; ?>
			<?php endif; ?>

			<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
			<?php echo $this->item->event->beforeDisplayContent; ?>

			<?php if ($params->get('show_intro')) : ?>
				<?php echo HTMLHelper::_('string.truncate', strip_tags($this->item->introtext), 200 ); ?>
			<?php endif; ?>

			<?php if ($params->get('show_readmore') && $this->item->readmore) :
				if ($params->get('access-view')) :
					$link = Route::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
				else :
					$menu = Factory::getApplication()->getMenu();
					$active = $menu->getActive();
					$itemId = $active->id;
					$link = new Uri(Route::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false));
					$link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)));
				endif; ?>

				<?php echo LayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>

			<?php endif; ?>

			<?php if (J3J4::checkUnpublishedContent($this->item) || strtotime($this->item->publish_up) > strtotime(Factory::getDate())
				|| ((strtotime($this->item->publish_down??'') < strtotime(Factory::getDate()??'')) && $this->item->publish_down != Factory::getDbo()->getNullDate())) : ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
<?php echo $this->item->event->afterDisplayContent; ?>
