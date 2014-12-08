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
	public $group_text = '';
	public $group_action = '';
	public $group_attrs = Array('class' => 'btn btn-primary');
	public $container_attrs = Array('class' => 'btn-group', 'style' => 'float:none');
	public $drop_attrs = Array('class' => 'dropdown-menu');
	
	private $group;
	
	public function push(){
		$this->group[] = Array('action' => $this->action, 'text' => $this->text, 'attrs' => $this->attrs);
	}

	public function render() {
		if (empty($this->group)){
			return HTML::anchor($this->action, $this->text, array_merge(Array('class'=> 'btn'),$this->attrs));
		} else {
			$container_attrs = HTML::attributes($this->container_attrs);
			$r = "<div $container_attrs>";
			if ($this->group_action){
				$attrs = HTML::attributes($this->group_attrs);
				$r .= "<a href='$this->group_action' $attrs>{$this->group_text}</a>";
				
				if (empty($this->group_attrs['class']))$this->group_attrs['class'] = '';
				$this->group_attrs['class'] .= " dropdown-toggle";
				unset($this->group_attrs['rel']);
				
				$attrs = HTML::attributes($this->group_attrs);
				$r .= "<button data-toggle='dropdown' $attrs><span class='caret'></span></button>";
			} else {
				$r .= "<button type='button' data-toggle='dropdown' class='btn dropdown-toggle btn-primary'>{$this->group_text} &nbsp;<span class='caret'></span></button>";
			}
			
			$drop_attrs = HTML::attributes($this->drop_attrs);
			$r .= "<ul $drop_attrs>";

			foreach($this->group as $group){
				$r .= '<li>' . HTML::anchor($group['action'], $group['text'],$group['attrs']) . '</li>';
			}
			return $r . '</ul></div>';
		}
	}
}

