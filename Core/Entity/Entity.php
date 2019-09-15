<?php
/**
 * Created by PhpStorm.
 * User: HZM
 * Date: 14/09/2019
 * Time: 15:55
 */

namespace Core\Entity;


class Entity {

    public function __construct(array $donnees = []) {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            //matching setter attribute
            $method = 'set'.ucfirst(str_replace('_', '', $key));

            // setter existe
            if (method_exists($this, $method)) {
                // call setter.
                $this->$method($value);
            }
        }
    }
}

