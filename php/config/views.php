<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// View folder mapping
$config['template_to_view_folder_mapping'] = array(
	'home_feature' => 'home'
);

/**
 * View structure for PMC Website
 */

// Views Default & Custom Layout & Rendered HTML
$config['rendered_html'] = array('pagination', 'toolbar', 'filter', 'landing_features', 'main_content');

$config['views']['default'] = array(
	'list' => array(
			'header'	=> array('navigation/v_main_navigation' => ''),
			'hero' => array(),
			'content'	=> array(),
			'body'		=> array(),
			'content_complementary' => array(),
			'page'		=> array('main_content' => 'main_content'),
			'page_complimentary' => array(),
			'footer'	=> array('common/v_footer' => ''),
		),
	'single' => array(
			'header'	=> array('navigation/v_main_navigation' => ''),
			'hero'		=> array(),
			'content'	=> array(),
			'body'		=> array(
					'v_toolbar' => '',
					'v_header_section' => '!banner',
					'v_bodytext' => 'description',
					'v_document' => 'files'
				),
			'content_complementary' =>array(),
			'page'		=> array(),
			'page_complimentary' => array('links' => ''),
			'footer'	=> array('common/v_footer' => '')
		)
	);


/**
 * Page views
 */
$config['views']['page'] = array(
	'single' => array(
		'hero' => array('v_banner' => 'banner'),
		'body' => array(
			'v_toolbar' => '',
			'v_header' => '!banner',
			'v_bodytext' => 'description',
			'v_document' => 'files',
			'v_comment' => 'enable_comments=1',
		)
	)
);

/**
 * Footer page views
 */

$config['views']['footer_page'] = array(
	'list' => array(
		'hero' => array('v_banner' => 'banner'),
		'body' => array(
			'v_toolbar' => '',
			'v_header' => '!banner',
			'v_bodytext' => 'description',
			'v_document' => 'files'
		)
	)
);


/**
 * Contact page views
 */
$config['views']['contact'] = array(
	'single' => array(
		'hero' => array('v_banner_section' => 'banner'),
		'body' => array(
			'v_toolbar' => '',
			'v_header_section' => '!banner',
			'v_contact_details' => 'preference_organisation_address|preference_organisation_telephone|preference_organisation_fax',
			'common/v_contact_form' => '',
			'v_document' => 'files'
		)
	)
);


/**
 * Search views
 */
$config['views']['search'] = array(
	'list' => array(
		'page' => array(
			'v_header' => '',
			'v_search_filter' => '',
			'v_bas_results' => 'bas_results',
			'pagination' => 'pagination',
			'v_website_results' => 'website_results',
			'v_view_more' => ''
		)
	)
);

/**
 * Home feature views
 */
$config['views']['home_feature'] = array(
	'list' => array(
		'hero' => array('v_banner' => ''),
		'content' => array('v_articles' => 'issue'),
		'page_complimentary' => array(
			// 'v_most_read' => 'articles',
			'links' => ''
		)
	)
);

$config['views']['issue'] = array(
	'list' => array(
			'content' => array(
				'v_header' => '',
				'v_intro' => 'short_description',
				'main_content' => 'main_content'
			),
			'page' => array(),
			'page_complimentary' => array('links' => '')
		),
	'single' => array(
			'hero' => array('v_banner' => 'banner'),
			'content' => array(
				'v_header' => '!banner',
				'v_articles' => 'articles',
				'v_issue_entry' => 'entry_article'
			),
			'body' => array(
				'v_toolbar' => '',
				'v_imprint' => 'preference_bas_organisation_name,issn,publisher,doi'
			)
		)
);

$config['views']['article'] = array(
		'list' => array(
			'content' => array(
				'v_header' => '',
				'v_intro' => 'short_description',
				'v_search_filter' => '',
				'main_content' => 'main_content'
				),
			'page' => array(),
			'page_complimentary' => array('links' => '')
			),
		'single' => array(
			'hero' => array('v_banner' => 'banner'),
			'body' => array(
				'v_toolbar' => '',
				'v_content_header' => '!banner',
				'v_chapter_authors' => 'article_chapter_authors',
				'v_chapters' => 'chapters',
				'v_document' => 'files',
				'v_authors' => 'authors',
				'v_footnote' => 'footnotes',
				'v_reference' => 'article_reference',
				'v_tags' => 'tags',
				'v_imprint' => 'authors,publish_date,category,doi,cite',
				'v_comment' => 'enable_comments=1',
				),
			'content_complementary' => array('pagination' => 'pagination')
			)
	);

/**
 * Actor views
 */
$config['views']['actor'] = array(
	'list' => array(
		'page' => array(
			'v_header_section' => '',
			'main_content' => 'main_content',
			'links' => 'page_external_event'
		)
	),
	'single' => array(
		'hero' => array('v_banner' => 'banner'),
		'body' => array(
			'v_toolbar' => '',
			'v_header' => '!banner',
			'v_info' => 'email,academia_edu_url',
			'v_bodytext' => 'description',
			'v_document' => 'files'
		),
		'page' => array('links' => 'actor_external_event'),
		'content_complementary' => array('pagination' => 'pagination'),
	)
);


/* End of file views.php */
/* Location: ./skins/ra250/php/config/views.php */
