<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_finder
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

// Include the helper.
require_once dirname(__FILE__) . '/helper.php';

$helper = new MagentoProductsHelper();
// Get Smart Search query object.
$items = $helper->getList($params);

$doc = JFactory::getDocument();
$doc->addStyleSheet('modules/mod_magento_products/css/magentostyle.css');



require JModuleHelper::getLayoutPath('mod_magento_products', $params->get('layout', 'default'));
