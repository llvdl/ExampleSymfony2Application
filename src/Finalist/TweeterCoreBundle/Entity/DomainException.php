<?php

namespace Finalist\TweeterCoreBundle\Entity;

class DomainException extends \Exception {
    
    public function __construct($message = null, $code = 0, $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
