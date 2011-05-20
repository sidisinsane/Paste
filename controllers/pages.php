<?php

// draw content pages
class pages_controller extends template_controller {

	public function __call($section, $args) {

		if ($section == "index") {
			$section = Content::$root_section;
		}


		$this->template->content = '<p><b>'.$section.' / '.@$args[0].'</b></p>';

		// TODO: remove index controller, make this the default controller, check root section for index.html
		// TODO: check if index page has content, show it, otherwise redirect to first page

		if (empty($args[0])) {

			// return $this->all($section);

			// redirect to first project
			//Router::redirect('/'.$section.'/index');
			$this->template->content .= Page::factory($section);

		} else {

			$this->template->content .= Page::factory($args[0]);
		}

	}

	public function all($section) {

		$output = '<h1>All Pages of <b>'.$section.'</b></h1>';

/*
		foreach (Content::load_section($section) as $name) {
			$output .= $name.'<br/>';
		}*/

		$this->template->content = $output;

	}

}