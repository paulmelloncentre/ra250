<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Custom Template Controller
 *
 * @package Controllers
 * @author Keepthinking
 * @year 2015
 **/

include (APPPATH . 'controllers/template.php');
class Template_custom extends Template {

// -------------------------------------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 **/
	public function __construct()
	{
		parent::__construct();

		if(!empty($_POST['keywords']))
		{
			$this->session->set_userdata('search_string', $_POST['keywords']);
		}
		else
		{
			$this->data->user_input = $this->session->userdata('search_string');
			// if(!empty($this->data->user_input) && !$this->data->reference != 'article-index')
			// {
			// 	$this->session->unset_userdata('search_string');
			// }
		}
	}

// -------------------------------------------------------------------------------------------------

	/**
	* Index
	* The proxy function that loads every other template
	*
	* @return void
	**/
	public function index()
	{
		parent::index();

		$this->load->model(get_model('m_publication'), 'm_publication');
		$this->load->library(get_library('publication'), '', 'lib');

		//CrossRef Deposit Schema (XML)	
		if($this->uri->segment(1) == 'publication')
			$this->_crossref_publication();
	}

	private function _crossref_publication()
	{
		$result = $this->lib->get_data(config('cluster_id'));
		
		if($result){
			$this->data->publications = $result;
			header("Content-Type: text/xml");
			echo $this->load->view(get_view('publication', 'v_publication'), $this->data, true);
		}
		die;
	}
// ------------------------------------------------------------------------------------------------

	/**
	 * Home template
	 * The home page is a series of links with images
	 *
	 **/
	protected function home_feature()
	{
		// Force list view
		$this->data->force_list = true;

		// Content data
		$this->_content_data();
		
		// // Load library
		$this->load->model(get_model('m_home_feature'), 'm_home_feature');
		$this->load->library(get_library('home_feature'), '', 'lib');
		
		// // Get homepage banners
		if ($this->data->banner = $this->lib->get_list(array('node_id' => $this->data->node_id)))
			$this->data->banner = $this->base->add_media($this->data->banner, 'home_feature');

		// Get latest issue
		if ($this->data->issue = $this->model->get_issue(array('limit' => 1), true)->records)
			$this->data->issue = array_shift($this->data->issue);

		// Most read articles
		$this->data->articles = $this->model->get_article(array('most-read' => true, 'limit' => 8), true)->records;

		$this->_content_views(__FUNCTION__);
		$this->_load_template();
	}

// ------------------------------------------------------------------------------------------------

	/**
	 * Issue template 
	 * @return void
	 */
	protected function issue()
	{

		// Load library and model
		$this->load->model(get_model('m_issue'), 'm_issue');
		$this->load->model(get_model('m_article'), 'm_article');
		$this->load->library(get_library('issue'), '', 'lib');

		//CrossRef Deposit Schema (XML)
		if($this->uri->segment(4) == 'deposit_schema')
			$this->_crossref_deposit_schema();

		// Load helper
		$this->load->helper('article');

		// Use shared method
		$params = array(
			'table' 		=> 'issue',
			'template'		=> __FUNCTION__,
			'media_folder_ranks' => array(100, 10, null)
		);

		if (empty($this->data->item_reference))
			$this->data->is_list = true;

		// If a single article has been selected
		// Load the article template and swap params with item reference
		$article_reference =  $this->uri->segment(4);
		if (!empty($article_reference)) {
			
			// Reset url params
			$this->data->url_params = $this->uri->ruri_to_assoc(6);
			$this->data->url_params['issue'] = $this->uri->segment(3);
			$this->data->item_reference = $article_reference;
			$this->data->is_list = false;
			$this->article(false);
		}
		else
		{
			// Used shared template (paginated)
			$this->_group($params);
		}
	}

// ------------------------------------------------------------------------------------------------

