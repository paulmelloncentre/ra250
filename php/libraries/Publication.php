<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Publication Class
 *
 * @package Libraries
 * @author Keepthinking
 **/
class Publication extends Base{

	/**
	 * Constructor
	 *
	 **/
	public function __construct(){
		parent::__construct();
		$this->model = $this->CI->m_publication;
	}

	public function get_data($cluster_id){
		return $this->model->get_publications($cluster_id);
	}
}

/* End of file Publication.php */
/* Location: ./skins/ra250/php/libraries/Publication.php */