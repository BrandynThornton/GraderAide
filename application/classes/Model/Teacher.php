<?php defined('SYSPATH') OR die('No direct script access.');

class Model_Teacher extends Model_Database
{
    public $Identifier;
    public $FirstName;
    public $LastName;

    public function __construct($Identifier = NULL, $FirstName = NULL, $LastName = NULL)
    {
        $result = DB::select()
            ->from('Teacher')
            ->where('Identifier', '=', $Identifier)
            ->execute();

        $this->Identifier  = $result->get('Identifier', $Identifier);
        $this->FirstName   = $result->get('FirstName', $FirstName);
        $this->LastName    = $result->get('LastName', $LastName);
    }

    public function create($data)
    {
        $query = DB::query(Database::INSERT,
            'INSERT INTO Teacher (FirstName, LastName)
            VALUES (firstname, lastname)')
            ->parameters($data);
        $query->execute();

        $this->FirstName = Arr::get($data, 'firstname');
        $this->LastName  = Arr::get($data, 'lastname');
    }

    public function get_stuff()
    {
        // Get stuff from the database:
        return $this->db->query();
    }
}