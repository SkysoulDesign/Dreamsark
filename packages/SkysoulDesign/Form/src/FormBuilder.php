<?php

namespace SkysoulDesign\Form;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Session\Store as Session;
use Illuminate\Support\ViewErrorBag;

abstract class FormBuilder
{

    /**
     * @var Collection
     */
    public $form;

    /**
     * @var Collection
     */
    public $bind;

    /**
     * FormBuilder constructor.
     * @param Collection $collection
     * @param IlluminateErrorStore $error
     */
    public function __construct(Collection $collection, Session $session)
    {
        $this->errors = $session;
        $this->collection = $collection;
        $this->form = $this->collection->make();
    }

    public function open($method = null, $action = null)
    {
        return $this->generateFormTag($method, $action);
    }

    /**
     * Generate Form Token Input
     *
     * @param string $name
     * @return mixed
     */
    public function token($name = '_token')
    {
        return $this->generateHiddenInput($name, csrf_token());
    }

    /**
     * Generate Form Tag
     *
     * @param null $method
     * @param null $action
     * @return
     */
    public function generateFormTag($method = null, $action = null)
    {
        return $this->push()
            ->element('form')
            ->method($method)
            ->action($action)
            ->class($this->getFormClass());
    }

    /**
     * Bind Model to the form
     *
     * @param Model|Array $model
     * @return $this
     */
    public function bind($model = [])
    {
        /**
         * Cast eloquent model to array
         */
        $data = ($model instanceof Model) ? $model->attributesToArray() : $model;

        $this->bind = $this->collection->make($data);

        return $this;

    }

    /**
     * Bind Model to Element
     *
     * @param Collection $item
     * @return Collection
     */
    protected function binder(Collection $item)
    {

        if ($this->bind instanceof Collection && $value = $this->bind->get($item->get('name'))) {
            return $item->put('value', $value);
        }

        return $item;

    }

    /**
     * Close Form and Bootstrap all the fields
     *
     * @return string
     */
    public function close()
    {
        return $this->push()->token()->closeTag('form')->generateForm();
    }

    /**
     * CLose tagging
     *
     * @param $tag
     * @return $this
     */
    public function closeTag($tag)
    {
        $this->form->push('</' . $tag . '>');
        return $this;
    }

    /**
     * Add Method to form
     *
     * @param $method
     * @return $this
     */
    public function method($method = null)
    {
        return $this->set(compact('method'), 'POST');
    }

    /**
     * Add Method to form
     *
     * @param $action
     * @return $this
     */
    public function action($action = null)
    {
        return $this->set(compact('action'), '/');
    }

    /**
     * Add Method to form
     *
     * @param null $class
     * @return $this
     */
    public function _class($class)
    {
        return $this->set(compact('class'));
    }

    /**
     * Submit Button
     *
     * @param $text
     */
    public function submit($text)
    {
        return $this->generateButton('submit', $text);
    }

    /**
     * Cancel Button
     *
     * @param $text
     */
    public function cancel($text)
    {
        return $this->generateButton('cancel', $text);
    }

    /**
     * Create Button
     *
     * @param $type
     * @param $content
     * @return
     */
    public function generateButton($type, $content)
    {
        return $this->push()
            ->element('button')
            ->class($this->getButtonClass())
            ->type($type)
            ->content($this->prettify($content));
    }

    /**
     * Overrides WrapperClass Class to wrapperClass
     *
     * @param $wrapperClass
     * @return $this
     */
    public function wrapperClass($wrapperClass)
    {
        return $this->set(compact('wrapperClass'));
    }

    /**
     * Append Class to wrapperClass
     *
     * @param $appendWrapperClass
     * @return $this
     */
    public function appendWrapperClass($appendWrapperClass)
    {
        return $this->set(compact('appendWrapperClass'));
    }

    /**
     * Append Anything to the Tag $name="$value"
     *
     * @param $name
     * @param $value
     * @return FormBuilder
     */
    public function append($name, $value = null)
    {
        return $this->set([$name => $value]);
    }

    /**
     * Append Class to Tag
     *
     * @param string $class
     * @return $this
     */
    public function appendClass($class)
    {
        return $this->set(['appendClass' => $class]);
    }

