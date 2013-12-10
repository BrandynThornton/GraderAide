<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Student extends Controller_Base
{

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
        $data = $this->request->post();

        $student = new Model_Student;
        $student->create($data);

        $this->template->content = View::factory('studentaddsuccess')
            ->set('student', $student);
    }
}