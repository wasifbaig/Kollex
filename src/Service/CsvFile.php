<?php
namespace App\Service;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use App\Entity\Product;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Description of JsonFile
 *
 * @author wasif baig
 */
class CsvFile implements ProductInterface
{
    /**
     * trait
     */
    use DataProvider;
    
    /**
     * @var string 
     */
    public $file;
    
    
    /**
     * 
     * @param string $filePath
     */
    public function __construct(string $filePath) {
        $this->file = $filePath;
    }
    
    /**
     * 
     * @return array
     * @throws Exception
     */
    public function getProducts()
    {
        if(!file_exists($this->file))
            throw new Exception('File does not exist.');  
        
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        $data = $serializer->decode(file_get_contents($this->file), 'csv',array(CsvEncoder::DELIMITER_KEY => ';'));
        
        if(empty($data))
            throw new Exception('File is empty');
        
        $products = [];
        foreach($data as $productInfo)
        {
            $product = new Product();
            $product->setId($productInfo['id'] ?? null);
            $product->setGtin($productInfo['ean'] ?? null);
            $product->setManufacturer($productInfo['manufacturer'] ?? null);
            $product->setName($productInfo['product'] ?? null);
            $product->setPackaging($productInfo['packaging product'] ?? null);
            $product->setBaseProductPackaging($productInfo['packaging unit'] ?? null);
            $product->setBaseProductAmount($productInfo['amount per unit'] ?? null);
            $product->setBaseProductQuantity($productInfo['items on stock (availability)'] ?? null);
           
            array_push($products,$product);
        }
        
        return $products;    
    }    
}
