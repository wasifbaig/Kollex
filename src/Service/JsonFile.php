<?php

namespace App\Service;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Description of JsonFile
 *
 * @author wasif baig
 */
class JsonFile implements ProductInterface
{
    /**
     * @var string 
     */
    public $file;
    
    /**
     * trait
     */
    use DataProvider;
    
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
        
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

        $serializer = new Serializer(
            [ new ArrayDenormalizer(), new ObjectNormalizer($classMetadataFactory, $metadataAwareNameConverter)],
            ['json' => new JsonEncoder()]
        );
        
        $fileArray = json_decode(file_get_contents($this->file),true);
        
        if(empty($fileArray))
            throw new Exception('File is empty.');
        
        $data = json_encode($fileArray['data'] ?? $fileArray[array_key_first($fileArray)]);
            
        $products = $serializer->deserialize($data, 'App\Entity\Product[]', 'json');
        return $products;    
               
    }
}
