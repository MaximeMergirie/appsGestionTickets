<?php
class ActionView extends View
{

    //######################################################
    /**
     * Affichage de la liste
     *
     * @return void
     ******************************************************/
    public function displayHome($listeAction,$ticket)
    {
        $source = $ticket['date_debut'];
        $dateDebut = new DateTime($source);
           $dateFin = $ticket['date_fin'];
           if($dateFin == "0000-00-00 00:00:00"){
               $dateFin = "";
           }
        $this->page .= '<div class="row"><div class="col"><div class="float-right"><a href="index.php?controller=ticket">
        <button class="btn btn-danger m-3">Retour aux tickets</button></a></div></div></div>';
        $this->page .= '<div class="container"><div class=""><div class="card">
  <div class="card-header ">
    <h4 class="col-sm-12">Récapitulatif du ticket n°20200'.$ticket['id_ticket'].'</h4>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item ">Nom : '.$ticket['nom'].'</li>
    <li class="list-group-item ">Prénom : '.$ticket['prenom'].'</li>
    <li class="list-group-item ">Email : '.$ticket['email'].'</li>
    <li class="list-group-item ">Téléphone : '.$ticket['tel'].'</li>
    <li class="list-group-item ">Sujet : '.$ticket['sujet'].'</li>
    <li class="list-group-item ">Catégorie : '.$ticket['categorie'].'</li>
    <li class="list-group-item ">Message : '.$ticket['message'].'</li>
    <li class="list-group-item ">Création ticket : '.$dateDebut->format('d/m/Y').'</li>
    <li class="list-group-item ">Fermeture ticket : '.$dateFin.'</li>
  </ul>
</div></div></div>';
        $this->page .=
            '<div class="row container mt-5">
                <div class="col-md-6 col-sm-12"><h3 >Liste des actions du ticket n°20200'.$ticket['id_ticket'].'</h3></div>
                <div class="col-md-6 col-sm-12">
                <a href="index.php?controller=action&action=closeTicket&id='.$ticket['id_ticket'].'" class="btn btn-danger float-right mr-3" id="closeTicket">- Fermer ticket</a>
                <a href="index.php?controller=action&action=addForm&id='.$ticket['id_ticket'].'" class="btn btn-success float-right mr-3 ">+ Ajouter</a>
                </div>
            </div>';
            if(empty($listeAction)){
                $this->page .= "<div class='col text-center m-3'><h4>Aucune action en cours</h4></div>";
            }else{
        foreach ($listeAction as $key) {
        $source = $key['date_action'];
        $date = new DateTime($source);
            $this->page .='<div class="card m-2">
            <div class="card-header font-weight-bold">Action n°'.$key['id_action'].'</div>
<div class="card-body">
<div class="row">

<div class="col-md-3 col-sm-12 text-center">
<h5 class="card-title">Action</h5>
<p>'.$key['nom_action'].'</p>
</div>

<div class="col-md-3 col-sm-12 text-center">
<h5 class="card-title">Nom du technicien</h5>
<p>'.$key['display_name'].'</p>
</div>

<div class="col-md-3 col-sm-12 text-center">
<h5 class="card-title">Date action</h5>
<p>'.$date->format('d/m/Y').'</p>
</div>

<div class="col-md-3 col-sm-12 text-center">
<p></p>
<a href="index.php?controller=action&action=editForm&id='.$ticket['id_ticket'].'&idAction='.$key['id_action'].'" class="btn btn-warning float-right mr-3 ">Modifier</a>
</div>

</div>
</div>
</div>
';
        }}
        $this->displayPage();
    }
    //######################################################
    /**
     * Affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm($ticket,$listeUsers)
    {
        $this->page .= file_get_contents('template/formAction.html');
        $this->page = str_replace('{action}', 'addDB', $this->page);
        $this->page = str_replace('{changeStatus}', 'changeStatus', $this->page);
        $this->page = str_replace('{idTicket}',$ticket['id_ticket'], $this->page);
        $technicien = "";
        foreach ($listeUsers as $users) {
            $technicien .= "<option value='" . $users['ID'] . "'>".$users["display_name"]. "</option>";
        }
        $this->page = str_replace("{user}", $technicien, $this->page);
        $this->page = str_replace('{nomAction}', '', $this->page);
        $this->displayPage();
    }
    //######################################################
    /**
     * Affichage du formulaire d'edition
     *
     * @return void
     ******************************************************/
    public function editForm($action,$listeUsers)
    {
        $this->page .= file_get_contents('template/formEdit.html');
        $this->page = str_replace('{action}', 'editDB', $this->page);
        $this->page = str_replace('{idAction}', $action['id_action'], $this->page);
        $this->page = str_replace('{idTicket}', $action['id_ticket'], $this->page);
        $techniciens = "";
        foreach ($listeUsers as $technicien) {
            $selected = "";
            if ($technicien['ID'] == $action['id_user']) {
                $selected = "selected";
            }
            $techniciens .= "<option $selected value='" . $technicien['ID'] . "'>" . $technicien['display_name'] . "</option>";
        }
        $this->page = str_replace("{user}", $techniciens, $this->page);
        $this->page = str_replace('{nomAction}', $action['nom_action'], $this->page);
        $this->displayPage();
    }
}
