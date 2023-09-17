<?php

class Request
{
    private array $input;

    public function __construct()
    {
        $this->input = array_merge($_GET, $_POST);
    }

    public function all(): array
    {
        return $this->input;
    }

    public function get($key, $default = null)
    {
        return $this->input[$key] ?? $default;
    }
}