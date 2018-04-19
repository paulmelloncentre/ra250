<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Home/Landing Model
 * User by the Navigation Library
 *
 * @package Models
 * @author Keepthinking
 * @since 2012
 **/
class M_home_feature extends M_common_custom
{
	
	public function __construct()
	{
		parent::__construct();
	}

// ------------------------------------------------------------------------
	
	/**
	* Get features
	*
	* @return Array
	**/	
	public function get($params = array(), $add_details = true)
	{
		$query = $this->db->select("
				f.id,
				f.name as title,
				f.rank,
				f.reference
			")
			->from("home_feature f")
			->where($this->_online("f"))
			->order_by("f.rank");

		if (!empty($params))
		{
			foreach ($params as $key => $value)
			{
				switch ($key) {
					case 'node_id':
						$query->where("f.node_id", $value);
						break;
					
					default:
						# code...
						break;
				}
			}
		}
		
		$result = $query->get()->result();
		
		if ($result && $add_details)
		{
			foreach($result as $item)
				$item->link = @current(current($this->links($item->id, 'home_feature', '', $item->reference, array())));
		}
		return($result);
	}
}

/* End of file m_home_feature.php */
/* Location: ./skins/ra250/php/models/m_home_feature.php */