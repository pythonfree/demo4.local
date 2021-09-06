<?php
require_once '../App.php';

use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase{

   function setUp(): void
   {
       App::init();
   }

}
