<?php

namespace Core;

class Controller
{
    public View $view;

    protected bool $_render = true;

    /**
     * @return bool
     */
    public function needRender(): bool
    {
        return $this->_render;
    }
}