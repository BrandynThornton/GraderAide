<?php defined('SYSPATH') OR die('No direct script access.');

class Controller_Assignment extends Controller
{

    public function action_index()
    {

        $data = json_decode($this->request->body(), TRUE);

        $model = new Model_Assignment($this->request->param('assignmentId'),$data);

        $model->save();

        $this->response->body(json_encode($model, JSON_NUMERIC_CHECK));

    }

    public function action_patch()
    {
        $data = json_decode($this->request->body(), TRUE);

        $model = new Model_Assignment($this->request->param('assignmentId'),$data);

        $model->save();

        $this->response->body(json_encode($model, JSON_NUMERIC_CHECK));

    }
}