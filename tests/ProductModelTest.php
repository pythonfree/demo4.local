<?php
require_once '../tests/BaseTest.php';

class ProductModelTest extends BaseTest {

    public function testGetAllProduct(){
        $this->assertNotNull(ProductModel::getAll());
    }

    public function testGetLimitProduct(){
        $res = ProductModel::getLimitItem(20);
        $this->assertNotNull($res);
        $this->assertEquals(20,count($res));
    }

    public function testGetOneProduct(){
        $ids = ProductModel::getLimitItem(1);
        $res = ProductModel::getOne($ids[0]['id']);
        $this->assertNotNull($res);
    }

}

