<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Calendar;

/**
 * Description of Events
 * Classe concernant l'ensemble des évènements
 *
 * @author angec
 */
class Events {

    private $bdd;

    public function __construct(\PDO $bdd) {
        $this->bdd = $bdd;
    }

    /**
     * Fonction qui permet de récupérer un évenement commençant entre deux dates (bdd)
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    //$sql = "SELECT evenement.ID AS id,evenement.State AS name,evenement.Note AS description,evenement.Start_Override AS start,evenement.Stop_Override AS end,(SELECT Username FROM admin WHERE admin.ID = evenement.ID_Admin) AS nameAdmin,(SELECT Username FROM client_ponctuel WHERE client_ponctuel.ID = evenement.ID_Client_Ponctuel) AS nameClientTemp, (SELECT Username FROM client WHERE client.ID = evenement.ID_Client) AS nameClient, (SELECT Username FROM skipper WHERE skipper.ID = evenement.ID_Skipper) AS nameSkipper,(SELECT nom FROM bateau WHERE bateau.ID = evenement.ID_Bateau) AS nameBoat, evenement.Total AS prix FROM evenement WHERE Start_Override BETWEEN '" . $start->format('Y-m-d 00:00:00') . "' AND '" . $end->format('Y-m-d 23:59:59') . " ORDER BY Start_Override ASC'";
    public function getEventsBetween(\DateTime $start, \DateTime $end): array {
        $sql = "SELECT evenement.ID AS id,evenement.State AS name,evenement.Note AS description,evenement.Start_Override AS start,evenement.Stop_Override AS end, evenement.ID_Admin AS idAdmin,evenement.ID_Client_Ponctuel AS idClientTemp, evenement.ID_Client AS idClient, evenement.ID_Skipper AS idSkipper, evenement.ID_Bateau AS idBoat, evenement.Total AS prix FROM evenement WHERE Start_Override BETWEEN '" . $start->format('Y-m-d 00:00:00') . "' AND '" . $end->format('Y-m-d 23:59:59') . " ORDER BY Start_Override ASC'";
        $statement = $this->bdd->query($sql);
        $results = [];
        if (!$statement == null) {
            $results = $statement->fetchAll();
        }
        return $results;
    }

    public function getEventsBetweenAndID(\DateTime $start, \DateTime $end, $id): array {
        switch ($id['ROLE']) {
            case 'admin':
                $add = "";
                break;
            case 'skipper':
                $add = " evenement.ID_Skipper = " . $id['ID'] . " AND ";
                break;
            case 'client':
                $add = " evenement.ID_Client = " . $id['ID'] . " AND ";
                break;
            default:
                $add = " 1 = 2 AND ";
                break;
        }
        $sql = "SELECT evenement.ID AS id,evenement.State AS name,evenement.Note AS description,evenement.Start_Override AS start,evenement.Stop_Override AS end, evenement.ID_Admin AS idAdmin,evenement.ID_Client_Ponctuel AS idClientTemp, evenement.ID_Client AS idClient, evenement.ID_Skipper AS idSkipper, evenement.ID_Bateau AS idBoat, evenement.Total AS prix FROM evenement WHERE $add Start_Override BETWEEN '" . $start->format('Y-m-d 00:00:00') . "' AND '" . $end->format('Y-m-d 23:59:59') . " ORDER BY Start_Override ASC'";
        $statement = $this->bdd->query($sql);
        $results = [];
        if (!$statement == null) {
            $results = $statement->fetchAll();
        }
        return $results;
    }

    /**
     * Récupere les arguments commençant entre 2 dates indexés par jour
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function getEventsBetweenByDay(\DateTime $start, \DateTime $end): array {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach ($events as $event) {
            $date = explode(' ', $event['start'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            } else {
                $days[$date][] = $event;
            }
        }
        return $days;
    }

    public function getEventsBetweenByDayAndID(\DateTime $start, \DateTime $end, $id): array {
        $events = $this->getEventsBetweenAndID($start, $end, $id);
        $days = [];
        foreach ($events as $event) {
            $date = explode(' ', $event['start'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            } else {
                $days[$date][] = $event;
            }
        }
        return $days;
    }

    /**
     * Recupere un évènement grâce à son id
     * @param int $id
     * @return array
     */
    public function find(int $id): Event {
        $statement = $this->bdd->query("SELECT evenement.ID AS id,evenement.State AS name,evenement.Note AS description,evenement.Start_Override AS start,evenement.Stop_Override AS end, evenement.ID_Admin AS idAdmin,evenement.ID_Client_Ponctuel AS idClientTemp, evenement.ID_Client AS idClient, evenement.ID_Skipper AS idSkipper, evenement.ID_Bateau AS idBoat, evenement.Total AS prix FROM evenement WHERE ID = $id LIMIT 1");
        $statement->setFetchMode(\PDO::FETCH_CLASS, \Calendar\Event::class);
        $retourvariable = $statement->fetch();
        if ($statement === null || $retourvariable === false) {
            $retourvariable = [];
        }
        return $retourvariable;
    }

