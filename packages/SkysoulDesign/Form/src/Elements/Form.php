<?php

namespace SkysoulDesign\Form\Elements;

use Illuminate\Support\Collection;
use SkysoulDesign\Form\Elements;

class Form extends Elements
{

    /**
     * String
     */
    public $tag;

    /**
     * Form constructor.
     *
     * @param Collection $data
     */
    public function __construct(Collection $data)
    {
        $this->prepare($data);
    }

    /**
     * Prepare Field
     *
     * @param $data
     */
    public function prepare($data)
    {
        $this->tag = '<form class="' . $data->get('class') . '" method="' . $data->get('method') . '" action="' . $data->get('action') . '">    ';
    }

}