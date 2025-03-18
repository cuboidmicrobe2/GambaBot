<?php

namespace structure;

use Exception;
use SensitiveParameter;

/**
 * @author edwin030426@gmail.com
 */
class Struct { // wip

    private array $properties;

    /**
     * Create readonly class from array, e.g:
     * 
     * $foo = new Struct([
     *     'value1' => 1,
     *     'value2' => 'Hello World'
     * ]);
     * 
     * @param array $vars   key is property name, and value is property value
     */
    function __construct(array $vars) {
        foreach($vars as $varName => $val) {
            if(!is_string($varName)) throw new Exception('variable name must be of type string');

            $this->properties[$varName] = $val;
        }
    }

    public function toArray() : array {
        return $this->properties;
    }

    public function __invoke() : mixed {
        return (array_key_exists('__invoke', $this->properties) AND is_callable($this->properties['__invoke'])) ? call_user_func($this->properties['__invoke']) : null;
    }

    public function __get($name) : mixed {
        if(!array_key_exists($name, $this->properties)) throw new Exception('Cannot access value of unset property: "' . $name . '"');

        if(is_callable($this->properties[$name])) throw new Exception('Cannot "get" on property type callable: ' . $name . '()');

        return $this->properties[$name];
    }

    public function __call(string $name, mixed $args) : mixed {

        if(!array_key_exists($name, $this->properties)) throw new Exception('Cannot access value of unset property: "' . $name . '"');

        if(!is_callable($this->properties[$name])) throw new Exception('Cannot call undefined property');

        return call_user_func($this->properties[$name], $args);
    }

    public function __set($name, #[SensitiveParameter] $value) : void {

        throw new Exception('Cannot change value of property in struct');
    }

    public function __toString() : string {
        return (array_key_exists('__toString', $this->properties)) ? $this->properties['__toString'] : self::class;
    }

    public function __debugInfo() : array {
        return $this->properties;
    }
}

/**
 * Notes!
 * 
 * * Function arguments must be stored in an array
 * 
 * * No args on invoke
 * 
 */