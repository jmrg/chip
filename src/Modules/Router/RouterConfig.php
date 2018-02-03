<?php
namespace Chip\Modules\Router;

/**
 * Class RouterConfig
 * @package Chip\Modules\Router
 */
class RouterConfig
{
    /**
     * Keep an array of files with routes.
     *
     * @var array
     */
    private $routerFiles = [];

    /**
     * Namespace to use.
     *
     * @var string
     */
    private $baseNamespace;

    /**
     * Attach one o more file for register routes.
     *
     * @param string|array $file
     * @return $this
     * @throws \Exception
     */
    public function attachRouterFiles($file)
    {
        if (preg_grep ('/^.*\.(php)$/i', $file) != $file) {
            throw new \Exception('It only supports files with extension php.');
        }

        is_array($file)
            ? $this->routerFiles = array_merge($this->routerFiles, $file)
            : $this->routerFiles[] = $file;

        $this->routerFiles = array_filter(array_unique($this->routerFiles));

        return $this;
    }

    /**
     * Return an array with the routes files attached.
     *
     * @return array
     */
    public function getRouterFiles()
    {
        return $this->routerFiles;
    }

    /**
     * Set a namespace to be using.
     *
     * @param string $namespace
     * @return $this
     */
    public function setBaseNamespace($namespace = '')
    {
        $this->baseNamespace = $namespace;

        return $this;
    }

    /**
     * Return base namespace to work.
     *
     * @return string
     */
    public function getBaseNamespace()
    {
        return $this->baseNamespace;
    }
}
