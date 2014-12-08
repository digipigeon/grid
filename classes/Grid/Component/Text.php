<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Search Component
 *
 * @package     Grid
 * @author      Jonathan Hulme
 * @copyright   (C) 2013 Digipigeon Limited
 * @license     MIT
 */
class Grid_Component_Text extends Grid_Component{

	public $text;

	public function render() {
		return $this->text;
	}
}

