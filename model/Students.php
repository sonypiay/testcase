<?php

namespace Model;

use Model\Connection;
use PDO;

class ClassName extends AnotherClass
{
  protected $connection;

  public function __construct()
  {
    $this->connection = new Connection;
  }

  public function getAllData( $request = [] )
  {
    
  }

  public function show( $id )
  {

  }

  public function update( $id )
  {

  }

  public function destroy( $id )
  {

  }
}
