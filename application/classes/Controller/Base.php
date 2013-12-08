<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Base extends Controller_Template
{

    public $template = 'master';

    public function before()
    {

        if ($this->request->is_ajax() OR !$this->request->is_initial()) {
            $this->auto_render = FALSE;
        } else {
            parent::before();

            $this->template->header = View::factory('header');

//            $this->template->footer = View::factory('footer');
        }
    }
}