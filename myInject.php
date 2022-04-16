<?php
//First start with information about the Plugin and yourself. For example:
/**
 * @package     Joomla.Plugin
 * @subpackage  Search.myInject
 *
 * @copyright   Copyright
 * @license     License, for example GNU/GPL
 */

//To prevent accessing the document directly, enter this code:
// no direct access
defined( '_JEXEC' ) or die( 'Access Deny' );
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\Event;
use Joomla\Event\SubscriberInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
// Require the component's router file (Replace 'nameofcomponent' with the component your providing the search for
// require_once JPATH_SITE .  '/components/nameofcomponent/helpers/route.php';

// error_reporting(E_ALL);
// ini_set('display_errors',l);


class PlgContentmyInject extends JPlugin
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

	public function onContentPrepare($content, $article, $params, $limit)
	{
		$input_area=$this->params->get('input_area', defaultsetting);
		$app=JFactory::getApplication();
		// JFactory::getUser(); 
		// $input=$app->getMenu();
		// $item=$input->getItem($input_box);
		// $url=JRoute::_($item->link.'&itemId='.$input_box);
		// $app->redirect($url,'Login successful');
	}
}