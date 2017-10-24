<?php

include ('SqlForTest.php');
include ('../../server/app/config.php');
//include ('../../server/app/genre/libs/GenreSql.php');

class RestServerTest extends PHPUnit_Framework_TestCase
{
    private $http;
    private $hash;
    public function __construct()
    {
        $db = new SqlForTest();
        $result = $db->getHash();
        $this->hash = $result[0]['hash'];
    }
    public function setUp()
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'http://192.168.0.15/~user14/bookShop1/client/api/']);
    }

    public function tearDown() {
        $this->http = null;
    }
    public function testGetBooks()
    {
        $response = $this->http->request('GET', 'book/');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
        
        $json = json_encode(json_decode($response->getBody()));
        $validJson = ((is_string($json) && (is_object(json_decode($json)) || is_array(json_decode($json))))) ? true : false;

        $this->assertTrue($validJson);
    }

    public function testGetAuthors()
    {
        $response = $this->http->request('GET', 'author/');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $json = json_encode(json_decode($response->getBody()));
        $validJson = ((is_string($json) && (is_object(json_decode($json)) || is_array(json_decode($json))))) ? true : false;

        $this->assertTrue($validJson);
    }

    public function testGetGenres()
    {
        $response = $this->http->request('GET', 'genre/');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $json = json_encode(json_decode($response->getBody()));
        $validJson = ((is_string($json) && (is_object(json_decode($json)) || is_array(json_decode($json))))) ? true : false;

        $this->assertTrue($validJson);
    }

    public function testGetOrderStatuses()
    {
        $response = $this->http->request('GET', 'orderStatus/');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $json = json_encode(json_decode($response->getBody()));
        $validJson = ((is_string($json) && (is_object(json_decode($json)) || is_array(json_decode($json))))) ? true : false;

        $this->assertTrue($validJson);
    }

    public function testGetPaymentSystems()
    {
        $response = $this->http->request('GET', 'paymentSystem/');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $json = json_encode(json_decode($response->getBody()));
        $validJson = ((is_string($json) && (is_object(json_decode($json)) || is_array(json_decode($json))))) ? true : false;

        $this->assertTrue($validJson);
    }

    public function testGetOrders()
    {
        $response = $this->http->request('GET', 'order/'.$this->hash);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $json = json_encode(json_decode($response->getBody()));
        $validJson = ((is_string($json) && (is_object(json_decode($json)) || is_array(json_decode($json))))) ? true : false;

        $this->assertTrue($validJson);
    }

    public function testGetUsers()
    {
        $response = $this->http->request('GET', 'user/'.$this->hash);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $json = json_encode(json_decode($response->getBody()));
        $validJson = ((is_string($json) && (is_object(json_decode($json)) || is_array(json_decode($json))))) ? true : false;

        $this->assertTrue($validJson);
    }

//    public function testUpdateGenre()
//    {
////        $ch = curl_init($this->url.'genre/');
////        curl_setopt($ch, CURLOPT_PUT, true);
////        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
////        $fields = array("hash" => json_decode($this->hash),
////            "id"=>json_decode(8),
////            'name'=>json_decode('updateName'));
////        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
////        $response = curl_exec($ch);
////        var_dump($response);
//        $hash = json_decode($this->hash);
//        var_dump($hash);
//        $response = $this->http->request('PUT', 'genre/',['form_params' => [
//                'hash' =>json_encode("026b914da592d805adecb2c4eb597572"),
//                'id' => '8',
//                'name' => 'newName'
//            ]]);
////            'form_params' => [
////                'hash' => $this->hash,
////                'id' => '8',
////                'name' => 'newName'
////            ]
////var_dump($this->http->request('PUT', 'genre/'));
//        $this->assertEquals(200, $response->getStatusCode());
//
//        $contentType = $response->getHeaders()["Content-Type"][0];
//        $this->assertEquals("application/json", $contentType);
//
//        $json = json_encode(json_decode($response->getBody()));
////        var_dump($json);
//        $validJson = ((is_string($json) && (is_object(json_decode($json)) || is_array(json_decode($json))))) ? true : false;
//
//        $this->assertTrue($json);
//    }
}
