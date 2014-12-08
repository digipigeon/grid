<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Search Component
 *
 * @package     Grid
 * @author      Jonathan Hulme
 * @copyright   (C) 2013 Digipigeon Limited
 * @license     MIT
 */
class Grid_Component_Search extends Grid_Component{

	public $placeholder = '';
	public $value;

	public function __construct(){
		if (isset($_REQUEST['search'])){
			$this->value = $_REQUEST['search'];
		}
	}

	public function render() {
		return "<input type='text' placeholder='{$this->placeholder}' class='{$this->class}' value='$this->value'>";
	}
}

