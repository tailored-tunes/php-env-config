<?php
namespace TailoredTunes\Config;

class ConfigurationNotFoundException extends \Exception
{

    public function __construct($keyName)
    {
        $this->message = sprintf("%s not found in configuration", $keyName);
    }
}
