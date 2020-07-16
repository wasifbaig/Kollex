<?php
namespace App\Service;

use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Description of ProductFactory
 *
 * @author wasif baig
 */
class ProductFactory{
    
    /**
     * 
     * @param string $file
     * @return object
     */
    public static function create(string $file='')
    {
        if(empty($file))
            throw new Exception('File is missing.');   
        
         $fileExtension = pathinfo($file,PATHINFO_EXTENSION );
        
         switch ($fileExtension) {
            case 'csv':
                $product = new CsvFile($file);
                break;
            case 'json':
                $product = new JsonFile($file);
                break;
            default :
                throw new Exception('File extention is not supported.');
        }
        return $product; 
    }    
}
