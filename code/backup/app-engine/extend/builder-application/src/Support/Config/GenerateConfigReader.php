<?php

namespace Builder\Application\Support\Config;

class GenerateConfigReader
{
    public static function read(string $value): GeneratorPath
    {
        return new GeneratorPath(config("builder-application.paths.generator.$value"));
    }
}
