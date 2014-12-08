<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Grid_Component_Dropdown
 *
 * @package     Grid
 * @author      Jonathan Hulme
 * @copyright   (C) 2013 Digipigeon Limited
 * @license     MIT
 */
class Grid_Component_Dropdown extends Grid_Component{

	public $placeholder = '';
	public $class = '';
	public $pull;
	public $value;
	public $dropdown;

	/**
	 * Grid_Component_Dropdown::__construct()
	 * 
	 * @return
	 */
	public function __construct(){
		if (isset($_REQUEST['search'])){
			$this->value = $_REQUEST['search'];
		}
	}

	/**
	 * Grid_Component_Dropdown::render()
	 * 
	 * @return
	 */
	public function render() {
		return $this->dropdown->render();
	}
}

