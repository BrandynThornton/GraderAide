<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Assignment extends Model_Database
{
    public $Identifier;
    public $IntervalIdentifier;
    public $SubjectIdentifier;
    public $ExpectedScore;
    public $CompletedScore;
    public $Description;
    public $LetterGrade;
    
    
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

    }
    
}