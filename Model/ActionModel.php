<?php

class ActionModel extends Model
{
    //######################################################
    /**
     * Récupération d'une donnée de la BDD
     *
     * @return $produit
     ******************************************************/
    public function getAction()
    {
        $id = $_GET['idAction'];

        $requete = $this->connexion->prepare("SELECT * FROM linku_action WHERE id_action=:id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
        $action = $requete->fetch(PDO::FETCH_ASSOC);
        return $action;
    }
 
         /**
     * Récupération de l'ensemble des données de la base
     *
     * @return void
     */
    public function getActions()
    {   
        $id = $_GET['id'];

        $requete = $this->connexion->prepare("SELECT *,
        linku_action.id_ticket as numero_ticket
        FROM linku_action
        JOIN linku_ticket
        ON linku_action.id_ticket=linku_ticket.id_ticket
        JOIN linku_users
        ON linku_action.id_user=linku_users.ID
        WHERE linku_action.id_ticket = :id
        ");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
        $listeAction = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $listeAction;
    }    

    //######################################################
    /**
     * Ajout dans la BDD
     *
     * @return void
     ******************************************************/
    public function addDB()
    {
        $ticket = $_POST['ticket'];
        $user = $_POST['user'];
        $nomAction = $_POST['action'];
        $status = "2";


        $requete = $this->connexion->prepare("INSERT INTO linku_action (id_action, nom_action,id_user,id_ticket)
            VALUES (NULL,:action , :user, :ticket)");
        $requete->bindParam(':action', $nomAction);
        $requete->bindParam(':user', $user);
        $requete->bindParam(':ticket', $ticket);
        $resultat = $requete->execute();

        $requete2 = $this->connexion->prepare("UPDATE linku_ticket 
        SET  status=:status 
        WHERE id_ticket=:id");
        $requete2->bindParam(':id', $ticket);
        $requete2->bindParam(':status', $status);
        $resultat = $requete2->execute();
    }

    //######################################################
    /**
     * Changement du statuts en 'En traité'
     *
     * @return void
     ******************************************************/
    public function closeTicket()
    {
        $id = $_GET['id'];
        $status = "3";
        $date = date('d/m/Y');

        $requete = $this->connexion->prepare("UPDATE linku_ticket 
            SET date_fin=:date, status=:status 
            WHERE id_ticket=:id");
        $requete->bindParam(':id', $id);
        $requete->bindParam(':status', $status);
        $requete->bindParam(':date', $date);
        $resultat = $requete->execute();
    }

        //######################################################
    /**
     * Modification de l'action dans la DB
     *
     * @return void
     ******************************************************/
    public function editDB()
    {
        $id = $_POST['numAction'];
        $user = $_POST['user'];
        $nomAction = $_POST['action'];
        

        $requete = $this->connexion->prepare("UPDATE linku_action 
            SET nom_action=:action,id_user=:user
            WHERE id_action=:id");
        $requete->bindParam(':id', $id);
        $requete->bindParam(':action', $nomAction);
        $requete->bindParam(':user', $user);
        $resultat = $requete->execute();
   
    }
    
    //######################################################
    /**
     * Suppression dans la DB
     *
     * @return void
     ******************************************************/
    // public function delDB()
    // {
    //     $id = $_GET['id'];
    //     $requete = $this->connexion->prepare("DELETE FROM produit WHERE id=:id");
    //     $requete->bindParam(':id', $id);
    //     $resultat = $requete->execute();
    // }

}
