<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$template_path = @file_exists(FCPATH . 'skins/'.MULTITENANCY_SKIN.'/php/controllers/template_custom.php') ?
	'template_custom' :
	'template';

// Google map
$route['citation/(:any)'] = "{$template_path}/citation/$1";
$route['doi/(:any)'] = "{$template_path}/doi/$1";
// $route['lightbox/(:any)'] = "{$template_path}/lightbox/$1";

/* End of file routes.php */
/* Location: ./skins/ra250/php/config/routes.php */