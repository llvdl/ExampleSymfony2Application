<?php

namespace Finalist\TweeterCoreBundle\Entity;

class Id {

    /** @var int */
    private $value;
    
    public function __construct($value) {
        $this->value = $this->convertToNumber($value);
    }
    
    /** @return int */
    public function getValue() {
        return $this->value;
    }
    
    /**
     * 
     * @param mixed $value
     * @return int
     * @throws DomainException
     */
    private function convertToNumber($value) {
        $number = intval($value);
        if($number <= 0) {
            throw new DomainException("Invalid id value");
        }
        return $number;
    }
}
