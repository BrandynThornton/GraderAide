<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Student extends Controller_Base
{

    //private $getstudents;
    //
    //public function __construct()
    //{
    //	$this->getstudents = DB::select()->from('Student')->as_object('Student');
    //	//parent:__construct();
    //}

    public function action_index()
    {
        $results = DB::select()->from('Student')->as_object('Model_Student');

        $results = $results->execute();

        $this->template->content = View::factory('studenttable')->set('students', $results);
    }

    public function action_addnewform()
    {
        $this->template->content = View::factory('newstudentform');
    }

    public function action_newstudent()
    {
        $student = new Model_Student;
        $student->create($_POST);

        $this->template->content = View::factory('studentaddsuccess')
            ->set('student', $student);
    }
}