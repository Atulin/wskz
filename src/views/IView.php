<?php

namespace Wskz\Views;

interface IView
{
    public function render(array $data): void;
}
