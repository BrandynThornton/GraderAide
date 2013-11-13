<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Student extends Model_Database
{
    public $Identifier;
    public $FirstName;
    public $LastName;
    public $DateOfBirth;
    public $Male;
    public $GradeLevel;
    public $Intervals = array();


    public function __construct($Identifier = NULL, $FirstName = NULL, $LastName = NULL, $DateOfBirth = NULL, $Male = NULL, $GradeLevel = NULL)
    {
        $result = DB::select()
            ->from('Student')
            ->where('Identifier', '=', $Identifier)
            ->execute();

        $this->Identifier  = $result->get('Identifier', $Identifier);
        $this->FirstName   = $result->get('FirstName', $FirstName);
        $this->LastName    = $result->get('LastName', $LastName);
        $this->DateOfBirth = $result->get('DateOfBirth', $DateOfBirth);
        $this->Male        = $result->get('Male', $Male);
        $this->GradeLevel  = $result->get('GradeLevel', $GradeLevel);

        $results = DB::select()
            ->from('Interval')
            ->where('StudentIdentifier', '=', $this->Identifier)
            ->execute();

        for ($i = 0; $i < $results->count(); $i++) {
            array_push($this->Intervals,
                new Model_Interval($results->get('Identifier')));
            $results->next();
        }
    }

    public function create($data)
    {
        if (isset($data, $data['DOB'])) {
            $data['DOB'] = date('Y-m-d', strtotime($data['DOB']));
        }

        if (isset($data, $data['male'])) {
            $data['male'] = (bool)$data['male'];
        }

        $query = DB::query(Database::INSERT,
            'INSERT INTO Student (FirstName, LastName, DateOfBirth, Male, GradeLevel)
            VALUES (firstname, lastname, DOB, male, grade)')
            ->parameters($data);
        $query->execute();

        $this->FirstName   = Arr::get($data, 'firstname');
        $this->LastName    = Arr::get($data, 'lastname');
        $this->DateOfBirth = Arr::get($data, 'DOB');
        $this->Male        = Arr::get($data, 'male');
        $this->GradeLevel  = Arr::get($data, 'grade');
    }

    public function gender()
    {
        return $this->Male ? 'Male' : 'Female';
    }

    public function hisher()
    {
        return $this->Male ? 'his' : 'her';
    }


}