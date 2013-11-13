<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Assignment extends Model_Database
{
    //public $Identifier; //not needed for anything, Intveral and Subject are PK
    public $IntervalIdentifier;
    public $SubjectIdentifier;
    public $ExpectedScore;
    public $CompletedScore;
    public $Description;
    public $LetterGrade;
    public $AutoPopulate;
    
    
    public function __construct($IntervalIdentifier = NULL, $SubjectIdentifier = NULL, $ExpectedScore = NULL, $CompletedScore = NULL, $Description = NULL, $LetterGrade = NULL, $AutoPopulate = true)
    {
      $this->$IntervalIdentifier = $IntervalIdentifier;
      $this->$SubjectIdentifier = $SubjectIdentifier;
      $this->$ExpectedScore = $ExpectedScore;
      $this->$CompletedScore = $CompletedScore;
      $this->$Description = $Description;
      $this->$LetterGrade = $LetterGrade;
      if($AutoPopulate)
         $this->populate();
      parent::__construct();
    }
    
    public function populate()
    {
      $query = DB::select()->from('Assignment')->where('IntervalIdentifier', '=', $this->$IntervalIdentifier)->and_where('SubjectIdentifier', '=', $this->$SubjectIdentifier);
      $r = $query->execute();
      
      $this->ExpectedScore  = Arr::get($r, 'ExpectedScore');
      $this->CompletedScore = Arr::get($r, 'CompletedScore');
      $this->Description    = Arr::get($r, 'Description');
      $this->LetterGrade    = Arr::get($r, 'LetterGrade');
    }
    
    public function save()
    {
      $query = DB::select()->from('Assignment')->where('IntervalIdentifier', '=', $this->$IntervalIdentifier)->and_where('SubjectIdentifier', '=', $this->$SubjectIdentifier);
      $r = $query->execute();
      if($r->count() == 0)
         $this->dbInsert();
      else
         $this->dbUpdate();
    }
    
    public function dbInsert()
    {
      $query = DB::insert('Assignment', array('IntervalIdentifier', 'SubjectIdentifier', 'ExpectedScore', 'CompletedScore', 'Description', 'LetterGrade'))->values(array($this->$IntervalIdentifier, $this->$SubjectIdentifier, $this->$ExpectedScore, $this->$CompletedScore, $this->$Description, $this->$LetterGrade));
      
      $r = $query->execute();
    }
    
    public function dbUpdate()
    {
      $query = DB::update('Assignment')->set(array('ExpectedScore' => $this->$ExpectedScore, 'CompletedScore' => $this->$CompletedScore, 'Description' => $this->$Description, 'LetterGrade' => $this->$LetterGrade))->where('IntervalIdentifier', '=', $this->$IntervalIdentifier)->and_where('SubjectIdentifier', '=', $this->$SubjectIdentifier);
      
      $r = $query->execute();
    }
    
}