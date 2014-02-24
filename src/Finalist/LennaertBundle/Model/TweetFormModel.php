<?php

namespace Finalist\LennaertBundle\Model;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

class TweetFormModel {
    
    private $tweeterName;
    private $text;
    
    public function getTweeterName() {
        return $this->tweeterName;
    }
    
    public function setTweeterName($tweeterName) {
        $this->tweeterName = $tweeterName;
    }
    
    public function getText() {
        return $this->text;
    }
    
    public function setText($text) {
        $this->text = $text;
    }
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('tweeterName', new NotBlank());
        $metadata->addPropertyConstraint('text', new NotBlank());
    }
}
