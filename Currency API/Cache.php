<?php


class Cache {

    private $data;
    private $cacheTime = 300;

    public function __construct()
    {
        if (file_exists(__DIR__.'/currencyRates.json')) {
            $this->data = json_decode(file_get_contents(__DIR__.'/currencyRates.json'));
        }
    }

    public function get()
    {
        if (null === $this->data) {
            return false;
        }
        
        if ($this->data->timeStamp + $this->cacheTime <= time()) {
            return false;
        }

        return $this->data;
    }

    public function set(object $data)
    {
        $data->timeStamp = time();
        file_put_contents(__DIR__.'/currencyRates.json', json_encode($data));
    }

}