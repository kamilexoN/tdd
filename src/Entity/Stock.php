<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 4)]
    private $symbol;

    #[ORM\Column(type: 'string', length: 20)]
    private $shortName;

    #[ORM\Column(type: 'string', length: 3)]
    private $currency;

    #[ORM\Column(type: 'string', length: 10)]
    private $exchangeName;

    #[ORM\Column(type: 'string', length: 2)]
    private $region;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $price;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $previousClose;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $priceChange;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): self
    {
        $this->shortName = $shortName;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getExchangeName(): ?string
    {
        return $this->exchangeName;
    }

    public function setExchangeName(string $exchangeName): self
    {
        $this->exchangeName = $exchangeName;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPreviousClose(): ?string
    {
        return $this->previousClose;
    }

    public function setPreviousClose(string $previousClose): self
    {
        $this->previousClose = $previousClose;

        return $this;
    }

    public function getPriceChange(): ?string
    {
        return $this->priceChange;
    }

    public function setPriceChange(string $priceChange): self
    {
        $this->priceChange = $priceChange;

        return $this;
    }
}
