<?php

namespace Location\Traits;

/**
 * Trait Encapsulate
 * @package Location\Traits
 */
trait Encapsulate{
    /**
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call($name,$args)
    {
        if(method_exists($this,$name))
            {
                return    $this->$name(...$args);
            }
        throw new \InvalidArgumentException("Method $name Not Exists");
            
    }
}