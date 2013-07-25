<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Grid table action link model
 *
 * @package     Grid
 * @author      Kyle Treubig
 * @copyright   (C) 2010 Kyle Treubig
 * @license     MIT
 */
class Grid_Component {

	/**
	 * @var string  link type
	 */
	public $type;

	/**
	 * @var string  action URL
	 */
	public $action;

	/**
	 * @var string  display text
	 */
	public $text;
	public $attrs = Array();
	public $pull;
	public $class;
	

	/**
	 * Magic call method to set variable members
	 * through method calls
	 *
	 * @param   string      variable name
	 * @param   string      variable value
	 * @return  Grid_Link
	 */
	public function __call($name, $value) {
		if ((isset($this->$name)) OR ($this->$name === null))
		{
			$this->$name = $value[0];
		}
		return $this;
	}

	/**
	 * Render the link as an HTML string
	 *
	 * @return  string
	 */
	public function render() {
		switch ($this->type){
			case 'submit':
				$link = Form::submit('submit', $this->text, array_merge(Array('class'=> 'btn'),$this->attrs));
				break;
			case 'button':
				$link = $this->dropdown->render();
				//$link = html::anchor($this->action, '<button type="button">' . $this->text . '</button>');
				break;
			case 'text':
				$link = $this->text;
				//$link = html::anchor($this->action, '<button type="button">' . $this->text . '</button>');
				break;
			case 'link':
				default:
				$link = HTML::anchor($this->action, $this->text,array_merge(Array('class'=> 'btn'),$this->attrs));
		}
		return $link;
	}

	/**
	 * Alias for Grid_Link::render()
	 */
	public function __tostring() {
		return $this->render();
	}

}	// End of Grid_Link

