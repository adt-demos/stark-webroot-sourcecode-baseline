<?php
/**
 * ------------------------------------------------------------------------
 * JA Masthead Module 
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2018 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites: http://www.joomlart.com - http://www.joomlancers.com
 * ------------------------------------------------------------------------
 */

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ModuleHelper;

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once (dirname(__FILE__).'/helper.php');
$helper = ModJAMastheadHelper::getInstance();

//Load style
HTMLHelper::stylesheet('modules/' . $module->module . '/asset/css/style.css');

// Get masshead information
$masthead = $helper->getMasthead($params);
// Display
require ModuleHelper::getLayoutPath($module->module, $params->get('layout', 'default'));