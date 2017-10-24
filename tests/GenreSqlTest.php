<?php

include ('SqlForTest.php');
include ('../../server/app/config.php');
include ('../../server/app/genre/libs/GenreSql.php');

class GenreSqlTest extends PHPUnit_Framework_TestCase
{
    private $db;
    private $dbForTest;
    private $genreName = 'testGenre';
    public function __construct()
    {
        $this->db = new GenreSql();
        $this->dbForTest = new SqlForTest();
    }

    public function testAddGenre()
    {
        $addResult = $this->db->addGenre($this->genreName);
        $this->assertTrue($addResult);
    }

    public function testGetAllGenres()
    {
        $selectResult = $this->db->getAllGenres();
        foreach($selectResult as $val)
        {
            $this->assertArrayHasKey('name', $val);
            $this->assertArrayNotHasKey('surname', $val);
        }
    }

    public function testGetGenre()
    {
        $result = $this->dbForTest->getGenreId($this->genreName);
        $id = $result[0]['id'];
        $selectResult = $this->db->getGenre($id);
        foreach($selectResult as $val)
        {
            $this->assertEquals($this->genreName,$val['name']);
        }
    }

    public function testUpdateGenre(){
        $result = $this->dbForTest->getGenreId($this->genreName);
        $id = $result[0]['id'];
        $updateResult = $this->db->updateGenre($id,$this->genreName);
        $this->assertTrue($updateResult);
    }


    public function testDeleteGenre()
    {
        $result = $this->dbForTest->getGenreId($this->genreName);
        $id = $result[0]['id'];
        $deleteResult = $this->db->deleteGenre($id);
        $this->assertTrue($deleteResult);
    }
}