<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Interval extends Model_Database
{
    public $Identifier;
    public $ClassroomIdentifier;
    public $StudentIdentifier;
    public $Date;
    public $Assignments;
    
    public function __construct($Identifier = NULL, $ClassroomIdentifier = NULL, $StudentIdentifier = NULL, $Date = NULL)
    {
      $this->$Identifier = $Identifier;
      $this->$ClassroomIdentifier = $ClassroomIdentifier;
      $this->$StudentIdentifier = $StudentIdentifier;
      $this->$Date = $Date;
      if(isset($this->$Identifier))
         $this->populate();
      parent::__construct();
    }
    
    public function populate()
    {
      $query = DB::select()->from('Interval')->where('Identifier', '=', $this->$Identifier);
      $r = $query->execute();
      
      $this->ClassroomIdentifier  = Arr::get($r, 'ClassroomIdentifier');
      $this->StudentIdentifier    = Arr::get($r, 'StudentIdentifier');
      $this->Date                 = Arr::get($r, 'Date');
      
      $subjectQuery = DB::select()->from('ClassroomSubject')->where('ClassroomIdentifier', '=', $this->$ClassroomIdentifier);
      $subjectQuery->execute();
      
      $this->$Assignments = array();
      
      foreach ($subjectQuery as $subject) {
			array_push($this->$Assignments,
				new Model_Assignment($this->IntervalIdentifier, $subject['SubjectIdentifier']))
			);
		}
    }
    
    public function save()
    {
      if(isset($this->$Identifier))
         $this->dbInsert();
      else
         $this->dbUpdate();
    }
    
    public function dbInsert()
    {
      $query = DB::insert('Interval', array('ClassroomIdentifier', 'StudentIdentifier', 'Date'))->values(array($this->$ClassroomIdentifier, $this->$StudentIdentifier, $this->$Date));
      
      $r = $query->execute();
    }
    
    public function dbUpdate()
    {
      $query = DB::update('Interval')->set(array('ClassroomIdentifier' => $this->$ClassroomIdentifier, 'StudentIdentifier' => $this->$StudentIdentifier, 'Date' => $this->$Date))->where('Identifier', '=', $this->$Identifier);
      
      $r = $query->execute();
    }
    
}