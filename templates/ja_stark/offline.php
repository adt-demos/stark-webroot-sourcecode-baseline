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
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

$app = Factory::getApplication();

// Add JavaScript Frameworks
HTMLHelper::_('bootstrap.framework');

require_once JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php';

$twofactormethods = UsersHelper::getTwoFactorMethods();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/ja_stark/css/offline.css" type="text/css" />

	<!-- Load Google font -->
	<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>

	<?php if ($this->direction == 'rtl') : ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/offline_rtl.css" type="text/css" />
	<?php endif; ?>

</head>
<body>
<jdoc:include type="message" />

<div id="frame" class="outline">
	<?php if ($app->get('offline_image')) : ?>
		<div class="text-center">
			<img src="<?php echo $app->get('offline_image'); ?>" alt="<?php echo htmlspecialchars($app->get('sitename')); ?>" />
		</div>
	<?php endif; ?>

	<!-- Site name -->
	<h1><?php echo htmlspecialchars($app->get('sitename')); ?></h1>

	<!-- Offline message -->
	<?php if ($app->get('display_offline_message', 1) == 1 && str_replace(' ', '', $app->get('offline_message')) != '') : ?>
		<p class="offline-message"><?php echo $app->get('offline_message'); ?></p>
	<?php elseif ($app->get('display_offline_message', 1) == 2 && str_replace(' ', '', Text::_('JOFFLINE_MESSAGE')) != '') : ?>
		<p class="offline-message"><?php echo Text::_('JOFFLINE_MESSAGE'); ?></p>
	<?php endif; ?>
	<!-- // Offline message -->

	<form action="<?php echo Route::_('index.php', true); ?>" method="post" id="form-login">
		<fieldset class="input">
			<p id="form-login-username">
				<label for="username"><?php echo Text::_('JGLOBAL_USERNAME'); ?></label>
				<input name="username" id="username" type="text" class="inputbox" alt="<?php echo Text::_('JGLOBAL_USERNAME'); ?>" size="18" />
			</p>
			<p id="form-login-password">
				<label for="passwd"><?php echo Text::_('JGLOBAL_PASSWORD'); ?></label>
				<input type="password" name="password" class="inputbox" size="18" alt="<?php echo Text::_('JGLOBAL_PASSWORD'); ?>" id="passwd" />
			</p>
			<?php if (count($twofactormethods) > 1) : ?>
				<p id="form-login-secretkey">
					<label for="secretkey"><?php echo Text::_('JGLOBAL_SECRETKEY'); ?></label>
					<input type="text" name="secretkey" class="inputbox" size="18" alt="<?php echo Text::_('JGLOBAL_SECRETKEY'); ?>" id="secretkey" />
				</p>
			<?php endif; ?>
			<p id="submit-buton">
				<label>&nbsp;</label>
				<input type="submit" name="Submit" class="button login" value="<?php echo Text::_('JLOGIN'); ?>" />
			</p>
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="user.login" />
			<input type="hidden" name="return" value="<?php echo base64_encode(Uri::base()); ?>" />
			<?php echo HTMLHelper::_('form.token'); ?>
		</fieldset>
	</form>

</div>
</body>
</html>
