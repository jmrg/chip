<?php
namespace Chip\Modules\Router;

use Klein\Klein;

/**
 * Class Router
 *
 * This providers methods to manipulate requests and redirect
 * it to file and work like a controller.
 *
 * @package Chip\Modules\Router
 * @see https://github.com/klein/klein.php#example
 */
class Router
{
    /**
     * Keep configuration for this instance.
     *
     * @var RouterConfig
     */
    private $config;

    /**
     * Keep base namespace to work.
     *
     * @var string
     */
    private $baseNamespace;

    /**
     * Keep a instance for the router.
     *
     * @var Klein
     */
    private $library;

    /**
     * @param RouterConfig $config
     * @return static
     */
    public static function up(RouterConfig $config)
    {
        $Router = new static($config);

        static::setRoutesFiles($Router);

        return $Router;
    }

    /**
     * Router constructor.
     * @param RouterConfig $config
     */
    private function __construct(RouterConfig $config)
    {
        $this->config = $config;
        $this->library = new Klein();
    }

    /**
     * Return the configuration for this instance.
     *
     * @return RouterConfig
     */
    private function getConfig()
    {
        return $this->config;
    }

    /**
     * Set routes files attached in the configuration.
     *
     * @param Router $router
     * @return $this
     */
    private static function setRoutesFiles(Router $router)
    {
        foreach ($router->getConfig()->getRouterFiles() as $file) {
            require_once "$file";
        }

        return $router;
    }

    /**
     * Register a route with the application with
     * the GET verb.
     *
     * @param string $uri
     * @param callable|array|string $actions
     */
    public function get($uri, $actions)
    {
        $this->addRoute('GET', $uri, $actions);
    }

    /**
     * Register a route with the application with
     * the POST verb.
     *
     * @param string $uri
     * @param callable|array|string $actions
     */
    public function post($uri, $actions)
    {
        $this->addRoute('POST', $uri, $actions);
    }

    /**
     * Register a route with the application with
     * the PUT verb.
     *
     * @param string $uri
     * @param callable|array|string $actions
     */
    public function put($uri, $actions)
    {
        $this->addRoute('PUT', $uri, $actions);
    }

    /**
     * Register a route with the application with
     * the PATH verb.
     *
     * @param string $uri
     * @param callable|array|string $actions
     */
    public function path($uri, $actions)
    {
        $this->addRoute('PATH', $uri, $actions);
    }

    /**
     * Register a route with the application with
     * the DELETE verb.
     *
     * @param string $uri
     * @param callable|array|string $actions
     */
    public function delete($uri, $actions)
    {
        $this->addRoute('DELETE', $uri, $actions);
    }

    /**
     * Register a route with the application with
     * the OPTIONS verb.
     *
     * @param string $uri
     * @param callable|array|string $actions
     */
    public function options($uri, $actions)
    {
        $this->addRoute('OPTIONS', $uri, $actions);
    }

    /**
     * Register a route with the application with
     * the specified verbs.
     *
     * @param array $verbs
     * @param string $uri
     * @param callable|array|string $actions
     */
    public function match($verbs = [], $uri, $actions)
    {
        array_map(function($verb) use ($uri, $actions) {
            $this->addRoute($verb, $uri, $actions);
        }, $verbs);
    }

    /**
     * Return the instance of the router library.
     *
     * @return Klein
     */
    private function getLibrary()
    {
        return $this->library;
    }

    /**
     * Return the namespace partial.
     *
     * @return string
     */
    private function getBaseNamespace()
    {
        return $this->baseNamespace;
    }

    /**
     * Register a route with the application with
     * a specific verb.
     *
     * @param string $method
     * @param string $uri
     * @param callable|array|string $actions
     */
    private function addRoute($method, $uri, $actions)
    {
        $this->getLibrary()->respond($method, $uri, static::buildCallbackAsArray($actions));
    }

    /**
     * It build a callable as array an returned it.
     *
     * @param string $class
     * @return callable
     */
    private function buildCallbackAsArray($class)
    {
        if (is_string($class)) {
            $parts = explode('@', trim($class));

            $class = $this->getConfig()->getBaseNamespace() . "\\{$parts[0]}";

            $class = [new $class, $parts[1]];
        }

        return $class;
    }

    /**
     * Dispatch the routes in the application.
     */
    public function dispatch()
    {
        $this->getLibrary()->dispatch();
    }
}
