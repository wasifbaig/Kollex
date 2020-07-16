<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Service\ProductFactory;

/**
 * Description of ProductControllerTest
 *
 * @author wasif baig
 */
class ProductControllerTest extends WebTestCase{
    
    public $file1 = 'public/data/wholesaler_b.json';
    public $file2 = 'public/data/wholesaler_a.csv';
    
    public function testNoFile()
    {
        $this->expectExceptionMessage("File is missing.");
        ProductFactory::create();
    }
    
    public function testNoFileExist()
    {
        $this->expectExceptionMessage("File does not exist.");
        $product= ProductFactory::create('public/data/no_wholesaler_b.json');
        $product->getProducts();
    }
    
    public function testNoExtentionSupport()
    {
        $this->expectExceptionMessage("File extention is not supported.");
        ProductFactory::create('public/data/wholesaler_b.xml');
    }
    
    public function testFileEmpty()
    {
        $this->expectExceptionMessage("File is empty.");
        $product = ProductFactory::create(__DIR__ .'/data/empty_wholesaler_a.json');
        $product->getProducts();
    }
    
    public function testImportJsonFile()
    { 
        $product = ProductFactory::create($this->file1);
        $products = $product->getProducts();
        $json = $product->toJson($products);
        
        $this->assertJson($json, 'Return Json is not valid');
        $this->assertJsonStringEqualsJsonFile(__DIR__ ."/data/expected_wholesaler_b.json", $json);
    }

    public function testImportCsvFile()
    {
        $product = ProductFactory::create($this->file2);
        $products = $product->getProducts();
        $json = $product->toJson($products);
        
        $this->assertJson($json, 'Return Json is not valid');
        $this->assertJsonStringEqualsJsonFile(__DIR__ ."/data/expected_wholesaler_a.json", $json);
    }
    
}
