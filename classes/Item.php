<?php

class Item
{
    public $name;

    protected $code = 1324;

    public function getListingDescription()
    {
        return "Item: " . $this->name;
    }
}
