<?php
/*------------------------------------------------------------------------
# plg_iphoneicon - iPhone Icon system plugin
# ------------------------------------------------------------------------
# author    Jeremy Magne
# copyright Copyright (C) 2010 Daycounts.com. All Rights Reserved.
# Websites: http://www.daycounts.com
# Technical Support: http://www.daycounts.com/en/contact/
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
-------------------------------------------------------------------------*/

defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.environment.browser');
jimport('joomla.filesystem.file');

class plgSystemIphoneIcon extends JPlugin
{

	function plgSystemIphoneIcon(& $subject, $params )
	{
		parent::__construct( $subject, $params );
	}

	function onAfterDispatch()
	{
		$mainframe = JFactory::getApplication('site');
		// if it's administrator section, then do nothing

		$browser = JBrowser::getInstance();
		$agent = $browser->getAgentString();
		$document = JFactory::getDocument();
		
		if ($this->params->get('title')) {
			$document->setMetaData('apple-mobile-web-app-title', $this->params->get('title'));
		}
		
		if (strpos($agent,"iPhone") || strpos($agent,"iPad") || strpos($agent,"iPod") || $this->params->get('debug')){

			if ($this->params->get('fullscreen')) {
				//Full screen
				$document->setMetaData('apple-mobile-web-app-capable', 'yes');

				//Status bar
				if ($this->params->get('statusbar')) {
					$document->setMetaData('apple-mobile-web-app-status-bar-style', 'black');
				}
			}
				
			//Should we add a gloss to the icon ?
			$precomposed = ($this->params->get('gloss')) ? "" : "-precomposed";
			
			//iPhone
			if ($this->params->get('icon')) {
				$document->addHeadLink(JURI::base().$this->params->get('icon') , 'apple-touch-icon'.$precomposed, 'rel', array('sizes'=>'57x57') );
				//$document->_links['/'.$this->params->get('icon')]['relType'] = 'rel';
				//$document->_links['/'.$this->params->get('icon')]['relation'] = 'apple-touch-icon'.$precomposed;
				//$document->_links['/'.$this->params->get('icon')]['attribs']['sizes'] = '57x57';
			}
			if ($this->params->get('startup')) {
				$document->addHeadLink(JURI::base().$this->params->get('startup') , 'apple-touch-startup-image', 'rel', array('media'=>'(device-width: 320px) and (device-width: 480px) and (-webkit-device-pixel-ratio: 1)') );
				//$document->_links['/'.$this->params->get('startup')]['relType'] = 'rel';
				//$document->_links['/'.$this->params->get('startup')]['relation'] = 'apple-touch-startup-image';
				//$document->_links['/'.$this->params->get('startup')]['attribs']['media'] = '(device-width: 320px) and (device-width: 480px) and (-webkit-device-pixel-ratio: 1)';
			}

			//iPhone Retina
			if ($this->params->get('icon_iphone4')) {
				$document->addHeadLink(JURI::base().$this->params->get('icon_iphone4') , 'apple-touch-icon'.$precomposed, 'rel', array('sizes'=>'114x114') );
				//$document->_links['/'.$this->params->get('icon_iphone4')]['relType'] = 'rel';
				//$document->_links['/'.$this->params->get('icon_iphone4')]['relation'] = 'apple-touch-icon'.$precomposed;
				//$document->_links['/'.$this->params->get('icon_iphone4')]['attribs']['sizes'] = '114x114';
			}
			if ($this->params->get('startup-high')) {
				$document->addHeadLink(JURI::base().$this->params->get('startup-high') , 'apple-touch-startup-image', 'rel', array('media'=>'(device-width: 320px) and (device-width: 480px) and (-webkit-device-pixel-ratio: 2)') );
				//$document->_links['/'.$this->params->get('startup-high')]['relType'] = 'rel';
				//$document->_links['/'.$this->params->get('startup-high')]['relation'] = 'apple-touch-startup-image';
				//$document->_links['/'.$this->params->get('startup-high')]['attribs']['media'] = '(device-width: 320px) and (device-width: 480px) and (-webkit-device-pixel-ratio: 2)';
			}

			//iPhone 5
			if ($this->params->get('startup-iphone5')) {
				$document->addHeadLink(JURI::base().$this->params->get('startup-iphone5') , 'apple-touch-startup-image', 'rel', array('media'=>'(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)') );
				//$document->_links['/'.$this->params->get('startup-iphone5')]['relType'] = 'rel';
				//$document->_links['/'.$this->params->get('startup-iphone5')]['relation'] = 'apple-touch-startup-image';
				//$document->_links['/'.$this->params->get('startup-iphone5')]['attribs']['media'] = '(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)';
			}

			//iPad
			if ($this->params->get('icon_ipad')) {
				$document->addHeadLink(JURI::base().$this->params->get('icon_ipad') , 'apple-touch-icon'.$precomposed, 'rel', array('sizes'=>'72x72') );
				//$document->_links['/'.$this->params->get('icon_ipad')]['relType'] = 'rel';
				//$document->_links['/'.$this->params->get('icon_ipad')]['relation'] = 'apple-touch-icon'.$precomposed;
				//$document->_links['/'.$this->params->get('icon_ipad')]['attribs']['sizes'] = '72x72';
			}
			if ($this->params->get('startup-ipad-l')) {
				$document->addHeadLink(JURI::base().$this->params->get('startup-ipad-l') , 'apple-touch-startup-image', 'rel', array('media'=>'(device-width: 768px) and (device-width: 1024px) and (orientation:landscape) and (-webkit-device-pixel-ratio: 1)') );
				//$document->_links['/'.$this->params->get('startup-ipad-l')]['relType'] = 'rel';
				//$document->_links['/'.$this->params->get('startup-ipad-l')]['relation'] = 'apple-touch-startup-image';
				//$document->_links['/'.$this->params->get('startup-ipad-l')]['attribs']['media'] = '(device-width: 768px) and (device-width: 1024px) and (orientation:landscape) and (-webkit-device-pixel-ratio: 1)';
			}
			if ($this->params->get('startup-ipad-p')) {
				$document->addHeadLink(JURI::base().$this->params->get('startup-ipad-p') , 'apple-touch-startup-image', 'rel', array('media'=>'(device-width: 481px) and (device-width: 1024px) and (orientation:portrait) and (-webkit-device-pixel-ratio: 1)') );
				//$document->_links['/'.$this->params->get('startup-ipad-p')]['relType'] = 'rel';
				//$document->_links['/'.$this->params->get('startup-ipad-p')]['relation'] = 'apple-touch-startup-image';
				//$document->_links['/'.$this->params->get('startup-ipad-p')]['attribs']['media'] = '(device-width: 481px) and (device-width: 1024px) and (orientation:portrait) and (-webkit-device-pixel-ratio: 1)';
			}

			//iPad Retina
			if ($this->params->get('icon_ipadhigh')) {
				$document->addHeadLink(JURI::base().$this->params->get('icon_ipadhigh') , 'apple-touch-icon'.$precomposed, 'rel', array('sizes'=>'144x144') );
				//$document->_links['/'.$this->params->get('icon_ipadhigh')]['relType'] = 'rel';
				//$document->_links['/'.$this->params->get('icon_ipadhigh')]['relation'] = 'apple-touch-icon'.$precomposed;
				//$document->_links['/'.$this->params->get('icon_ipadhigh')]['attribs']['sizes'] = '144x144';
			}
			if ($this->params->get('startup-ipad-high-l')) {
				$document->addHeadLink(JURI::base().$this->params->get('startup-ipad-high-l') , 'apple-touch-startup-image', 'rel', array('media'=>'(device-width: 768px) and (device-width: 1024px) and (orientation:landscape) and (-webkit-device-pixel-ratio: 2)') );
				//$document->_links['/'.$this->params->get('startup-ipad-high-l')]['relType'] = 'rel';
				//$document->_links['/'.$this->params->get('startup-ipad-high-l')]['relation'] = 'apple-touch-startup-image';
				//$document->_links['/'.$this->params->get('startup-ipad-high-l')]['attribs']['media'] = '(device-width: 768px) and (device-width: 1024px) and (orientation:landscape) and (-webkit-device-pixel-ratio: 2)';
			}
			if ($this->params->get('startup-ipad-high-p')) {
				$document->addHeadLink(JURI::base().$this->params->get('startup-ipad-high-p') , 'apple-touch-startup-image', 'rel', array('media'=>'(device-width: 481px) and (device-width: 1024px) and (orientation:portrait) and (-webkit-device-pixel-ratio: 2)') );
				//$document->_links['/'.$this->params->get('startup-ipad-high-p')]['relType'] = 'rel';
				//$document->_links['/'.$this->params->get('startup-ipad-high-p')]['relation'] = 'apple-touch-startup-image';
				//$document->_links['/'.$this->params->get('startup-ipad-high-p')]['attribs']['media'] = '(device-width: 481px) and (device-width: 1024px) and (orientation:portrait) and (-webkit-device-pixel-ratio: 2)';
			}
		}


		return true;
	}
	
