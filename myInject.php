<?php
//First start with information about the Plugin and yourself. For example:
/**
 * @package     Joomla.Plugin
 * @subpackage  Search.nameofplugin
 *
 * @copyright   Copyright
 * @license     License, for example GNU/GPL
 */

//To prevent accessing the document directly, enter this code:
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Require the component's router file (Replace 'nameofcomponent' with the component your providing the search for
require_once JPATH_SITE .  '/components/nameofcomponent/helpers/route.php';

/**
 * All functions need to get wrapped in a class
 *
 * The class name should start with 'PlgSearch' followed by the name of the plugin. Joomla calls the class based on the name of the plugin, so it is very important that they match
 */
class PlgSearchNameofplugin extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.6
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	// Define a function to return an array of search areas. Replace 'nameofplugin' with the name of your plugin.
	// Note the value of the array key is normally a language string
	function onContentSearchAreas()
	{
		static $areas = array(
			'nameofplugin' => 'Nameofplugin'
		);
		return $areas;
	}

	// The real function has to be created. The database connection should be made. 
	// The function will be closed with an } at the end of the file.
	/**
	 * The sql must return the following fields that are used in a common display
	 * routine: href, title, section, created, text, browsernav
	 *
	 * @param string Target search string
	 * @param string mathcing option, exact|any|all
	 * @param string ordering option, newest|oldest|popular|alpha|category
	 * @param mixed An array if the search it to be restricted to areas, null if search all
	 */
	function onContentSearch( $text, $phrase='', $ordering='', $areas=null )
	{
		$user	= JFactory::getUser(); 
		$groups	= implode(',', $user->getAuthorisedViewLevels());

		// If the array is not correct, return it:
		if (is_array( $areas )) {
			if (!array_intersect( $areas, array_keys( $this->onContentSearchAreas() ) )) {
				return array();
			}
		}

		// Now retrieve the plugin parameters like this:
		$nameofparameter = $this->params->get('nameofparameter', defaultsetting );

		// Use the PHP function trim to delete spaces in front of or at the back of the searching terms
		$text = trim( $text );

		// Return Array when nothing was filled in.
		if ($text == '') {
			return array();
		}

		// After this, you have to add the database part. This will be the most difficult part, because this changes per situation.
		// In the coding examples later on you will find some of the examples used by Joomla! 3.1 core Search Plugins.
		//It will look something like this.
		$wheres = array();
		switch ($phrase) {

			// Search exact
			case 'exact':
				$text		= $this->db->Quote( '%'.$this->db->escape( $text, true ).'%', false );
				$wheres2 	= array();
				$wheres2[] 	= 'LOWER(a.name) LIKE '.$text;
				$where 		= '(' . implode( ') OR (', $wheres2 ) . ')';
				break;

			// Search all or any
			case 'all':
			case 'any':

			// Set default
			default:
				$words 	= explode( ' ', $text );
				$wheres = array();
				foreach ($words as $word)
				{
					$word		= $this->db->Quote( '%'.$this->db->escape( $word, true ).'%', false );
					$wheres2 	= array();
					$wheres2[] 	= 'LOWER(a.name) LIKE '.$word;
					$wheres[] 	= implode( ' OR ', $wheres2 );
				}
				$where = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
				break;
		}

		// Ordering of the results
		switch ( $ordering ) {

			//Alphabetic, ascending
			case 'alpha':
				$order = 'a.name ASC';
				break;

			// Oldest first
			case 'oldest':

			// Popular first
			case 'popular':

			// Newest first
			case 'newest':

			// Default setting: alphabetic, ascending
			default:
				$order = 'a.name ASC';
		}

		// Replace nameofplugin
		$section = JText::_( 'Nameofplugin' );

		// The database query; differs per situation! It will look something like this (example from newsfeed search plugin):
		$query	= $this->db->getQuery(true);
		$query->select('a.name AS title, "" AS created, a.link AS text, ' . $case_when."," . $case_when1);
				$query->select($query->concatenate(array($this->db->Quote($section), 'c.title'), " / ").' AS section');
				$query->select('"1" AS browsernav');
				$query->from('#__nameofcomponent AS a');
				$query->innerJoin('#__categories as c ON c.id = a.catid');
				$query->where('('. $where .')' . 'AND a.published IN ('.implode(',', $state).') AND c.published = 1 AND c.access IN ('. $groups .')');
				$query->order($order);

		// Set query
		$this->db->setQuery( $query, 0, $limit );
		$rows = $this->db->loadObjectList();

		// The 'output' of the displayed link. Again a demonstration from the newsfeed search plugin
		foreach($rows as $key => $row) {
			$rows[$key]->href = 'index.php?option=com_newsfeeds&view=newsfeed&catid='.$row->catslug.'&id='.$row->slug;
		}

	//Return the search results in an array
	return $rows;
	}
}