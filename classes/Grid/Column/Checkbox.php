<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Radio column for Grid library
 *
 * @package     Grid
 * @author      Jonathan Hulme
 * @copyright   (C) 2010 Kyle Treubig, Jonathan Hulme 2011
 * @license     MIT
 */
class Grid_Column_Checkbox extends Grid_Column {

	/**
	 * @var string  dataset record field to use as radio value, defaults to "id"
	 */
	public $field = 'id';

	/**
	 * @var string  radio field name
	 */
	public $name;

	/**
	 * Render the table cell for this column, given data.
	 *
	 * Returns a radio field for the specified dataset field.
	 *
	 * @param   object  dataset record
	 * @param   array   dataset record
	 * @return  string
	 */
	public function render($data) {
		$data = (object) $data;
		$data_field = $data->{$this->field};
		if (!empty($this->callback) && is_callable($this->callback)){
			$cb = $this->callback;
			$data_field = $cb($data_field, $data);
		}
		return Form::checkbox($this->name . '[]', $data_field);
	}

}	// End of Grid_Column_Radio

