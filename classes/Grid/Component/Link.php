<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Search Component
 *
 * @package     Grid
 * @author      Jonathan Hulme
 * @copyright   (C) 2013 Digipigeon Limited
 * @license     MIT
 */
class Grid_Component_Link extends Grid_Component{

	public $text = '';
	public $action = '';
	

	public function render() {
		return HTML::anchor($this->action, $this->text,array_merge(Array('class'=> 'btn'),$this->attrs));
	}
}

