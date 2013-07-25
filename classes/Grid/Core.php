<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Grid modeling library for creating data tables
 *
 * @package     Grid
 * @author      Kyle Treubig
 * @copyright   (C) 2010 Kyle Treubig
 * @license     MIT
 */
class Grid_Core {

	protected $id;
	protected $form = false;
	protected $class;
	protected $row_attr_callback;
	protected $pagination = false;
	protected $header = Array();

	/** Array of table columns */
	private $columns = array();
	/** Array of action links */
	private $links = array();
	/** Table dataset */
	private $dataset = array();

	public function __construct($id = '', $class = ''){
		$this->id = $id;
		$this->class = $class;
	}

	public function form($action=false){
		$this->form = $action;
	}
	
	public function pagination($total_rows, $per_page){
		$this->pagination = new Grid_Pagination($total_rows, $per_page);
		return $this->pagination;
	}
	

	/**
	 * Add a column to the table
	 *
	 * @param   string      [optional] column type
	 * @return  Grid_Column
	 */
	public function &column($type='text') {
		$model = 'Grid_Column_' . ucfirst($type);
		$column = new $model;
		$index = count($this->columns);
		array_push($this->columns, $column);
		Kohana::$log->add(Log::DEBUG, 'Added '.$type.' column to grid');
		return $this->columns[$index];
	}

	public function &header($type='text'){
		$model = "Grid_Component_" . ucfirst($type);
		$link = new $model($type);
		$this->header[] = &$link; 
		return $link;
	}

	/**
	 * Add an action link to the table
	 *
	 * @param   string      [optional] link type
	 * @return  Grid_Link
	 */
	public function &link($type='text') {
		$link = new Grid_Link($type);
		$index = count($this->links);
		array_push($this->links, $link);
		//Kohana::$log->add(Kohana::DEBUG, 'Added '.$type.' link to grid');
		return $this->links[$index];
	}
	
	public function row_attr($callback){
		$this->row_attr_callback = $callback;
	}

	/**
	 * Add data to the table
	 *
	 * @param   array   collection of dataset records
	 * @return  Grid
	 */
	public function data($resource) {
		$dataset = array();
		foreach($resource as $data)
		{
			$dataset[] = $data;
		}
		array_splice($this->dataset, count($this->dataset), 0, $dataset);
		//Kohana::$log->add(Kohana::DEBUG, 'Added data to grid');
		return $this;
	}

	/**
	 * Render the table as an HTML string
	 *
	 * @param   string  [optional] view file
	 * @return  string
	 */
	public function render($view = 'grid/table') {
		$mobile = false;
		
//		if ($view == 'grid/table' && Request::factory()->user_agent('mobile') && $mobile){
//			$view = 'grid/mobile';
//		}
		$view = View::factory($view);
		
		$attrs = '';
		
		if ($this->id){
			$attrs .= ' id="' . $this->id . '"';
		}
		$attrs .= ' class="table table-hover ' . $this->class . '"';
		
		$view->form		= $this->form ? Form::open($this->form) : false;
		$view->attrs	= $attrs;
		$view->columns	= $this->columns;
		$view->header	= $this->header;
		$view->links	= $this->links;
		$view->dataset	= $this->dataset;
		$view->row_attr_callback = $this->row_attr_callback;
		$view->pagination	= $this->pagination;
		
		Kohana::$log->add(Log::DEBUG, 'Rendering the grid');
		return $view->render();
	}

	/**
	 * Alias for Grid::render()
	 */
	public function __tostring() {
		return $this->render();
	}

}