    /**
     * Generate Parameters
     *
     * @param array $data
     * @param $default
     * @return $this
     * @internal param $key
     * @internal param $value
     */
    public function set(array $data, $default = null)
    {
        $this->form->last()->put(key($data), reset($data) ?: $default);
        return $this;
    }

    /**
     * Compile the final form
     *
     * @return string
     */
    protected function generateForm()
    {
        $form = $this->generateTag($this->form->pull(0));

        return $this->form->map(function ($item) {

            /**
             * Generate tag if $item is not empty
             */
            if ($item instanceof Collection && !$item->isEmpty()) {

                /**
                 * Detect Errors
                 */
                $error = $this->appendErrors($item);

                return $this->wrap($item, $error);

            }

            /**
             * Return '' if item is empty
             */
            if ($item instanceof Collection && $item->isEmpty()) return '';

            /**
             * Return item if it`s just an string
             */
            return $item;

        })->prepend($form)->implode('');

    }

    /**
     * Wrap Element
     *
     * @param $content
     * @param null $class
     * @param bool $append
     * @return $this
     */
    protected function wrap(Collection $item, $error = null)
    {


        /**
         * Override WrapperClass if set
         */
        $wrapperClass = $this->generateWrapperClass($item);

        /**
         * Content
         */
        $content = $this->generateTag($this->binder($item));

        /**
         * Append to class true or false
         */
        $append = $wrapperClass->get('mode', false);

        /**
         * Class
         */
        $class = $wrapperClass->get('class');

        /**
         * Framework Default Class
         */
        $wrapperClass = $this->getWrapperClass();

        /**
         * Framework Default Error Class
         */
        if ($error) $error = ' ' . $this->getErrorClass();


        /**
         * Appended Class
         */
        if ($append) {
            $class = $wrapperClass . ' ' . $class . $error;
        }

        /**
         * Default Class
         */
        if ($class === null && $append === false) {
            $class = $wrapperClass . $error;
        }

        return $this->makeWrapper($class, $content);
    }

    public function appendErrors(Collection $item)
    {

        /** @var ViewErrorBag $errors */
        if ($this->errors->has('errors') && $message = $this->errors->get('errors')->first($item->get('name'))) {
            $item->put('error', $message);
            return $message;
        }

        return;

    }

    /**
     * getWrapperClass
     *
     * @param Collection $item
     * @return Collection
     */
    protected function generateWrapperClass(Collection $item)
    {
        $mode = false;
        $class = null;

        if ($wrapperClass = $item->pull('wrapperClass', null)) {
            $class = $wrapperClass;
            $mode = false;
        }

        if ($appendWrapperClass = $item->pull('appendWrapperClass', null)) {
            $class = $appendWrapperClass;
            $mode = true;
        }

        return $this->collection->make(compact('class', 'mode'));
    }

    /**
     * Create Text Input
     *
     * @param $name
     * @param null $value
     * @param null $label
     * @return mixed
     */
    public function text($name, $value = null, $label = null)
    {
        return $this->generateField('text', $name, $value, $label ?: $name);
    }

    /**
     * Create Email Input
     *
     * @param $name
     * @param null $value
     * @param null $label
     * @return mixed
     */
    public function email($name, $value = null, $label = null)
    {
        return $this->generateField('email', $name, $value, $label ?: $name);
    }

    /**
     * Create Password Field
     *
     * @param $name
     * @param null $value
     * @param null $label
     * @return $this
     */
    public function password($name, $value = null, $label = null)
    {
        return $this->generateField('password', $name, $value, $label ?: $name);
    }

    /**
     * Create Select Field
     *
     * @param $name
     * @param array $collection
     * @param null $label
     * @return FormBuilder
     */
    public function select($name, array $collection, $label = null)
    {
        return $this->generateSelect('select', $name, $collection, $label ?: $name);
    }

