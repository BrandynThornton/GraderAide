<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Base extends Controller_Template {

	public $template = 'master';

	public function before()
	{
        $this->response->headers('Cache-Control', 'no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0');
        $this->response->headers('Pragma', 'no-cache');

        if (Session::instance()->get('region'))
        {
            $lang = I18n::load(Session::instance()->get('region'));

            if (!empty($lang))
            {
                I18n::lang(strtolower(Session::instance()->get('region')));
            }
        }

		if ($this->request->is_ajax() OR ! $this->request->is_initial())
        {
			$this->auto_render = FALSE;
		}
		else
		{
			parent::before();

			$this->template->header = View::factory('header')->set('is_dashboard', TRUE);

			$this->template->footer = View::factory('footer');
		}
	}
}