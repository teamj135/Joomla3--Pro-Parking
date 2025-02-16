<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Proparking
 * @author     Synapse India  <info@synapseindia.com>
 * @copyright  2020 Synapse India
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\Rules\StandardRules;
use Joomla\CMS\Component\Router\Rules\NomenuRules;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Joomla\CMS\Factory;
use Joomla\CMS\Categories\Categories;

/**
 * Class ProparkingRouter
 *
 */
class ProparkingRouter extends RouterView
{
	private $noIDs;
	public function __construct($app = null, $menu = null)
	{
		$params = JComponentHelper::getComponent('com_proparking')->params;
		$this->noIDs = (bool) $params->get('sef_ids');
		
		
			$parkinglots = new RouterViewConfiguration('parkinglots');
		$this->registerView($parkinglots);
			$ccParkinglot = new RouterViewConfiguration('parkinglot');
			$ccParkinglot->setKey('id')->setParent($parkinglots);
			$this->registerView($ccParkinglot);
			$parkinglotform = new RouterViewConfiguration('parkinglotform');
			$parkinglotform->setKey('id');
			$this->registerView($parkinglotform);

		parent::__construct($app, $menu);

		$this->attachRule(new MenuRules($this));

		if ($params->get('sef_advanced', 0))
		{
			$this->attachRule(new StandardRules($this));
			$this->attachRule(new NomenuRules($this));
		}
		else
		{
			JLoader::register('ProparkingRulesLegacy', __DIR__ . '/helpers/legacyrouter.php');
			JLoader::register('ProparkingHelpersProparking', __DIR__ . '/helpers/proparking.php');
			$this->attachRule(new ProparkingRulesLegacy($this));
		}
	}


	
		/**
		 * Method to get the segment(s) for an parkinglot
		 *
		 * @param   string  $id     ID of the parkinglot to retrieve the segments for
		 * @param   array   $query  The request that is built right now
		 *
		 * @return  array|string  The segments of this item
		 */
		public function getParkinglotSegment($id, $query)
		{
			return array((int) $id => $id);
		}
			/**
			 * Method to get the segment(s) for an parkinglotform
			 *
			 * @param   string  $id     ID of the parkinglotform to retrieve the segments for
			 * @param   array   $query  The request that is built right now
			 *
			 * @return  array|string  The segments of this item
			 */
			public function getParkinglotformSegment($id, $query)
			{
				return $this->getParkinglotSegment($id, $query);
			}

	
		/**
		 * Method to get the segment(s) for an parkinglot
		 *
		 * @param   string  $segment  Segment of the parkinglot to retrieve the ID for
		 * @param   array   $query    The request that is parsed right now
		 *
		 * @return  mixed   The id of this item or false
		 */
		public function getParkinglotId($segment, $query)
		{
			return (int) $segment;
		}
			/**
			 * Method to get the segment(s) for an parkinglotform
			 *
			 * @param   string  $segment  Segment of the parkinglotform to retrieve the ID for
			 * @param   array   $query    The request that is parsed right now
			 *
			 * @return  mixed   The id of this item or false
			 */
			public function getParkinglotformId($segment, $query)
			{
				return $this->getParkinglotId($segment, $query);
			}
}
