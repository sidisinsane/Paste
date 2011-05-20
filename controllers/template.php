<?php

class template_controller {

	// template view model
	public $template;

	// template mustache file
	public $_template = 'site.mustache';

	public function __construct() {

		// setup mustache template
		$this->template = new Mustache(file_get_contents(APPPATH.'views/templates/'.$this->_template));

		// default title
		$this->template->title = 'pastetwo';

		// content area
		$this->template->content = '';

		// init menu view model
		$this->template->menu = new Menu;

		// set current section to controller name
		$this->template->current_section = Router::$controller;

		// set current section to controller name
		$this->template->current_page = Router::$method;

		// bind current_section in menu view to template var
		$this->template->menu->current_section =& $this->template->current_section;

		// bind current_page in menu view to template var
		$this->template->menu->current_page =& $this->template->current_page;

	}

	public function __call($method, $args) {

		// print_r(func_get_args());
		return $this->error_404();

	}

	public function error_404() {

		header('HTTP/1.1 404 File Not Found');

		$this->template->content = '<h1>Page not found!</h1>';

	}

	public function _render() {

		// render the template after controller execution
		echo $this->template->render();

	}

}