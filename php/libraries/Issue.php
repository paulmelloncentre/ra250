<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Issue Class
 *
 * @package Libraries
 * @author Keepthinking
 **/
class Issue extends Base{

	/**
	 * Constructor
	 *
	 **/
	public function __construct()
	{
		parent::__construct();
		$this->model = $this->CI->m_issue;
	}

// ------------------------------------------------------------------------
	
	/**
	 * Get list
	 *
	 */
	public function get_list($params, $add_details = false)
	{
		return $this->model->get_issue($params, $add_details);
	}

// ------------------------------------------------------------------------
	
	/**
	 * Get detail
	 *
	 */
	public function get_detail($reference, $article_chapters = false)
	{
		$issue = $this->model->get_issue(array('reference' => $reference), true, $article_chapters);

		// Set the entry article data
		if (empty($issue->records[0]->media) && !empty($issue->records[0]->articles))
		{
			$entry_article = clone($issue->records[0]->articles[0]);
			$this->data->entry_article = reset($this->add_media($entry_article, 'article', 'id', 'image', array(100,10,NULL)));
		}

		return $issue;
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
			$this->data->group_title = $group_name;
			$table = $this->parent_class !== 'base' ? $this->parent_class : $this->class;
			
			foreach ($this->data->result as $item) {
				foreach ($media_folder_ranks as $media_folder_rank) {
					if ($item->media['image'] = $this->model->media($item->id, $table, 'image', $media_folder_rank))
					{
						shuffle($item->media['image']);	  //random cover image
						break;
					}
				}
			}

			kt_get_image_size($this->data->result, $media_path_size);
			$html .= $this->load->view(get_view(array($this->class, $this->parent_class), $view), $this->data, true);

		}
		
		// Return the views
		return $html;
	}
}

/* End of file Issue.php */
/* Location: ./skins/ra250/php/libraries/Issue.php */