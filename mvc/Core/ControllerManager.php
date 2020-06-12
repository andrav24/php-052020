<?php


namespace Core;


class ControllerManager
{
    const DEFAULT_CONTROLLER = 'Index';
    const DEFAULT_ACTION = 'index';

    private string $controllerName = '';
    private string $actionName = '';
}