    public function findCompte(string $table) {
        $statement = $this->bdd->query("SELECT ID AS id,Username AS name FROM $table ");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function findOneCompte(int $id, string $table) {
        $statement = $this->bdd->query("SELECT Username AS name FROM $table WHERE ID = $id");
        $statement->execute();
        return $statement->fetch()['name'];
    }

    public function findOneBoat(int $id) {
        $statement = $this->bdd->query("SELECT nom AS name FROM bateau WHERE ID = $id");
        $statement->execute();
        return $statement->fetch()['name'];
    }

    public function findBoat() {
        $statement = $this->bdd->query("SELECT ID AS id,nom AS name FROM bateau ");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function hydrate(Event $event, array $data) {
        $event->setName($data['name']);
        $event->setDescription($data['description']);
        $event->setIdAdmin($data['idAdmin']);
        $event->setIdBoat($data['idBoat']);
        $event->setIdClient($data['idClient']);
        $event->setIdClientTemp($data['idClientTemp']);
        $event->setIdSkipper($data['idSkipper']);
        $event->setPrix($data['prix']);
        $event->setStart(\DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['start'])->format('Y-m-d H:i:s'));
        $event->setEnd(\DateTime::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['end'])->format('Y-m-d H:i:s'));
        return $event;
    }

    public function create(Event $event): bool {

        $statement = $this->bdd->prepare('INSERT INTO evenement (State, Note, Start_Override, Stop_Override,Total,ID_Admin,ID_Bateau,ID_Skipper,ID_Client,ID_Client_Ponctuel) VALUES(?, ?, ?, ?, ?,?,?,?,?,?)');

        return $statement->execute([
                    $event->getName(),
                    $event->getDescription(),
                    $event->getStart()->format('Y-m-d H:i:s'),
                    $event->getEnd()->format('Y-m-d H:i:s'),
                    $event->getPrix(),
                    $event->getIdAdmin(),
                    $event->getIdBoat(),
                    $event->getIdSkipper(),
                    $event->getIdClient(),
                    $event->getIdClientTemp(),
        ]);
    }

    public function update(Event $event): bool {
        $statement = $this->bdd->prepare('UPDATE evenement SET State=?, Note=?, Start_Override=?, Stop_Override=?, Total = ?,ID_Admin = ?,ID_Bateau = ?,ID_Skipper = ?,ID_Client = ?,ID_Client_Ponctuel = ? WHERE ID= ?');

        return $statement->execute([
                    $event->getName(),
                    $event->getDescription(),
                    $event->getStart()->format('Y-m-d H:i:s'),
                    $event->getEnd()->format('Y-m-d H:i:s'),
                    $event->getPrix(),
                    $event->getIdAdmin(),
                    $event->getIdBoat(),
                    $event->getIdSkipper(),
                    $event->getIdClient(),
                    $event->getIdClientTemp(),
                    $event->getId(),
        ]);
    }

    public function suppr(Event $event): bool {
        $statement = $this->bdd->prepare('DELETE FROM evenement WHERE ID= ?');
        return $statement->execute([$event->getId()]);
    }

}