	/**
	 * Article template 
	 * @return void
	 */
	protected function article($index = true)
	{
		// Make sure template is set as it can be called from issues
		$this->data->template = __FUNCTION__;

		// Need to know if we are coming from the article index or
		// issue listing
		$this->data->is_article_index = $index;

		// Load library and model
		$this->load->model(get_model('m_article'), 'm_article');
		$this->load->library(get_library('article'), '', 'lib');

		// Load helper
		$this->load->helper('article');

		// Use shared method
		$params = array(
			'table' 		=> 'article',
			'template'		=> __FUNCTION__,
			'filter_container' => '',
			'group_list_by' => 'issue_name',
			'paginate' => 2,
			'media_folder_ranks' => array(10,100,NULL)
		);

		// Set empty custom params
		$custom_params = array();
		
		// Load filter data
		$this->data->filter = $this->lib->get_filter($this->data->url_params);
		$this->data->year_filter = $this->lib->get_year_filter($this->data->url_params);

		// Get search params
		if (!empty($this->data->url_params['search']))
		{
			if (!$search_params = $this->model->get_search($this->data->url_params['search']))
			{
				list($searh_key, $search_keyword) = explode(':', $this->data->url_params['search']);
				$search_params = $this->model->insert_search(array($searh_key => $search_keyword));
				
			}
				
			if (!empty($search_params))
			{
				// Keywords
				$this->data->search_string = !empty($this->data->user_input) ? $this->data->user_input : search_param_value($search_params, 'keywords');

				// Tags
				$this->data->search_string .= " " . search_param_value($search_params, 'tags');

				// Trim value
				$this->data->search_string = trim($this->data->search_string);
			}

			unset($search_params);
		}

		if(!empty($this->data->url_params['author']))
		{
			$search_name = str_replace("-", " ", $this->data->url_params['author']);
			$this->data->search_string .= " " . $search_name;
			$this->data->search_string = trim($this->data->search_string);
		}

		// If url params is not empty,
		// search submitted,
		// remove group list by and
		// load search list view
		if (!empty($this->data->url_params))
		{
			// Set list view to search list
			$params['list_view'] = "v_search_list";

			// Remove grouping
			$params['group_list_by'] = '';
		}

		if (empty($this->data->item_reference))
			$this->data->is_list = true;

		// Used shared template (paginated)
		$this->_group($params, $custom_params);
	}

// ------------------------------------------------------------------------

