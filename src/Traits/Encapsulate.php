<?php

namespace Location\Traits;

trait Encapsulate{
        public function __call($name,$args)
    {
        if(method_exists($this,$name))
            {
                return    $this->$name(...$args);
            }
        throw new \InvalidArgumentException("Method $name Not Exists");
            
    }
}