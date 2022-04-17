<?php
// Using System Plugin (onAfterRender,onBeforeCompileHead,onContntPrepare)
//To prevent accessing the document directly, enter this code:
// no direct access
defined( '_JEXEC' ) or die( 'Access Deny' );

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\Event;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

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
	protected $app;

	public function __construct($name, array $arguments = array())
	{
		// Define the minumum versions to be supported.
		$this->loadLanguage('plg_system_myInject');
		parent::__construct($name, $arguments);
		$this->minimumJoomla = '3.9';
		$this->minimumPhp    = '7.2.5';
	}
	public function onBeforeCompileHead()
	{
		$app=JFactory::getApplication();
		$document = JFactory::getDocument();
		// $body = JResponse::getBody(); 													deprecated joomla 3.0
		$content= $app->getBody();
		//JResponse::setBody($body); 														deprecated
		$replacetext = $this->params->get('Inputarea','Joomla');

		// echo "<script type='text/javascript'>";
		// echo " alert('$replacetext')"; 												To Display Replaced Value
		// echo "</script>";
		
		if(JFactory::getApplication()->isClient('administrator')){						// To check it is working in backend

			if (preg_match_all('/(<h.*?)(class *= *"|\')(.*)("|\')(.*>)/is', $content, $matches))
				{
					
					$content = preg_replace(
						'/(<h.*?)(class *= *"|\')(.*)("|\')(.*>)/is',
						'<h1>'.$replacetext.'</h1>',
						$content);
				} 
			elseif (preg_match_all('/(<h.*?)(.*>)/is', $content, $matches))
				{
					$content = preg_replace(
						'/(<h.*?)(.*>)/is',
						'<h1>'.$replacetext.'</h1>',
						$content);
				}
		}
		JFactory::getApplication()->setBody($content);
		// If getBody returns Null because of prior execution then adding JS script to overwrite the above code
		if(JFactory::getApplication()->isClient('administrator')){	
			JFactory::getDocument()->addScriptDeclaration("
			var elements = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
			for(var i=0;i<elements.length;i++){
				elements[i].innerText+=$replacetext;
			}
			");
		}
	}
}