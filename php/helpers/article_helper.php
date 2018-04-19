
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Display Authors
 */
if (!function_exists('display_authors')) 
{
	function display_authors($authors = array(), $base_url = '', $url_params = array()) {
		$CI = &get_instance();
		$return_value = array();

		if (is_array($authors) && !empty($authors))
		{	$author_group = group_by($authors, 'qualifier');
			foreach ($author_group as $qualifier => $authors)
			{
				foreach ($authors as $author)
					$return_value[$qualifier]["{$author->name}"] = (!empty($base_url) ? rtrim($base_url, '/') . '/' . implode('/', array_merge($url_params, array('author', $author->reference))) : NULL);
			}
		}

		if (!empty($return_value))
			return $CI->load->view(get_view('article', 'v_header_authors'), array('author_groups' => $return_value), true);

		return $return_value;
	}
}

/**
 * Get and return the content of [fn/] tags
 *
 * @return array List of all footnotes.
 **/
if (!function_exists('get_footnotes'))
{
	function get_footnotes(&$content, $count = 0)
	{
		if(empty($content))
			return $content;

	    $return_data = array();
	    
	    // Grab everything between [fn] [/fn]
	    $pattern = "/\[fn\](.*?)\[\/fn\]/";
	    preg_match_all($pattern, $content, $matches);

	    foreach ($matches[0] as $key => $match) {
	    	$count++;
	    	$content = str_replace($match, '<sup id="superscript-'.$count.'"><a data-anchor title="'.str_replace('"','', strip_tags($matches[1][$key])).'" href="#footnote-'.$count.'">'.$count.'</a></sup>', $content);
	    }
	    
	    foreach ($matches[1] as $key => $match)
	        $return_data[] = $match;

		return $return_data;
	}
}

/**
 * Display chapter date
 */
if (!function_exists('display_chapter_date'))
{
	function display_chapter_date($date)
	{
		$return_value = '';

		$date_stamp = strtotime(date("Y-m-d", strtotime($date)));
		$current_date_stamp = strtotime(date("Y-m-d"));
		if (strtotime($date) <= $current_date_stamp)
			$return_value =  date("d.m.Y", $date_stamp);
		else
		{
			$start_date = new DateTime(date("Y-m-d"));
			$end_date = new DateTime(date("Y-m-d", $date_stamp));
			$diff = $start_date->diff($end_date);
			$return_value = sprintf(lang('published_in_days'), $diff->days);
		}

		return $return_value;
	}
}

/* End of file article_helper.php */
/* Location: ./skins/ra250/php/helpers/article_helper.php */