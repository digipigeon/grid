<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Pagination Module for Grid Control
 *
 * @package     Grid
 * @author      Kyle Treubig
 * @copyright   (C) 2010 Kyle Treubig
 * @license     MIT
 */
class Grid_Pagination {
	protected $page;
	protected $pages;
	protected $total_rows;
	protected $per_page;
	protected $max_pages = 10;
	protected $last_page;
	protected $range_start;
	protected $range_end;
	protected $link;
	
	
	public function __construct($total_rows, $per_page){
		$this->page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
		$this->link = $_SERVER['PATH_INFO'];

		$this->total_rows = $total_rows;
		$this->per_page = $per_page;

		$this->last_page = ceil($this->total_rows / $this->per_page);
		$this->range_start = ($this->page < 5) ? 1 : $this->page - 4; 
		$this->range_end = ($this->page < $this->last_page - 5) ? $this->page + 4 : $this->last_page; 
		
		$this->pages = ceil($total_rows / $per_page);
		if ($this->pages > $this->max_pages) $this->pages = $this->max_pages;
	}
	
	public function render(){
		$link = $this->link;
		
		return new View('grid/pagination', Array(
			//'link'		=> $this->link,
			'range'		=> range($this->range_start,$this->range_end),
			'page'		=> $this->page,
			'last'		=> $this->last_page,
			'link' => function($page=false) use ($link){
				$params = $_REQUEST;
				if ($page){
					$params['page'] = $page;
				} else {
					unset($params['page']);
				}
				return $link . "?" . http_build_query($params);
			}
		));
	}
}