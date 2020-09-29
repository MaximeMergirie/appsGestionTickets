<?php

class TicketModel extends Model
{
    //######################################################
    /**
     * Récupération d'une donnée de la BDD
     *
     * @return $produit
     ******************************************************/
    public function getTicket()
    {
        $id = $_GET['id'];
        $requete = $this->connexion->prepare("SELECT * FROM linku_ticket WHERE id=:id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
        $ticket = $requete->fetch(PDO::FETCH_ASSOC);
        return $ticket;
    }
         /**
     * Récupération de l'ensemble des données de la base
     *
     * @return void
     */
    public function getTickets()
    {
        $requete = "SELECT * 
        FROM linku_ticket 
        JOIN linku_status
        ON linku_ticket.status=linku_status.id_status
        ORDER BY linku_ticket.status";
        $result = $this->connexion->query($requete);
        $listeTickets = $result->fetchAll(PDO::FETCH_ASSOC);
        return $listeTickets;
    }

    // public function changeStatus()
    // {
    //     $status = "2";

    //     $requete = $this->connexion->prepare("UPDATE linku_ticket 
    //         SET  status=:status 
    //         WHERE id_ticket=:id");
    //     $requete->bindParam(':id', $id);
    //     $requete->bindParam(':status', $status);
    //     $resultat = $requete->execute();
    // }

}
