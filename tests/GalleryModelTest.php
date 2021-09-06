<?php

require_once '../tests/BaseTest.php';

class GalleryModelTest extends BaseTest {

    public function testGetAllImages(){
        $this->assertNotNull(GalleryModel::getAll());
    }

    public function testGetOneImages(){
        $ids = GalleryModel::getAll();
        $res = GalleryModel::getOne($ids[0]['id']);
        $this->assertNotNull($res);
    }

}