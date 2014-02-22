<?php

namespace Finalist\TweeterCoreBundle\Repository\Type;

use \Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Finalist\TweeterCoreBundle\Entity\Id;

class IdType extends Type {
    
    const ID_TYPE = 'Finalist_TweeterCoreBundle_Repository_Type_IdType';
    
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform) {
        $declaration = $platform->getBigIntTypeDeclarationSQL($fieldDeclaration);
        return $declaration;
    }

    public function getName() {
        return self::ID_TYPE;
    }
    
    public function convertToPHPValue($value, AbstractPlatform $platform) {
        print 'convertToPHPValue'; die;
        $id = new Id($value);
        return $id;
    }
    
    public function convertToDatabaseValue($value, AbstractPlatform $platform) {
        print 'convertToDataBaseValue'; die;
        return $value->getValue();
    }
    
    public function getMappedDatabaseTypes(AbstractPlatform $platform) {
        parent::getMappedDatabaseTypes($platform);
    }

}
