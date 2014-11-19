<?php

use Symfony\CS\Config\Config;

$config = Config::create()
    // use default level and extra fixers:
    ->fixers(array('-psr0', '-concat_without_spaces', 'concat_with_spaces', 'strict', 'strict_param'))
    ->setUsingCache(true)
    ->setUsingLinter(false);

$config->getFinder()
    ->in(__DIR__);

return $config;
