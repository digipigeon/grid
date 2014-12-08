<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Search Component
 *
 * @package     Grid
 * @author      Jonathan Hulme
 * @copyright   (C) 2013 Digipigeon Limited
 * @license     MIT
 */
class Grid_Component_Submit extends Grid_Component{
	public $text;
	public function render() {
		return Form::submit('submit', $this->text, array_merge(Array('class'=> 'btn'),$this->attrs));
	}
}

