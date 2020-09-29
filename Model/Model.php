<?php

abstract class Model
{
      /**
     * connexion a la BDD local
     */
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const BASE = "linku";
  
    protected $connexion;

    public function __construct()
    {
        // Connexion
        try {
            $this->connexion = new PDO("mysql:host=" . self::SERVER . ";dbname="
            . self::BASE, self::USER, self::PASSWORD);
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
        //Résoudre problèmes d'encodages (accents)
        $this->connexion->exec("SET NAMES 'UTF8'");

    }

    /**
     * Récupération d'un ticket en bdd
     *
     * @return void
     */
    public function getTicket()
    {
        $id = $_GET['id'];

        $requete = $this->connexion->prepare("SELECT * FROM linku_ticket WHERE id_ticket =:id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
        $ticket = $requete->fetch(PDO::FETCH_ASSOC);
        return $ticket;
    
    }
    /**
     * Récupération de la liste des users en BDD
     *
     * @return void
     */
    public function getUsers()
    {
        $requete = "SELECT * FROM linku_users";
        $result = $this->connexion->query($requete);
        $listeUsers = $result->fetchAll(PDO::FETCH_ASSOC);
        return $listeUsers;
    }
   
}
