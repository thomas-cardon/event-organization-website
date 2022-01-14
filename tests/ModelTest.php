<?php


use PHPUnit\Framework\TestCase;


require_once "src/core/AutoLoad.php";

class ModelTest extends TestCase
{

    public function testGetDatabaseInstance()
    {
        $this->assertNotNull(Model::getDatabaseInstance());
    }
}