	/**
	 * Search
	 *
	 * @param  type (bool,void, stdClass, array ect)
	 * @author Richard Merchant
	 * @return (bool,void, stdClass, array ect)
	 */
	protected function search()
	{
		// Force list view
		$this->data->force_list = true;

		// return search module view
		if ($this->input->is_ajax_request())
		{
			echo $this->load->view(get_view('search', 'v_search_form'), $this->data, true);
			exit();
		}

		if (!empty($this->data->item_reference))
		{
			$this->data->keywords = urldecode($this->data->item_reference);
			$this->data->search_params = $this->model->get_search($this->data->keywords);

			// Load library
			$this->load->library('search_lib', '', 'lib');

			// Load helpers
			$this->load->helper('text', 'inflector');

			$this->lib->set_config(config('global_search_config'));
			$this->lib->set_string($this->data->search_params);

			$this->data->search_string =  !empty($this->data->user_input) ? $this->data->user_input : $this->lib->get_string();

			// Get search results
			$result = $this->lib->get_results();

			if (!empty($result))
			{
				// Split results
				$website_results = array();
				$bas_results = array();

				// Set default page number and page key location
				// * Page key is used to set where the page anchor will be set
				$this->data->page_number = 1;
				$this->data->page_key_location = 0;

				// PMC Website results
				if (!empty($result[1]))
				{
					$website_results = $result[1];
					$this->data->website_total_results = count($result[1]);
					$this->data->website_results_title = lang('website_results_title');

					// Process website results
					
					// Cut the results by the default search page amount
					array_splice($website_results, config('search_default_per_page'));

					$final_website_results = array();
					foreach ($website_results as $item)
					{
						// Unserialize data
						$record = unserialize($item->serialised_record);
						$record = (object) array_merge((array)$item,$record);

						// Get page reference
						if ($record->table != 'page')
						{
							if ($record->table == 'event' || $record->table == 'event_group')
							{
								if ((empty($record->end_date) && strtotime($record->start_date) < strtotime(date("Y-m-d", time()))) || (!empty($record->end_date) && strtotime($record->end_date) < strtotime(date("Y-m-d", time()))))
									$page_reference = $this->model->get_reference_by_template('past_event', $item->node_id);
								else
									$page_reference = $this->model->get_reference_by_template('event', $record->node_id);
							}
							else
								$page_reference = $this->model->get_reference_by_template($record->table, $record->node_id);

							// Continue id there is not page reference as it is required
							if (empty($page_reference))
							{
								$this->data->website_total_results--;
								continue;
							}
						}
						elseif (!empty($record->parent_id))
						{
							// Add page reference if the page is level 3
							// The tab page is the middle page so its the page with a parent id 
							// but whose page id is not equal to the current pages parent id
							if ($page = $this->model->get_tab_page($record->parent_id))
							{
								$page_reference = $page->reference;
							}
						}

						// Extra details
						switch ($record->table) {
							case 'publication':
								// Join list values into array for easier display
								$record->details = array(
									array(!empty($record->author_value) ? $record->author_value : NULL, !empty($record->publisher_value) ? $record->publisher_value : NULL),
									array(!empty($record->publication_type_value) ? $record->publication_type_value : NULL, !empty($record->pages) ? "{$record->pages} " . lang('pages')  : NULL),
									array(!empty($record->isbn_number) ? lang('isbn') . ": {$record->isbn_number}" : NULL),
									array(!empty($record->publish_date) ? date('Y', strtotime($record->publish_date)) : NULL)
								);
								$record->details = array_map('array_filter', $record->details);
								break;
							
							case 'event_group':
								// Add event group values to reference to trigger event group display
								$record->reference = "{$record->reference}/event-group";
								break;

							case 'actor':
								// Get linked actor page or dont display actor
								if ($actor_page = $this->model->get_link_page($record->item_id, 'actor', 'actor'))
									$record->url = create_url($actor_page->controller, $actor_page->reference, $record->reference, array(), $actor_page->cluster_id);
								else
								{
									$this->data->website_total_results--;
									unset($record);
								}
								break;

							default:
								break;
						}

						// Record cound have been unset so check it exits first
						if (!empty($record))
						{

							// Create url
							if (empty($record->url))
								$record->url = create_url($record->controller, !empty($page_reference) ? $page_reference : null, $record->reference, array(), $record->cluster_id);

							// Add record to website results array
							$final_website_results[] = $record;
						}
						
						// Unset page reference so that it is not carried over from last record
						unset($page_reference);
					}

					// Clean up vars
					unset($website_results);

					// Set view more variable
					$this->data->view_more = ($this->data->website_total_results > count($final_website_results)) ? true : false;
					if ($this->data->view_more)
						$this->data->view_more_url = create_url($this->data->other_search_page_reference, $this->data->item_reference, null, array(), reset($final_website_results)->cluster_id);
				}

				// Journal results
				if (!empty($result[2]))
				{
					$bas_results = $result[2];
					$article_ids = get_attributes_conditional($bas_results, 'item_id', 'table', 'article');

					//get all online issues
					$issues = get_attributes_conditional($this->model->get_issue(null, false)->records, 'id');

					$final_bas_results = array();
					$swap_article_ids = array();

					foreach ($bas_results as $key => $item)
					{
						// Unserialize data
						$record = unserialize($item->serialised_record);
						$record = (object) array_merge((array)$item,$record);

						//Bug #13746: skip result if issue is offline
						if(!empty($record->issue_id) && !in_array($record->issue_id, $issues))
							continue;

						// Get page reference
						if ($record->table != 'page')
						{
							if ($record->table == 'article')
							{
								$record->url = create_url($record->controller, $record->page_reference, "{$record->issue_reference}/{$record->reference}");
							}
							else if ($record->table == 'article_chapter')
							{
								if (!in_array($record->article_id, $article_ids))
								{
									// Swap record for article index record
									if (!in_array($record->article_id, $swap_article_ids) && $index_record = $this->lib->get_record($record->article_id, 'article'))
									{
										$swap_article_ids[] = $record->article_id;
										// Unserialize data
										$record = unserialize($index_record->serialised_record);
										$record = (object) array_merge((array)$index_record,$record);
										$record->url = create_url($record->controller, $record->page_reference, "{$record->issue_reference}/{$record->reference}");
									}
									else
									{
										// Remove record from search results
										unset($bas_results[$key]);

										// Continue if there is not page reference as it is required
										@$this->data->bas_total_results--;
										continue;
									}
								}
								else
								{
									// Remove record from search results
									unset($bas_results[$key]);

									// Continue if there is not page reference as it is required
									@$this->data->bas_total_results--;
									continue;
								}
							}
							else
								$page_reference = $this->model->get_reference_by_template($record->table, $record->node_id);

							if (empty($record->url) && empty($page_reference))
							{
								// Continue if there is not page reference as it is required
								@$this->data->bas_total_results--;
								continue;
							}
						}

						// Extra details
						switch ($record->table) {
							case 'actor':
								// Get linked actor page or dont display actor
								if ($actor_page = $this->model->get_link_page($record->item_id, 'actor', 'actor'))
									$record->url = create_url($actor_page->controller, $actor_page->reference, $record->reference);
								else
								{
									@$this->data->bas_total_results--;
									unset($record);
								}
								break;

							default:
								break;
						}


						// Record could have been unset so check it exits first
						if (!empty($record))
						{
							// Create url
							if (empty($record->url))
								$record->url = create_url($record->controller, !empty($page_reference) ? $page_reference : null, $record->reference);

							// Add record to journal results array
							$final_bas_results[] = $record;
						}
						
						// Unset page reference so that it is not carried over from last record
						unset($page_reference);

					}

					// Remove article chapters that has a article in the results or
					// swap the chapter with the article from index table
					
					$bas_results = $final_bas_results;
					$this->data->bas_total_results = count($final_bas_results);
					// Process journal results

					// Load pagination only if we have more that the default search items per page
					if ($this->data->bas_total_results > config('search_default_per_page'))
					{
						// Load the pagination library
						$this->load->library(get_library('pagination'), array('data' => $this->data), 'pagination');
						$this->pagination->set_item_count($this->data->bas_total_results);

						// Set pagination properties
						$this->pagination->set_properties(array('items_per_page' => config('search_default_per_page')));

						// Pagination object
						$this->pagination->paginate();
						$this->html->pagination = $this->pagination->render(__FUNCTION__);

						// Get page number from url params
						$this->data->page_number = 1;
						if (!empty($this->data->url_params['page']))
							$this->data->page_number = $this->data->url_params['page'];

						// Set offset to cut array
						$offset = config('search_default_per_page')*$this->data->page_number;
						array_splice($final_bas_results, $offset);
					
						// Set key where page id will be set
						if ($this->data->page_number > 1)
							$this->data->page_key_location = ($offset - config('search_default_per_page'));
					}


					// Clean up vars
					unset($bas_results);

				}

				unset($result);

				// Load web results
				if (!empty($final_website_results))
				{
					$search_result_views = config('web_search_result_views');

					$this->data->website_results_html = '';
					foreach ($final_website_results as $key => $item)
					{
						// Load view for custom result data
						$view = !empty($search_result_views[$item->table]) ? 
								$search_result_views[$item->table] :
								$search_result_views['default'];

						// Load view data a append html
						$this->data->item = $item;
						$this->data->item_number = $key;
						$this->data->website_results_html .= $this->load->view(get_view(__FUNCTION__, $view), $this->data, true);
					}

					// Wrap list is web result container
					$this->html->website_results = $this->load->view(get_view(__FUNCTION__, 'v_website_results'), $this->data, true);

					// Clean up vars
					unset($final_website_results, $this->data->item, $this->data->item_number, $this->data->website_results_html);
				}

				// Load Journal results
				if (!empty($final_bas_results))
				{
					$search_result_views = config('bas_search_result_views');

					$this->data->bas_results_html = '';
					foreach ($final_bas_results as $key => $item)
					{
						// Load view for custom result data
						$view = !empty($search_result_views[$item->table]) ? 
								$search_result_views[$item->table] :
								$search_result_views['default'];

						// Load view data a append html
						$this->data->item = $item;
						$this->data->item_number = $key;

						$this->data->first_listing_image = null;

						if(!empty($item->media['image']) && count($item->media['image']) > 1)
						foreach($item->media['image'] as $key => $image)
							if($image->media_folder_rank == 10){
								$this->data->first_listing_image = $image;
								break;
							}

						$this->data->bas_results_html .= $this->load->view(get_view(__FUNCTION__, $view), $this->data, true);
					}

					// Wrap list is bas result container
					$this->html->bas_results = $this->load->view(get_view(__FUNCTION__, 'v_bas_results'), $this->data, true);

					// Clean up vars
					unset($final_bas_results, $this->data->item, $this->data->item_number, $this->data->bas_results_html, $search_result_views);
				}
			}
		}

		$this->_content_data();
		$this->_content_views(__FUNCTION__);
		$this->_load_template();
	}

// ------------------------------------------------------------------------

