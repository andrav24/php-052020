<?php

namespace Core;

class Router
{
    private array $route = [];

    public function dispatch(string $routeURI): void
    {
        $parts = explode('/', $routeURI);
        $this->route['controller'] = $parts[1] ?? '';
        $this->route['action'] = $parts[2] ?? '';
    }

    /**
     * @return array
     */
    public function getRoute(): array
    {
        return $this->route;
    }

    private function check(string $key)
    {
        return preg_match('/[a-zA-Z0-9]+/', $key);
    }
}
