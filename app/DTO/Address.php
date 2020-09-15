<?php
namespace App\DTO;

use App\ZipMapping;

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
    private $country = 'Deutschland';

    /**
     * @param $data
     */
    public function createFromData($data)
    {
        $data = explode(',', $data);
        $this->street = $data[0];

        if (isset($data[1])) {
            $cityData = trim($data[1]);

            // Format: 61381 Friedrichsdorf
            // Matches everything from 1st whitespace
            preg_match('/(?<=\s).*/', $cityData, $cityMatches);

            // matches everything until 1st whitespace
            preg_match('/^\S*/', $cityData, $zipMatches);

            if (count($cityMatches) === 1) {
                $this->city = trim($cityMatches[0]);
            }

            if (count($zipMatches) === 1) {
                $this->zip = trim($zipMatches[0]);

                $zipMapping = ZipMapping::where('zip', '=', trim($this->zip))->first();

                if ($zipMapping === null) {
                    return;
                }

                $this->region = $zipMapping->state;
                $this->zip = $zipMapping->zip;
            }
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
