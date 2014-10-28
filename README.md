php-env-config
========================

A small config library for php that enables you to read environment variables, but override them with
a config file too.

The reason behind this library is that we don't believe in stored configuration. Each environment is different,
and code deployed to any machine might have completely different configurations. Therefore there's no sense in
hardcoding anything. Nevertheless, during development it is painful to deal with environmental variables, so
support for VCS ignored but easy to maintain file configuration was necessary.

# Installation

Install via composer. Installation help and versions at [Packagist](https://packagist.org/packages/tailored-tunes/php-env-config)

# Usage

```php
use TailoredTunes/Config;

$config = new Configuration($_ENV, 'developer.ini');

$config->define('SOME_CONSTANT','defaultValue');

$configuredValue = $config->get('configName','defaultValue');

```

If `developer.ini` is present, the values found there will be taken. It is a good practice to add
`developer.ini` to the ignore list of your VCS, so all team members could have their own configurations
regardless of the main configuration.
