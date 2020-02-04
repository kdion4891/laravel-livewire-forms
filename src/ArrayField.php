<?php

namespace Kdion4891\LaravelLivewireForms;

class ArrayField extends BaseField
{
    protected $column_width;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function make($name)
    {
        return new static($name);
    }

    public function columnWidth($width)
    {
        $this->column_width = $width;
        return $this;
    }
}
