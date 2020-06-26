<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Calendar;

/**
 * Description of EventValidator
 *
 * @author angec
 */
class EventValidator {

    private $data;
    protected $errors = [];

    public function __construct(array $data = []) {
        $this->data = $data;
    }

    /**
     * 
     * @param array $data
     */
    public function validates(array $data) {
        $this->errors = [];
        $this->data = $data;
    }

    public function validate(string $field, string $method, ...$parameters): bool {
        if (!isset($this->data[$field])) {
            $this->errors[$field] = "le champ $field n'est pas rempli";
            return false;
        } else {
            return call_user_func([$this, $method], $field, ...$parameters);
        }
    }

    public function validatemin(array $data) {
        $this->validates($data);
        $this->validate('name', 'minLength', 3);
        $this->validate('date', 'validedate');
        $this->validate('start', 'beforeTime', 'end');
        return $this->errors;
    }

    public function minLength(string $field, int $length) {
        if (\mb_strlen($this->data[$field]) < $length) {
            $this->errors[$field] = "Le champ doit avoir plus de $length caractères";
            return false;
        }
        return true;
    }

    public function validedate(string $field): bool {
        if (\DateTime::createFromFormat('Y-m-d', $this->data[$field]) === false) {
            $this->errors[$field] = "La date ne semble pas valide";
            return false;
        }
        return true;
    }

    public function validetime(string $field): bool {
        if (\DateTime::createFromFormat('H:i', $this->data[$field]) === false) {
            $this->errors[$field] = "La temps ne semble pas valide";
            return false;
        }
        return true;
    }

    public function beforeTime(string $startfield, string $endfield) {
        if ($this->validetime($startfield) && $this->validetime($endfield)) {
            $start = \DateTime::createFromFormat('H:i', $this->data[$startfield]);
            $end = \DateTime::createFromFormat('H:i', $this->data[$endfield]);
            if ($start->getTimestamp() > $end->getTimestamp()) {
                $this->errors[$startfield] = "Le temps de départ doit être inférieur au temps de fin";
                return false;
            }
            return true;
        }
        return false;
    }

}
