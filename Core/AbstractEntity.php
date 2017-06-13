<?php

namespace Core;

abstract class AbstractEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * Metodo que converte array em entidade utilizando o encapsulamento
     * @param array $data
     * @return $this
     */
    public function hydrate(array $data)
    {
        foreach ($data as $property => $value) {
            $setterName = 'set' . ucfirst(strtolower($property));
            if (is_callable(array($this, $setterName))) {
                $this->{$setterName}($value);
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function isNew()
    {
        return !$this->id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}