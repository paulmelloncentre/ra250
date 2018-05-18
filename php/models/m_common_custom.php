<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Custom Common Model
 *
 * @package Models
 * @author Keepthinking
 * @since 2015
 **/

require(APPPATH . 'models/m_common.php');
class M_common_custom extends M_Common {

	/**
	 * Constructor
	 *
	 **/
	
	function __construct(){
		parent::__construct();
		$this->online = 1;
		$this->deleted = 2;
	}

// ------------------------------------------------------------------------

	/**
	 * [get_chapter description]
	 * @param  array   $params      [description]
	 * @param  boolean $add_details [description]
	 * @return [type]               [description]
	 */
	public function get_chapter($params = array(), $add_details = true){
		$query = $this->db->select("
				c.*
			")
			->from("article_chapter c")
			->where($this->_online('c'));

		if (!empty($params)){
			foreach ($params as $key => $value){
				switch ($key){
					case 'article_id':
						$query->where("c.article_id", $value);
						break;

					default:
						# code...
						break;
				}
			}
		}

		if ($result = $query->get()->result()){
			if ($add_details){
				foreach ($result as $item){
					// Embed links
					$item->chart_links = $this->get_embed_links($item->id, 'chart');
					$item->zoom_links = $this->get_embed_links($item->id, 'zoom');
				}
			}

			return $result;
		}

		return false;
	}

// ------------------------------------------------------------------------

	/**
	 * [get_chapter embed_links]
	 * @param  array   $params      [description]
	 * @param  boolean $add_details [description]
	 * @return [type]               [description]
	 */
	public function get_embed_links($chapter_id, $type){
		switch($type){
			case 'chart':
				$table = "article_chapter_chart_link_xrefs";
				break;
			case 'zoom':
				$table = "article_chapter_zoom_link_xrefs";
				break;

			default:
				return false;
		}

		$query = $this->db->select("xrefs.*, '{$type}' as type")
		         ->from("{$table} xrefs")
		         ->where($this->_online("xrefs"))
		         ->where("xrefs.article_chapter_id", $chapter_id)
		         ->order_by("xrefs.id");

		$result = $query->get()->result();

		return $result;
	}

// ------------------------------------------------------------------------

    /**
     * [get_publications cluster_id]
     */
    public function get_publications($cluster_id){
        $cluster_id = (int)($cluster_id);

        $query=$this->db->select("
				b.*,
				c.name as typename,
				e.full_name as actorname
			")
            ->from("_conf_node node")
            ->join("publication b", "node.id = b.node_id", "left")
            ->join("publication_type c", "b.publication_type_id = c.id", "left")
            ->join("publication_actor_xrefs d", "b.id = d.publication_id", "left")
            ->join("actor e", "d.actor_id = e.id", "left")
            ->where("node.cluster_id", $cluster_id)
            ->order_by("node.id asc");

        $publications = $query->get()->result();

        if($publications){
            foreach($publications as $publication){
                $id = $publication->id;

                foreach($publication as $key => $value)
                    $publication->{$key} = trim($value);

                $query=$this->db->select("
						a.*,
						c.full_name as author_name,
						c.forename as author_forename,
						c.surname as author_surname,
						c.occupation as author_occupation,
						c.short_description as author_short_description,
						c.organisation as author_organisation,
						c.orcid_id as author_orcid_id,
						d.name as article_category_name,
						e.name as bas_review_status_name,
						f.name as bas_licence_status_name,
						f.url as bas_licence_status_url,
						g.article_category_id as article_category_id,
						g.text as text
					")
                    ->from("article a")
                    ->join("article_actor_xrefs b", "a.id = b.article_id", "left")
                    ->join("actor c", "b.actor_id = c.id", "left")
                    ->join("article_category d", "a.article_category_id = d.id", "left")
                    ->join("bas_review_status e", "a.bas_review_status_id = e.id", "left")
                    ->join("bas_licence_status f", "a.bas_licence_status_id = f.id", "left")
                    ->join("sup_text_article_xrefs g", "g.article_id = a.id", "left")
                    ->where("a.publication_id", $id)
                    ->where($this->_online("a"))
                    ->order_by("a.id asc");
                $articles = $query->get()->result();

                if($articles){
                    foreach($articles as $article){
                        foreach($article as $key => $value ){
                            if($key!='id')
                                $article->{$key} = trim($value);
                        }

                        $article->chapters = $this->get_chapter(array('article_id' => $article->id), true);
                        $tagsQuery = $this->db->select("t.name,t.aat_search,t.ulan_search")
                            ->from('article a')
                            ->join("article_tag_xrefs x", "x.article_id = a.id")
                            ->join("tag t", "t.id = x.tag_id")
                            ->where("a.id", $article->id);
                        $tags = $tagsQuery->get()->result();
                        $article->tags = $tags;
                    }
                }

                $publication->articles = $articles;
                $pagesQuery = $this->db->select("rank,name,description")->from('page')->where(node_id, 22);
                $pages = $pagesQuery->get()->result();
                $publication->pages = $pages;
            }
        }

        return $publications;
    }
}