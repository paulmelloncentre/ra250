<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Article Model
 * User by the Article Library
 *
 * @package Models
 * @author Keepthinking
 * @since 2015
 **/

class M_article extends M_common_custom
{
	public function __construct()
	{
		parent::__construct();
	}

// ------------------------------------------------------------------------

	/**
	 * Get filter
	 * @param  array $params filter parameters
	 * @return array
	 */
	public function get_filter($params)
	{
		$result = $this->get_article($params, false, false);
		if($result->records)
		{
			// Setup the array
			$filter = array();

			foreach($result->records as $item)
			{
				if(!empty($item->category_reference))
				{
					if (empty($filter[$item->category_reference]))
						$filter[$item->category_reference] = $item->category;
				}
			}
			ksort($filter);
			$filter = array('' => lang('all')) + $filter;
			return $filter;
		}
	}

// ------------------------------------------------------------------------
	
	/**
	* Get Year filter
	*
	* @return Array
	**/	
	public function get_year_filter($params)
	{
		$filter = array();
		
		$result = $this->get_article($params, false, false);
		
		if($result->records)
		{
			foreach($result->records as $item)
			{
				$filter[date("Y", strtotime($item->publish_date))] = date("Y", strtotime($item->publish_date));
			}
		}

		arsort($filter);
		return $filter;
	}

// ------------------------------------------------------------------------

	/**
	 * Increase view count
	 * @param  Int] $id
	 * @return void
	 */
	public function increase_view_count($id)
	{
		$sql = "UPDATE `article` SET `views` = COALESCE(`views`, 0)+1 WHERE `id` = {$id}";
		$this->db->query($sql);
	}
}

/* End of file m_article.php */
/* Location: ./skins/ra250/php/models/m_article.php */