	function onAfterRender() {
		$document = JFactory::getDocument();
		$buffer = $document->getBuffer('component');
		$buffer = JResponse::getBody();

			$patterns = array();
			$patterns[] = '@/templates/mobile_elegance/touch-icon-57x57.png@si';
			$patterns[] = '@/templates/mobile_elegance/touch-icon-precomposed-57x57.png@si';
			$patterns[] = '@/templates/mobile_elegance/touch-icon-72x72.png@si';
			$patterns[] = '@/templates/mobile_elegance/touch-icon-precomposed-72x72.png@si';
			$patterns[] = '@/templates/mobile_elegance/touch-icon-114x114.png@si';
			$patterns[] = '@/templates/mobile_elegance/touch-icon-precomposed-114x114.png@si';
			$patterns[] = '@/templates/mobile_elegance/touch-icon-144x144.png@si';
			$patterns[] = '@/templates/mobile_elegance/touch-icon-precomposed-144x144.png@si';
			$patterns[] = '@/templates/mobile_elegance/touch-startup-image-320x460.png@si';
			$replacements = array();
			$replacements[] = $this->params->get('icon');
			$replacements[] = $this->params->get('icon');
			$replacements[] = $this->params->get('icon_ipad');
			$replacements[] = $this->params->get('icon_ipad');
			$replacements[] = $this->params->get('icon_iphone4');
			$replacements[] = $this->params->get('icon_iphone4');
			$replacements[] = $this->params->get('icon_ipadhigh');
			$replacements[] = $this->params->get('icon_ipadhigh');
			$replacements[] = $this->params->get('startup');

		$buffer = preg_replace($patterns, $replacements, $buffer,1);
		JResponse::setBody($buffer);
		return true;
	}

}