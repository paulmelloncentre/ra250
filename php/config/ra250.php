<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Cluster id
$config['cluster_id'] = 4;

// Article
$config['article_url_params'] = array(
		'start-date' => '',
		'end-date' => '',
		'article-category' => '',
		'year' => '',
		'search' => '',
		'author' => ''
	);

// Imprint date format
$config['imprint_date_format'] = "d F Y";

$config['orcid_base_url'] = "https://orcid.org/";

if(defined('ENVIRONMENT') && defined('MULTITENANCY_HOST'))
{
	switch (ENVIRONMENT) {
		case 'development':
			$config['disqus_shortname'] = 'ktdev';
			break;
		case 'staging':
			$config['disqus_shortname'] = 'rachronicle';
			break;
		default:
			$config['disqus_shortname'] = 'rachronicle';
			break;
	}
}

$config['preview_username'] = 'ra250';
$config['preview_password'] = 'ra250preview';
