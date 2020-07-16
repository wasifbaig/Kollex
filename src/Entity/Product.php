<?php

namespace App\Entity;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Product
{
     /**
     * @var string
     * @SerializedName("PRODUCT_IDENTIFIER")
     */
    private $id;

     /**
      * @var string
     * @SerializedName("EAN_CODE_GTIN")
     */
    private $gtin;

    /**
     * @var string
     * @SerializedName("BRAND")
     */
    private $manufacturer;

    /**
     * @var string
     * @SerializedName("NAME")
     */
    private $name;

    /**
     * @var string 
     * @SerializedName("PACKAGE")
     */
    private $packaging;

    /**
     * @var string
     * @SerializedName("VESSEL")
     */
    private $baseProductPackaging;

    /**
     * @var string
     */
    private $baseProductUnit;

    /**
     * @var float
     * @SerializedName("LITERS_PER_BOTTLE")
     */
    private $baseProductAmount;

    /**
     * @var int
     * @SerializedName("BOTTLE_AMOUNT")
     */
    private $baseProductQuantity;

    public function getId(): ?string
    {
        return $this->id;
    }
    
    public function setId(?string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getGtin(): ?string
    {
        return $this->gtin;
    }

    public function setGtin(?string $gtin): self
    {
        $this->gtin = $gtin;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPackaging(): ?string
    {
        return $this->packaging;
    }

    public function setPackaging(string $packaging): self
    {
        $this->packaging = $packaging;

        return $this;
    }

    public function getBaseProductPackaging(): ?string
    {
        return $this->baseProductPackaging;
    }

    public function setBaseProductPackaging(string $baseProductPackaging): self
    {
        $this->baseProductPackaging = $baseProductPackaging;

        return $this;
    }

    public function getBaseProductUnit(): ?string
    {
        return $this->baseProductUnit;
    }

    public function setBaseProductUnit(string $baseProductUnit): self
    {
        $this->baseProductUnit = $baseProductUnit;

        return $this;
    }

    public function getBaseProductAmount(): ?float
    {
        return $this->baseProductAmount;
    }

    public function setBaseProductAmount($baseProductAmount): self
    {
        $baseProductAmount = str_replace(',', '.', $baseProductAmount);
        $this->baseProductAmount = floatval($baseProductAmount);

        return $this;
    }

    public function getBaseProductQuantity(): ?int
    {
        return $this->baseProductQuantity;
    }

    public function setBaseProductQuantity($baseProductQuantity): self
    {
        $this->baseProductQuantity = (int)$baseProductQuantity;

        return $this;
    }
}
