<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Article Class
 *
 * @package Libraries
 * @author Keepthinking
 **/
class Article extends Base{

	/**
	 * Constructor
	 *
	 **/
	public function __construct()
	{
		parent::__construct();
		$this->model = $this->CI->m_article;
	}

// ------------------------------------------------------------------------
	
	/**
	 * Get list
	 *
	 */
	public function get_list($params, $add_details = true)
	{
		return $this->model->get_article($params, $add_details);
	}

// ------------------------------------------------------------------------
	
	/**
	 * Get detail
	 *
	 */
	public function get_detail($reference)
	{
		$article = $this->model->get_article(array('reference' => $reference), true);

		// #15919: imprint author fixes
		if(!empty($article->records[0]->authors))
		{
			$authors = $article->records[0]->authors;
			$return_value = array();

			if (is_array($authors) && !empty($authors))
			{	$author_group = group_by($authors, 'qualifier');
				foreach ($author_group as $qualifier => $authors)
				{
					foreach ($authors as $author)
						$return_value[$qualifier]["{$author->name}"] = (!empty($base_url) ? rtrim($base_url, '/') . '/' . implode('/', array_merge($url_params, array('author', $author->reference))) : NULL);
				}
			}
			$this->data->author_groups = $return_value;
		}


		if (!empty($article->records))
		{
			// Get instance
			$CI =& get_instance();

			// Set empty data arrays for image and footnote
			$this->data->images = array();
			$this->data->footnotes = array();
			foreach ($article->records as $item)
			{
				if (!empty($item->chapters))
				{
					foreach ($item->chapters as $chapter)
					{
						// Parse cms code for chapters 
						$this->data->images = (!empty($chapter->media['image']) ? $chapter->media['image'] : NULL);
						$this->data->multimedia = (!empty($chapter->media['multimedia']) ? $chapter->media['multimedia'] : NULL);
						$this->data->chart_links = (!empty($chapter->chart_links) ? $chapter->chart_links : NULL);
						$this->data->zoom_links = (!empty($chapter->zoom_links) ? $chapter->zoom_links : NULL);

						if(!empty($chapter->paragraphs))
						{
							foreach($chapter->paragraphs as $paragraph)
							{
								$paragraph->issue_doi = $item->issue_doi;
								$paragraph->article_doi = $item->article_doi;
								$paragraph->article_id = $item->id;
								$paragraph = $CI->_parse_cmscode($paragraph, 'name', 'article');

								// Get footnotes
								if(!empty($paragraph->name))
									$this->data->footnotes = array_merge($this->data->footnotes, get_footnotes($paragraph->name, count($this->data->footnotes)));
							}
						}						
					}
				}
			}
			// Increase views count
			$this->model->increase_view_count($article->records[0]->id);

			unset($this->data->images);
		}

		return $article;
	}

// ------------------------------------------------------------------------

	/**
	 * Get filters
	 *
	 */
	public function get_filter($params)
	{
		$passed_params = array();
		if (!empty($params['year']) && $params['year'] != 'all')
			$passed_params['year'] = $params['year'];

		if (!empty($params['start-date']))
			$passed_params['start-date'] = $params['start-date'];

		if (!empty($params['end-date']))
			$passed_params['end-date'] = $params['end-date'];

		if (!empty($params['search']))
			$passed_params['search'] = $params['search'];

		if ($filter = $this->model->get_filter($passed_params)) {
			// Get current filter
			if (!empty($params['article-category']) && array_key_exists($params['article-category'], $filter))
				$this->data->current_filter['article-category'] = array($params['article-category'] => $filter[$params['article-category']]);
			else
				$this->data->current_filter['article-category'] = array(current(array_keys($filter)) => reset($filter));
			return array('article-category' => $filter);
		}

		return null;
	}

// ------------------------------------------------------------------------

	/**
	 * Get year filters
	 *
	 */
	public function get_year_filter($params)
	{
		$passed_params = array();
		if (!empty($params['current']))
			$passed_params['current'] = $params['current'];

		if (!empty($params['past']))
			$passed_params['past'] = $params['past'];

		if (!empty($params['article-category']))
			$passed_params['article-category'] = $params['article-category'];

		if (!empty($params['search']))
			$passed_params['search'] = $params['search'];
		
		if ($filter = $this->model->get_year_filter($passed_params)) {
			// Get current filter
			if (!empty($params['year']) && array_key_exists($params['year'], $filter))
				$this->data->current_year_filter['year'] = array($params['year'] => $filter[$params['year']]);
			else
				$this->data->current_year_filter['year'] = array(current(array_keys($filter)) => reset($filter));
			return array('year' => $filter);
		}

		return null;
	}

// ------------------------------------------------------------------------
	
	/**
	 * Render a list
	 *
	 */
	public function render_list($records, $group_by = '', $media_path_size = 'media_path_2col_list', $media_folder_ranks = array(null), $view = 'v_list')
	{
		// If we need to group records do it
		if($group_by)
			$records = group_by($records, $group_by);
		else
			$records = array($records);

		$html = '';
		
		// Make sure $media_folder_ranks is an array
		if (!is_array($media_folder_ranks))
			$media_folder_ranks = array($media_folder_ranks);
		
		// Loop through the groups and create the views
		foreach($records as $group_name => $group)
		{
			$this->data->result = $group;

			if ($group_by)
			{
				list($this->data->group_sub_title,$this->data->group_title) = array_map('trim', array_pad(explode('|', $group_name), 2, null));
			}

			$table = $this->parent_class !== 'base' ? $this->parent_class : $this->class;
			
			foreach ($this->data->result as $item) {
				foreach ($media_folder_ranks as $media_folder_rank) {
					if ($item->media['image'] = $this->model->media($item->id, $table, 'image', $media_folder_rank))
						break;
				}
			}

			kt_get_image_size($this->data->result, $media_path_size);
			$html .= $this->load->view(get_view(array($this->class, $this->parent_class), $view), $this->data, true);

		}
		
		// Return the views
		return $html;
	}

}

/* End of file Article.php */
/* Location: ./skins/ra250/php/libraries/Article.php */
