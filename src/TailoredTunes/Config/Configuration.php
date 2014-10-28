<?php
namespace TailoredTunes\Config;

class Configuration
{

    /**
     * @var string The configuration file that holds the overrides
     */
    private $configFile;
    /**
     * @var null
     */
    private $configSpace;

    /**
     * @param array $configSpace The config space where the values are stored. If omitted, $_ENV will be used
     * @param string $configFile The configuration file that holds the overrides
     */
    public function __construct($configSpace = null, $configFile = '')
    {
        $this->configSpace = $configSpace;
        if (null == $this->configSpace) {
            $this->configSpace = $_ENV;
        }
        $this->configFile = $configFile;
    }

    public function define($name, $value)
    {
        define($name, $this->get($name, $value));
    }

    public function get($name, $default = '')
    {
        if (file_exists($this->configFile)) {
            $config = parse_ini_file($this->configFile);
            if (array_key_exists($name, $config)) {
                return $config[$name];
            }
        }
        if (empty($this->configSpace[$name])) {
            return $default;
        }
        return $this->configSpace[$name];
    }
}
