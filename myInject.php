<?php
// Using System Plugin (onAfterRender,onBeforeCompileHead)
//To prevent accessing the document directly, enter this code:
// no direct access
defined( '_JEXEC' ) or die( 'Access Deny' );
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\Event;
// error_reporting(E_ALL);
// ini_set('display_errors',l);

class PlgSystemmyInject extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.6
	 */
	public function __construct()
	{
		// Define the minumum versions to be supported.
		$this->minimumJoomla = '3.9';
		$this->minimumPhp    = '7.2.5';
	}
	public function onBeforeCompileHead()
	{
		$app=JFactory::getApplication();
		$document = JFactory::getDocument();
		// $body = JResponse::getBody(); 													deprecated
		$content= JFactory::getApplication()->getBody();
		//JResponse::setBody($body); 														deprecated
		$replacetext = $params->get('inputarea');
		if (preg_match_all('/(<h1.*?)(class *= *"|\')(.*)("|\')(.*>)/is', $content, $matches))
{
				$content = preg_replace(
					'/(<h1.*?)(class *= *"|\')(.*)("|\')(.*>)/is',
					'<h1>'.$replacetext.'</h1>',
					$content);
} 
		elseif (preg_match_all('/(<h1.*?)(>)/is', $content, $matches))
{
				$content = preg_replace(
					'/(<h1.*?)(>)/',
					'<h1>'.$replacetext.'</h1>',
					$content);
}
		JFactory::getApplication()->setBody($content);
		// $input_area=$this->params->get('input_area', defaultsetting);
	}
}