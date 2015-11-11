<?php
/*------------------------------------------------------------------------
# plg_system_vm2finalize - Finalize order for Virtuemart 2 Plugin
# ------------------------------------------------------------------------
# author    Jeremy Magne
# copyright Copyright (C) 2010 Daycounts.com. All Rights Reserved.
# Websites: http://www.daycounts.com
# Technical Support: http://www.daycounts.com/en/contact/
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

class plgSystemIphoneiconInstallerScript {

	/**
	* Called on installation
	*
	* @param   JAdapterInstance  $adapter  The object responsible for running this script
	*
	* @return  boolean  True on success
	*/
	function install($adapter) {
	}

	/**
	* Called on uninstallation
	*
	* @param   JAdapterInstance  $adapter  The object responsible for running this script
	*/
	function uninstall($adapter) {
		//echo '<p>'. JText::_('1.6 Custom uninstall script') .'</p>';
	}

	/**
	* Called on update
	*
	* @param   JAdapterInstance  $adapter  The object responsible for running this script
	*
	* @return  boolean  True on success
	*/
	function update($adapter) {
		//echo '<p>'. JText::_('1.6 Custom update script') .'</p>';
	}

	/**
	* Called before any type of action
	*
	* @param   string  $route  Which action is happening (install|uninstall|discover_install)
	* @param   JAdapterInstance  $adapter  The object responsible for running this script
	*
	* @return  boolean  True on success
	*/
	function preflight($route, $adapter) {
		//echo '<p>'. JText::sprintf('1.6 Preflight for %s', $route) .'</p>';
	}

	/**
	* Called after any type of action
	*
	* @param   string  $route  Which action is happening (install|uninstall|discover_install)
	* @param   JAdapterInstance  $adapter  The object responsible for running this script
	*
	* @return  boolean  True on success
	*/
	function postflight($route, $adapter) {
		
		if ($route=='update') {
			$oldfolders = array();
			$oldfolders[] = JPATH_SITE."/plugins/system/iphoneicon/iphoneicon/elements";
			foreach ($oldfolders as $oldfolder) {
				if (JFolder::exists($oldfolder))
					JFolder::delete($oldfolder);
			}
	
			$oldfiles = array();
			//Remove plugin translation files as they were moved to the new location directly in plugin folder
			$oldfiles[] = JPATH_ADMINISTRATOR."/language/en-GB/en-GB.plg_system_iphoneicon.ini";
			$oldfiles[] = JPATH_ADMINISTRATOR."/language/en-GB/en-GB.plg_system_iphoneicon.sys.ini";
			
			foreach ($oldfiles as $oldfile) {
				if (JFile::exists($oldfile))
					JFile::delete($oldfile);
			}
		}
		
		if ($route=='install' || $route=='update') {
			$url = 'index.php?option=com_plugins&filter_search=iPhone%20Icon';
			echo '<br/><p><a href="'.$url.'">'. JText::_('PLG_II_CONFIGURE').'</a></p>';
		}
	}
}