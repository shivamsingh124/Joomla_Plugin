<?php
// Using System Plugin (onAfterRender,onBeforeCompileHead,onContntPrepare)
//To prevent accessing the document directly, enter this code:
// no direct access
defined( '_JEXEC' ) or die( 'Access Deny' );                             // preventing direct access

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\Event\Event;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');								// To display all errors from strtup
error_reporting(E_ALL);

class PlgSystemheadingplugins extends JPlugin
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
		$this->loadLanguage('plg_system_headingplugins');
		parent::__construct($name, $arguments);
		$this->minimumJoomla = '3.9';													// Define the minumum versions to be supported.
		$this->minimumPhp    = '7.2.5';
	}
	public function onBeforeCompileHead()												// Used oncbeforecompileHead trigger function, to change the data before load and hence this is more time efficient
	{		try
		{
			$app = Factory::getApplication();
		}
		catch (Exception $e)
		{
			die('Failed to get app');
		}
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
		if(count((array)$content) > 1){								//To check whether content was changed else using JS Script
			JFactory::getApplication()->setBody($content);
			return;
		}
	// 	// If getBody returns Null because of prior execution then adding JS script to overwrite the above code
		if(JFactory::getApplication()->isClient('administrator')){	
            JFactory::getDocument()->addScriptDeclaration('
			document.addEventListener("DOMContentLoaded", (event) => {
				let h1Headlines= document.querySelectorAll("h1, h2, h3, h4, h5, h6");
				for(var i=0;i<h1Headlines.length;i++){
					h1Headlines[i].innerText += "'.$replacetext.' ";
				}
		  	})
        ');
		}
	}
}