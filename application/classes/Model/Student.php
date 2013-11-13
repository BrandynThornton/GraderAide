<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Student extends Model_Database
{
    public $Identifier;
    public $FirstName;
    public $LastName;
    public $DateOfBirth;
    public $Male;
    public $GradeLevel;
    public $Intervals;
    
    
    public function __construct($Identifier = NULL, $FirstName = NULL, $LastName = NULL, $DateOfBirth = NULL, $Male = NULL, $GradeLevel = NULL)
    {
      $this->$Identifier = $Identifier;
      $this->$FirstName = $FirstName;
      $this->$LastName = $LastName;
      $this->$DateOfBirth = $DateOfBirth;
      $this->$Male = $Male;
      $this->$GradeLevel = $GradeLevel;
      if(isset($this->$Identifier))
         $this->populate();
      parent::__construct();
    }
    
    public function populate()
    {
      $query = DB::select()->from('Student')->where('Identifier', '=', $this->$Identifier);
      $r = $query->execute();
      
      $this->FirstName     = Arr::get($r, 'FirstName');
      $this->LastName      = Arr::get($r, 'LastName');
      $this->DateOfBirth   = Arr::get($r, 'DateOfBirth');
      $this->Male          = Arr::get($r, 'Male');
      $this->GradeLevel    = Arr::get($r, 'GradeLevel');
      
      $this->Intervals = array();
      
      $intervalQuery = DB::select()->from('Interval')->where('StudentIdentifier', '=', $this->$Identifier);
      $intervalQuery->execute();
      
      foreach ($intervalQuery as $interval) {
			array_push($this->$Intervals,
				new Model_Interval($$interval['Identifier']))
			);
		}
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