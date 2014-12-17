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
    private $config = [];

    /**
     * @param array  $configSpace The config space where the values are stored. If omitted, $_ENV will be used
     * @param string $configFile  The configuration file that holds the overrides
     */
    public function __construct($configSpace = null, $configFile = '')
    {
        $this->configSpace = $configSpace;
        if (null == $this->configSpace) {
            $this->configSpace = $_ENV;
        }
        $this->configFile = $configFile;
        if (file_exists($this->configFile)) {
            $this->config = parse_ini_file($this->configFile);
        }
    }

    public function define($name, $value)
    {
        define($name, $this->get($name, $value));
    }

    public function get($name, $default = '', $required = false)
    {

        if (array_key_exists($name, $this->config)) {
            return $this->config[$name];
        }

        if (empty($this->configSpace[$name])) {
            if ($required) {
                throw new ConfigurationNotFoundException($name);
            }
            return $default;
        }
        return $this->configSpace[$name];
    }

    public function required($name)
    {
        return $this->get($name, '', true);
    }
}
