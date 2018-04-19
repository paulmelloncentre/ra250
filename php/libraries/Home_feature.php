<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Home feature Class
 *
 * @package Libraries
 * @author Keepthinking
 **/
class Home_feature extends Base{

	/**
	 * @var $_table - table where home or landing features are
	 * @see self::get_list - where it's set
	 **/
	private $_table;
	
	/**
	 * Constructor
	 *
	 **/
	public function __construct()
	{
		parent::__construct();
		$this->model = $this->CI->m_home_feature;
	}

// ------------------------------------------------------------------------

	/**
	 * Get list of features
	 *
	 */
	public function get_list($params, $add_details = true)
	{
		return $this->model->get($params, $add_details = true);
	}

// ------------------------------------------------------------------------
	
	/**
	 * Render the list for the home page
	 *
	 */
	public function render_list($records)
	{
		$html = '';
		$type_group_number = 0;
		$feature_groups = array();
		$curr_feature_type = '';
		
		// Loop through the groups and create the views
		foreach($records as $features)
		{
			// Set current feature type
			if (empty($curr_feature_type))
				$curr_feature_type = current($features)->type;

			// Add media
			$features = $this->add_media($features, 'landing_feature');

			foreach ($features as $key => $feature) {
				// Check if the feature type is different from the current feature type
				// Create a new array block if it is
				if ($feature->type !== $curr_feature_type) {
					$curr_feature_type = $feature->type;
					$type_group_number++;
				}

				// Get landing feature links
				if (!$feature->link = @current(current($this->model->links($feature->id, 'landing_feature', '', $feature->reference, array())))) {
					unset($features[$key]);
					continue;
				}

				$feature_groups[$type_group_number][$feature->type][] = $feature;
			}

			// Remove $features var
			unset($features);

			// Loop through feature groups and load the appropriate view
			foreach ($feature_groups as $feature_group) {
				foreach ($feature_group as $type => $features) {
					switch ($type) {
						case 'image':
							$view = 'v_image';
							break;
						
						case 'carousel':
							$view = 'v_carousel';
							break;
					}

					$html .= $this->load->view(get_view(array('module'), $view), array('features' => $features), true);
				}
			}
		}
		
		// Return the views
		return $html;
	}
}

/* End of file Home_feature.php */
/* Location: ./application/libraries/default/Home_feature.php */