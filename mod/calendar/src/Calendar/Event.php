<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Calendar;

/**
 * Description of Event
 *
 * @author angec
 */
class Event {

    private $id;
    private $name;
    private $description;
    private $start;
    private $end;
    private $idAdmin;
    private $idClientTemp;
    private $idClient;
    private $idSkipper;
    private $idBoat;
    private $prix;
    private $option;

    public function getIdAdmin() {
        return $this->idAdmin;
    }

    public function getIdClientTemp() {
        return $this->idClientTemp;
    }

    public function getIdClient() {
        return $this->idClient;
    }

    public function getIdSkipper() {
        return $this->idSkipper;
    }

    public function getIdBoat() {
        return $this->idBoat;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getOption() {
        return $this->option;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getStart(): \DateTime {
        return new \DateTime($this->start);
    }

    public function getEnd(): \DateTime {
        return new \DateTime($this->end);
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setStart(string $start): void {
        $this->start = $start;
    }

    public function setEnd(string $end): void {
        $this->end = $end;
    }

    public function setPrix($prix): void {
        $this->prix = $prix;
    }

    public function setIdAdmin($idAdmin): void {
        $this->idAdmin = $idAdmin;
    }

    public function setIdClientTemp($idClientTemp): void {
        $this->idClientTemp = $idClientTemp;
    }

    public function setIdClient($idClient): void {
        $this->idClient = $idClient;
    }

    public function setIdSkipper($idSkipper): void {
        $this->idSkipper = $idSkipper;
    }

    public function setIdBoat($idBoat): void {
        $this->idBoat = $idBoat;
    }

    public function setOption($option): void {
        $this->option = $option;
    }

}
