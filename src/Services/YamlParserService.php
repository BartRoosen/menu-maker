<?php


namespace Services;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;


class YamlParserService
{
    const PATH = 'yaml';

    public function parseFile($file)
    {
        $filePath = sprintf('%s/%s', self::PATH, $file);

        try {
            $value = Yaml::parseFile($filePath);
        } catch (ParseException $exception) {
            printf('Unable to parse the YAML string: %s', $exception->getMessage());
        }

        return $value;
    }

    public function contentFileExists($file)
    {
        if (file_exists(sprintf('yaml/%s', $file))) {
            return true;
        }

        return false;
    }
}