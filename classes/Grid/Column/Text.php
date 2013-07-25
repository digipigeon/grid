<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Text column for Grid library
 *
 * @package     Grid
 * @author      Kyle Treubig
 * @copyright   (C) 2010 Kyle Treubig
 * @license     MIT
 */
class Grid_Column_Text extends Grid_Column {

	/**
	 * @var string  callback function
	 * @var array   callback class and method
	 */
	public $callback = null;
	public $append = '';

	/**
	 * Render the table cell for this column, given data.
	 *
	 * Outputs the dataset field, or sub-member of that field,
	 * parsed by the parsing function and/or callback function.
	 *
	 * @param   object  dataset record
	 * @param   array   dataset record
	 * @return  string
	 */
	public function render($data) {
		$data = (object) $data;
		if (isset($data->{$this->field})){
			$text = $data->{$this->field};		
		} else {
			$text = '';
		}
		if (!empty($this->callback) && is_callable($this->callback)){
			$cb = $this->callback;
			$text = $cb($text, $data);
		}
		$text .= $this->append;

		return $text;
	}

}	// End of Grid_Column_Text