	/**
	 * Common function for content types that have lists, details and extra group level
	 * Typically, themes and exhibition will have:
	 * - Lists
	 * - Details
	 * - Extra details (objects linked to main record)
	 * 
	 * @param $table - the main table for the content
	 * @param $group_list_by - field to group lists
	 * @param $banner - binary value: 1 for main table, 2 for dependent
	 * @param $paginate - binary value: 1=list, 2=record, 4=list of dependents, 8=dependent record
	 * @param $links_container - where to display links in individual records
	 * @param $dependent_table - table for dependents
	 * @param $detail_filter_view - ???
	 *
	 **/
	protected function _group($params = array(), $custom_params = array())
	{
		// Merge params with default params
		$params = array_merge(config('group_tpl_params'), $params);
		extract($params);
		
		// Merge custom params with url params
		$url_params = array_merge($this->data->url_params, $custom_params);

		// Load the pagination library
		$this->load->library(get_library('pagination'), array('data' => $this->data), 'pagination');
		
		// Detail record from a list
		if (!$this->data->is_list && !empty($this->data->item_reference))
		{
			// Get the content information
			$list_record = $this->data->content = @array_shift($this->lib->get_detail($this->data->item_reference)->records);
			
			// Redirect to 404 if no record
			if (empty($this->data->content))
				$this->error_404(true);
			else
			{
				// Custom pagination for dependents - only if not coming from a link
				if ($paginate & 2)
				{
					// Get the list records
					if($this->data->template == 'article')
					{
						$records = array();
						$articles = $this->lib->get_list($url_params, true, false)->records;

						if(!empty($articles))
						{
							foreach($articles as $article)
							{
								$records[] = $article;
								if(!empty($article->child_articles))
									$records = array_merge($records,$article->child_articles);
							}
						}

						$records = $this->base->add_media($records, $table, 'id', 'image', array(100, null));
						$this->pagination->paginate_single($records);
						$this->html->pagination = $this->pagination->render_single($table);
					}
					else if ($records = $this->lib->get_list($url_params, false, false)->records)
					{
						$records = $this->base->add_media($records, $table, 'id', 'image', array(100, null));
						$this->pagination->paginate_single($records);
						$this->html->pagination = $this->pagination->render_single($table);
					}
				}

				$this->_content_data($table, $this->data->content->id);

				if ($detail_filter_view)
				{
					$this->data->filter = $this->lib->get_filter($url_params);
					if($this->data->filter)
						$this->html->$filter_container = $this->lib->render_filter(empty($records), $detail_filter_view);

					unset($this->data->filter);
				}

				// Dependents lists and details for group templates (Level 2/list and Level 3/detail)
				if ($dependent_table)
				{
					// Common content views for the record
					// $this->data->links = null;
					// $this->data->media = null;

					// Update pagination properties
					$this->pagination->set_properties(array('content' => $this->data->content, 'dependant_table' => $dependent_table));
					$this->_dependent($dependent_table, $table, $list_record->reference, $paginate, $dependent_detail, $url_params, $media_path_size, $media_folder_ranks, $dependent_list_view);
				}
				else
				{
					$this->_content_views($template);
				}
			}
		}

		// List(s)
		else
		{
			$this->_content_data();

			// Create pagination if required
			if ($paginate & 1)
			{
				// Get the first page if none is provided
				if (empty($this->data->url_params['page']))
					$this->data->url_params['page'] = 1;

				$url_params = array_merge($this->data->url_params, $url_params);
			}
			
			// Get the list records
			$records = $this->lib->get_list($url_params, true, $paginate & 1);

			if(!empty($records->records))
			{
				if (!empty($records->count))
					$record_count = $records->count;
				else
					$record_count = count($records->records);

				$records = $records->records;
				
				// Create pagination if required
				if ($paginate & 1)
				{	
					// Set the label in any case - as we need it for display items count as well as for pagination
					$this->pagination->set_item_count($record_count);
					$this->pagination->set_label($table);

					//Pagination object
					$this->pagination->paginate();
					$this->html->pagination = $this->pagination->render($table);
				}
				
				// Load the content
				$this->html->main_content = $this->lib->render_list($records, $group_list_by, $media_path_size, $media_folder_ranks, $list_view);
			}
			// No records to display
			else
			{
				if($this->data->url_params)
					$this->data->content->bodytext = lang('no_records');
				else
					$this->data->content->bodytext = '';
			}

			// If there are any filters get them and load the relevant view
			if (!empty($filter_container))
				if ($this->data->filter = $this->lib->get_filter($url_params)) {
					$this->html->$filter_container = $this->lib->render_filter(empty($records));
					unset($this->data->filter);
				}

			// Load the rest of the shared content
			$this->_content_views($template);
		}

		// Load the template
		$this->_load_template();
	}

// ------------------------------------------------------------------------------------------------

