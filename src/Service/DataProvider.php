<?php
namespace App\Service;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Description of DataProvider
 *
 * @author wasif baig
 */
trait DataProvider {
    
    /**
     * @param array $product
     * @return json 
     */
    public function toJson($products)
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $json = $serializer->serialize($products, 'json');
        return $json;
    }
    
    /**
     * @param array $product
     * @return xml 
     */
    public function toXml($products)
    {
        $serializer = new Serializer([new ObjectNormalizer()], [new XmlEncoder()]);
        $xml = $serializer->serialize($products, 'xml');
        return $xml;
    }
    
}
