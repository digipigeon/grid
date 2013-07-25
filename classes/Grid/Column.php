<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Grid column model base class
 *
 * @package     Grid
 * @author      Kyle Treubig
 * @copyright   (C) 2010 Kyle Treubig
 * @license     MIT
 */
abstract class Grid_Column {

	/**
	 * @var string  dataset record field
	 */
	public $field;

	/**
	 * @var string  column title
	 */
	public $title;

	/**
	 * @var string  column title
	 */
	public $sort;

	/**
	 * Magic call method to set variable member when
	 * variable method is called
	 *
	 * @param   string      variable name
	 * @param   string      variable value
	 * @return  Grid_Column
	 */
	public function __call($name, $value) {
		if ((isset($this->$name)) OR ($this->$name === null))
		{
			$this->$name = $value[0];
		}
		return $this;
	}

	public function render_th(){
		$title = $this->title;
		$query_data = $_REQUEST;
		if (!empty($this->sort)){
			$query_data['sort'] = $this->sort;
			if (!empty($_REQUEST['sort'])){
				if ($_REQUEST['sort'] == $this->sort){
					if (isset($_REQUEST['direction']) && $_REQUEST['direction'] == 'desc'){
						$title = "$title" . ' <i class="icon-sort-up"></i>';
						unset($query_data['direction']);
					} else {
						$title = "$title" . ' <i class="icon-sort-down"></i>';
						$query_data['direction'] = 'desc';
					}
				} else {
					$title = "$title" . ' <i class="icon-sort"></i>';
				}
			} else{
				$title = "$title" . ' <i class="icon-sort"></i>';
			}
			$title = "<a href='" . $_SERVER['PATH_INFO'] . '?' . http_build_query($query_data) . "'>$title</a>";
			
		}
		return $title;
	}
}