	/**
	 * Article Citation
	 * @param  Int $article_id
	 * @return Mixed
	 */
	public function citation($article_id = null)
	{
		// Make sure its an ajax request
		if (!$this->input->is_ajax_request())
			return;

		// Make sure theres an article id
		if (empty($article_id) || !is_numeric($article_id))
			return;

		if ($article = @reset($this->model->get_article(array('id' => $article_id), false)->records))
			echo $this->load->view(get_view('common', 'v_citation'), array('article' => $article, 'content' => 'citation'), true);

		exit;
	}

	/**
	 * Article DOI
	 * @param  Int $article_id
	 * @return Mixed
	 */
	public function doi($article_id = null, $element = null)
	{
		// Make sure its an ajax request
		if (!$this->input->is_ajax_request())
			return;

		// Make sure theres an article id
		if (empty($article_id) || !is_numeric($article_id))
			return;

		if ($article = @reset($this->model->get_article(array('id' => $article_id), false)->records))
			echo $this->load->view(get_view('common', 'v_citation'), array('article' => $article, 'content' => 'doi', 'append' => (!empty($element) ? '/'. $element : '')), true);

		exit;
	}

	/**
	 * CrossRef Deposit Schema
	 */
	private function _crossref_deposit_schema()
	{
		$issue_reference = $this->uri->segment(3);
		$result = $this->lib->get_detail($issue_reference, true, true);
		if(!empty($result->records[0]))
		{
			$issue = $result->records[0];
			$this->_publish_date($issue);

			//flattern parent/child article array
			$flattern_articles= array();
			foreach($issue->articles as $article)
			{
				$flattern_articles[] = $article;
				if(!empty($article->child_articles))
				{
					foreach($article->child_articles as $child_article)
						$flattern_articles[] = $this->model->get_article(array('id'=>$child_article->id, 'reference'=>$child_article->reference))->records[0];
				}
			}
			$issue->articles = $flattern_articles;

			foreach($issue->articles as $article)
			{
				$this->_publish_date($article);
				$media = array();

				$media_index = 0;

				// Article chapter media
				if(!empty($article->chapters))
				{
					foreach($article->chapters as $chapter)
					{
						if(!empty($chapter->media) || !empty($chapter->chart_links) || !empty($chapter->zoom_links))
						{
							foreach($chapter->paragraphs as $paragraph)
							{
								$patterns = array("/\[slider\]\[img\]\[img\]\[\/slider\]/");
								$replace = array('[slider]');
								$paragraph->name = preg_replace($patterns, $replace, $paragraph->name);

								if($tags_found = preg_match_all("/\[(img|mul|slider|chart|zoom)\]/", $paragraph->name, $tag_matches))
								{
									foreach($tag_matches[1] as $tag)
									{
										if($tag == 'img' && !empty($chapter->media['image']))
										{
											$record = array_shift($chapter->media['image']);
											$media[] = $this->_media_record('image', $record, $media_index);
											$media_index++;
										} 
										else if($tag == 'slider' && !empty($chapter->media['image']) && count($chapter->media['image']) > 1)
										{
											$record = array_shift($chapter->media['image']);
											$media[] = $this->_media_record('image', $record, $media_index, 'a');

											$record = array_shift($chapter->media['image']);
											$media[] = $this->_media_record('image', $record, $media_index, 'b');
											$media_index++;
										}
										else if($tag == 'mul' && !empty($chapter->media['multimedia'])) 
										{
											$record = array_shift($chapter->media['multimedia']);
											$media[] = $this->_media_record('multimedia', $record, $media_index);
											$media_index++;
										}
										else if($tag == 'chart' && !empty($chapter->chart_links)) 
										{
											$record = array_shift($chapter->chart_links);
											$record->media_type = 'chart';
											$media[] = $this->_media_record('image', $record, $media_index);
											$media_index++;
										}
										else if($tag == 'zoom' && !empty($chapter->zoom_links)) 
										{
											$record = array_shift($chapter->zoom_links);
											$record->media_type = 'zoom';
											$media[] = $this->_media_record('image', $record, $media_index);
											$media_index++;
										}
									}
								}
								
							}
						}
					}
				}

				$article->media = $media;
			}

			$this->data->issue = $issue;
			header("Content-Type: text/xml");
			echo $this->load->view(get_view('issue', 'v_xml_deposit_schema'), $this->data, true);
		}
		die;
	}

