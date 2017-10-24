<?php

include ('SqlForTest.php');
include ('../../server/app/config.php');
include ('../../server/app/author/libs/AuthorSql.php');

class AuthorSqlTest extends PHPUnit_Framework_TestCase
{
    private $db;
    private $dbForTest;
    private $authorName = 'testAuthorName';
    private $authorSurname = 'testAuthorSurname';
    public function __construct()
    {
        $this->db = new AuthorSql();
        $this->dbForTest = new SqlForTest();
    }

    public function testAddAuthor()
    {
        $addResult = $this->db->addAuthor($this->authorName,$this->authorSurname);
        $this->assertTrue($addResult);
    }

    public function testGetAllAuthors()
    {
        $selectResult = $this->db->getAllAuthors();
        foreach($selectResult as $val)
        {
            $this->assertArrayHasKey('name', $val);
            $this->assertArrayHasKey('surname', $val);
        }
    }

    public function testGetAuthor()
    {
        $result = $this->dbForTest->getAuthorId($this->authorName,$this->authorSurname);
        $id = $result[0]['id'];
        $selectResult = $this->db->getAuthor($id);
        foreach($selectResult as $val)
        {
            $this->assertEquals($this->authorName,$val['name']);
            $this->assertEquals($this->authorSurname,$val['surname']);
        }
    }

    public function testUpdateAuthor(){
        $result = $this->dbForTest->getAuthorId($this->authorName,$this->authorSurname);
        $id = $result[0]['id'];
        $updateResult = $this->db->updateAuthor($id,$this->authorName,$this->authorSurname);
        $this->assertTrue($updateResult);
    }

    public function testDeleteAuthor()
    {
        $result = $this->dbForTest->getAuthorId($this->authorName,$this->authorSurname);
        $id = $result[0]['id'];
        $deleteResult = $this->db->deleteAuthor($id);
        $this->assertTrue($deleteResult);
    }
}