    /**
     * Generate Field
     *
     * @param $type
     * @param $name
     * @param null $value
     * @param null $label
     * @return $this
     */
    public function generateField($type, $name, $value = null, $label = null)
    {
        return $this->push($value ? compact('value') : [])
            ->element('input')
            ->name($name)
            ->type($type)
            ->label($label)
            ->placeholder($this->prettify($name));

    }

    /**
     * Generate Hidden Inputs
     *
     * @param $name
     * @param null $value
     * @return $this
     */
    public function generateHiddenInput($name, $value = null)
    {
        $this->form->push('<input type="hidden" name="' . $name . '" value="' . $value . '">');
        return $this;
    }

    /**
     * Create Hidden Input
     *
     * @param array $attributes
     * @return string
     */
    public function makeHidden($attributes = [])
    {
        return '<input ' . $this->map($attributes) . '>';
    }

    /**
     * Generate Select
     *
     * @param $type
     * @param $name
     * @param array $collection
     * @param null $label
     * @return $this
     * @internal param null $value
     */
    public function generateSelect($type, $name, array $collection, $label = null)
    {
        return $this->push($collection ? compact('collection') : [])
            ->element('select')
            ->class($this->getSelectClass())
            ->name($name)
            ->type($type)
            ->label($label)
            ->placeholder($this->prettify($name));

    }

    /**
     * Format End User Display Texts
     *
     * @param $string
     * @return string
     */
    protected function prettify($string)
    {
        return title_case(str_replace('_', ' ', $string));
    }

    /**
     * Remove Label
     *
     * @return $this
     */
    public function withoutLabel()
    {
        $this->form->last()->forget('label');
        return $this;
    }

    /**
     * Generate Form Tag
     *
     * @param $attributes
     * @param Collection $attributes
     * @return string
     */
    protected function generateTag(Collection $attributes)
    {

        /**
         * Process Append Class
         */
        if ($appendClass = $attributes->pull('appendClass', null)) {
            $attributes->put('class', $attributes->get('class') . ' ' . $appendClass);
        }

        /**
         * Process Label
         */
        if ($label = $attributes->pull('label', null)) {
            $label = $this->makeLabel($label);
        };

        /**
         * Process Errors
         */
        $error = $attributes->pull('error', null);

        $params = $this->collection->make();

        /**
         * Remove Element from attributes list
         * Define Attribute to be send for each kind of tag
         */
        switch ($tag = $attributes->pull('element')) {
            case 'hidden':
                $params->push([$attributes]);
                break;
            case 'select':
                $params->push([$attributes->forget('type'), $attributes->pull('collection'), $attributes->pull('placeholder'), $label]);
                break;
            case 'button':
                $params->push([$attributes, $attributes->pull('content')]);
                break;
            default:
                $params->push([$attributes, $label, $error]);
                break;
        }

        /**
         * Call function with params
         */
        return call_user_func_array(array($this, 'make' . title_case($tag)), $params->collapse()->toArray());

    }

    /**
     * Generate HTML attributes
     *
     * @param Collection|array $attributes
     * @return string
     */
    public function map($attributes)
    {
        return $this->collection->make($attributes)->map(function ($value, $key) {

            /**
             * If Value is set return $key="$value"
             * Otherwise return $key
             */
            return $value ? $key . '="' . $value . '"' : $key;

        })->implode(' ');
    }

    /**
     * Generate HTML attributes
     *
     * @param Collection|array $attributes
     * @param bool $prettify
     * @return string
     */
    public function options($attributes, $prettify = false)
    {
        return $this->collection->make($attributes)->map(function ($value, $key) use ($prettify) {

            return '<option value="' . $key . '">' . $prettify ? $this->prettify($value) : $value . '</option>';

        })->implode('');
    }


    /**
     * Create a new entry on the Form Array
     *
     * @param array $data
     * @return $this
     */
    public function push(array $data = [])
    {
        $this->form->push($this->collection->make($data));
        return $this;
    }


    /**
     * Handle Magic Methods
     *
     * @param $name
     * @param string $value
     * @return mixed
     */
    public function __call($name, $value)
    {

        /**
         * Hack to enable calling ->class
         */
        if ($name == 'class') {
            return $this->_class(array_shift($value));
        }


        return $this->append($name, array_shift($value));

    }

}