	/**
	 * Publish date
	 */
	private function _publish_date($record)
	{
		$record->day = $record->month = $record->year = null;
		if(!isset($record->publish_date))
			return;

		foreach(date_parse($record->publish_date) as $property => $value)
				if(in_array($property, array('day','month','year')))
					$record->$property = str_pad($value, 2, "0", STR_PAD_LEFT);  
	}

	/**
	 * Media record
	 */
	private function _media_record($type, $record, $index, $sub = NULL)
	{
		$record->component_type = "Figure";
		if($type == 'multimedia')
			$record->component_type = "Figure";
			// $record->component_type = (in_array(strtolower($record->extension), config('audio_type_extensions')) ? "Audio" : "Video");
		elseif($type == 'file')
			$record->component_type = "File";

		$record->component_index = $index + 1;

		if(!empty($sub))
			$record->component_index = $record->component_index.$sub;
		
		$record->doi = str_pad($record->component_index, 3, "0", STR_PAD_LEFT);
		$record->url = $this->_media_url($record);

		return $record;
	}

	/**
	 * Media URL
	 */
	private function _media_url($media)
	{
		if($media->media_type == "image")
			$media_path = kt_get_media_path($media, 'media_path_lightbox');
		else if($media->media_type == "multimedia")
			$media_path = config('media_path_multimedia').$media->full_path;
		else // chart and zoom images
			$media_path = $media->name;
		
		$url = parse_url($media_path);
		if(empty($url['scheme']))
			$url = array_merge(parse_url(base_url()), $url);

		if(!empty($url['path']))
		{
			$url['path'] = implode("/", array_filter(explode("/", $url['path'])));

			if($media->media_type == 'zoom') //#16349: replace zoom url 
			{
				$last_slash = strrpos(rtrim($url['path'], "/"), "/");
				$url['path'] = substr($url['path'], 0, $last_slash)."/full/,800/0/default.jpg";
			}
		}


		return "{$url['scheme']}://{$url['host']}/{$url['path']}";
	}
}

/* End of file template_custom.php */
/* Location: /skin/ra250/php/controllers/template_custom.php */
