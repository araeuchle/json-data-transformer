<?php
namespace App\DTO;

class Address
{
    /**
     * @var string
     */
    private $street = '';

    /**
     * @var string
     */
    private $zip = '';

    /**
     * @var string
     */
    private $city = '';

    /**
     * @var string
     */
    private $region = '';

    /**
     * @var string
     */
    private $country = '';

    /**
     * @param $data
     */
    public function createFromData($data)
    {
        $data = explode(',', $data);

        if (isset($data[0])) {
            $this->street = trim($data[0]);
        }

        if (isset($data[1])) {
            $this->zip = trim($data[1]);
        }

        if (isset($data[2])) {
            $this->city = trim($data[2]);
        }

        if (isset($data[3])) {
            $this->region = trim($data[3]);
        }

        if (isset($data[4])) {
            $this->country = trim($data[4]);
        }
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip(string $zip): void
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }


}
