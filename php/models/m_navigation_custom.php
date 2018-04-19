<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Navigation Model
 * User by the Navigation Library
 *
 * @package Models
 * @author Keepthinking
 * @since 2012
 **/

require(APPPATH . 'models/m_navigation.php');
class M_navigation_custom extends M_navigation 
{
	public $parent_tree;

// ------------------------------------------------------------------------

	/**
	 * undocumented function
	 *
	 * @return void
	 * @author Cristiano Bianchi
	 **/
	public function __construct()
	{
		parent::__construct();
	}


// ------------------------------------------------------------------------

	/**
	 * Main navigation
	 *
	 * @return void
	 * @author Cristiano Bianchi
	 **/
	function get_main_navigation($cluster_id = null)
	{
		$this->db->select("
				n.id,
				section.name,
				section.controller,
				colour.class as theme_class,
				coalesce(t.method, 'page') AS template,
				c.id as page_id,
				c.reference,
				c.rank as page_rank,
				GROUP_CONCAT(DISTINCT lf.id) as landing_feature_id
			")
			->from("_conf_node n")
			->join("page c","c.node_id = n.id")
			->join("page_template t","t.id = c.page_template_id", "left")
			->join('section', 'section.id = n.id')
			->join("colour", "colour.id = section.colour_id and " . $this->_online("c"), "left")
			->join("section_landing_feature_xrefs lx", "lx.section_id = section.id and " . $this->_online("lx"), "left")
			->join("landing_feature lf", "lx.landing_feature_id = lf.id and " . $this->_online("lf"), "left")
			->where("n.display", 1)
			->where($this->_online("section"))
			->where($this->_online("c"))
			->where("c.parent_id", NULL)
			// ->where("c.rank = 1")  //fixes for #14209 (won't showing section when there is no rank 1 record)
			->group_by("n.id")
			->order_by("n.rank");
		
		if ($cluster_id)
			$this->db->where('n.cluster_id', $cluster_id);

		$result = $this->db->get()->result();
		if ($result) 
		{
			foreach ($result as $item) 
			{
				if (!empty($item->landing_feature_id)) {
					if ($landing_feature = $this->get_landing_feature(array('id' => $item->landing_feature_id)))
						$item->feature = $landing_feature;
				}
			}
			return index_by($result, 'controller');
		}
		return null;
	}
}


/* End of file m_navigation.php */
/* Location: ./application/models/m_navigation.php */