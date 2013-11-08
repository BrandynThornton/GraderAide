<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Student extends Model_Database
{
    public $Identifier;
    public $FirstName;
    public $LastName;
    public $DateOfBirth;
    public $Male;
    public $GradeLevel;
    
    
    public function __construct($data = NULL)
    {
        if (isset($data)) {
            foreach($data as $k => $v) {
                $this->$k =$v;
            }
        }
        
        parent::__construct();
    }
    
    public function create($data)
    {
        if (isset($data,$data['DOB'])) {
            $data['DOB'] = date('Y-m-d', strtotime($data['DOB']));
        }
        
        if (isset($data,$data['male'])) {
            $data['male'] = (bool) $data['male'];
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