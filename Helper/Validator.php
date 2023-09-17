<?php

class Validator
{
    private $data;
    private $rules;
    private $errors = [];

    public function __construct($data, $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate(): array
    {
        foreach ($this->rules as $field => $rulesImplode) {
            $rules = explode('|', $rulesImplode);
            foreach ($rules as $rule) {
                $params = explode(':', $rule);
                $ruleName = $params[0];
                $paramValues = isset($params[1]) ? explode(',', $params[1]) : [];

                if (!$this->$ruleName($field, $paramValues)) {
                    $this->errors[$field][] = "El campo $field no cumple con la regla $ruleName";
                }
            }
        }

        return $this->errors;
    }

    public function passes(): bool
    {
        return empty($this->errors);
    }

    public function fails(): bool
    {
        return !$this->passes();
    }

    public function errors(): array
    {
        return $this->errors;
    }

    private function required($field, $params): bool
    {
        return isset($this->data[$field]) && !empty($this->data[$field]);
    }

    private function email($field, $params)
    {
        return filter_var($this->data[$field], FILTER_VALIDATE_EMAIL);
    }

    private function numeric($field, $params): bool
    {
        return is_numeric($this->data[$field]);
    }

    private function min($field, $params): bool
    {
        return strlen($this->data[$field]) >= $params[0];
    }

    private function max($field, $params): bool
    {
        return strlen($this->data[$field]) <= $params[0];
    }

    protected function date($field): bool
    {
        $date = $this->data[$field];

        $format = 'Y-m-d';

        $parsedDate = date_parse_from_format($format, $date);

        if ($parsedDate['error_count'] === 0 && checkdate($parsedDate['month'], $parsedDate['day'], $parsedDate['year'])) {
            // La fecha es válida
            return true;
        }

        return false;
    }
}