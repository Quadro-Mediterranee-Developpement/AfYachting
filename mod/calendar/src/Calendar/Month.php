<?php

namespace Calendar;

class Month {

    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    public $month;
    public $year;

    /**
     * Month Constructor
     * @param int month Le mois est compris entre 1 et 12
     * @param int year l'année
     * @throws \Exceptions
     */
    public function __construct(?int $month = null, ?int $year = null) {
        if ($month === null || $month < 1 || $month > 12) {
            $month = intval(date('m'));
        }
        if ($year === null) {
            $year = intval(date('Y'));
        }

        if ($year < 2018) {
            throw new \Exception("l'année n'est pas valide");
        }
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * 
     * @return \DateTime le premier jour du mois
     */
    public function getStartingDay(): \DateTime {
        return new \DateTime("{$this->year}-{$this->month}-01");
    }

    /**
     * 
     * @return Retourne le mois en toute lettre
     */
    public function toString(): string {
        return $this->months[$this->month - 1] . ' ' . $this->year;
    }

    /**
     * 
     * @renvoie le nombre de semaine dans le mois
     */
    public function getWeeks(): int {
        $start = $this->getStartingDay();
        $end = (clone $start)->modify("+1 month -1 day");
        $weeks = intval($end->format('W')) - intval($start->format('W')) + 1;
        if ($weeks < 0) {
            $weeks = 5;
        }
        return $weeks;
    }

    /**
     * Permet de dire si le jour est dans le mois en cours 
     * @param \DateTime $date
     * @return bool
     */
    public function withinMonth(\DateTime $date): bool {
        return $this->getStartingDay()->format("Y-m") === $date->format("Y-m");
    }

    /**
     * 
     * @renvoie le nombre de semaine dans le mois
     */
    public function getMonth(): int {
        return intval($this->month);
    }

    /**
     * 
     * @renvoie le nombre de semaine dans le mois
     */
    public function getYear(): int {
        return intval($this->year);
    }

    /**
     * Retourne une instance de Mois (le mois suivant et si on est en décembre, l'année suivante)
     * @return \App\Dates\Month
     */
    public function nextMonth(): Month {
        $month = $this->month + 1;
        $year = $this->year;

        if ($month > 12) {
            $month = 1;
            $year += 1;
        }
        return new Month($month, $year);
    }

    /**
     * Renvoie le mois précédent
     * @return \App\Dates\Month
     */
    public function previousMonth(): Month {
        $month = $this->month - 1;
        $year = $this->year;

        if ($month < 1) {
            $month = 12;
            $year -= 1;
        }
        return new Month($month, $year);
    }

}
