<?php
namespace Wskz\Lib;

use InvalidArgumentException;
use http\Exception\RuntimeException;


class Dotenv
{
    private string $path;

    /**
     * Dotenv constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new InvalidArgumentException("{$path} does not exist");
        }
        $this->path = $path;
    }

    public function load(): void
    {
        if (!is_readable($this->path)) {
            throw new RuntimeException("{$this->path} is not readable");
        }

        $handle = fopen($this->path, 'rb');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                if (empty(trim($line))) {
                    continue;
                }
                $split = explode( '=', trim($line));
                $_ENV[$split[0]] = $split[1];
            }
            fclose($handle);
        } else {
            throw new RuntimeException("Cannot open {$this->path}");
        }
    }

}
