<?php defined('SYSPATH') OR die('No direct script access.');

trait Grid_ORM{
	public function grid($grid, $config=Array()){
		$fields = Array();
		
		foreach($this->fields() as $key => $field){
			$view_data = Array();
			if (empty($field['view']['grid'])) continue;
			if (is_array($field['view']['grid'])){
				$view_data = $field['view']['grid'];
			}
			unset($field['view']);
			$view_data = array_merge($field, $view_data);
			$fields[$key] = $view_data;
		}
		if (!empty($config['fields'])){
			$fields = array_merge_recursive($fields, $config['fields']);
		}
		foreach($fields as $key => $field){
			$this->grid_field($grid, $key, $field);
		}
		$grid->data($this->find_all());
		return $grid;
	}
	
	protected function grid_field($grid,$key, $field = Array()){
		$type = 'text';
		if (!empty($field['type'])){
			$type = $field['type'];
		}
		if (!empty($field['id'])){
			$key = $field['id'];
		}
		
		$column = $grid->column($type)->field($key)->title($field['label']);

		if (!empty($field['callback'])){
			$column->callback($field['callback']);
		}
		if (!empty($field['url'])){
			$column->url($field['url']);
		}
		if (!empty($field['text'])){
			$column->text($field['text']);
		}
		if (!empty($field['col_attrs'])){
			$column->col_attrs($field['col_attrs']);
		}
		if (!empty($field['cell_attrs'])){
			$column->cell_attrs($field['cell_attrs']);
		}
	}
}