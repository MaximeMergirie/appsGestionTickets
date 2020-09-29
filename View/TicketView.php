<?php
class TicketView extends View
{

    //######################################################
    /**
     * Affichage de la liste
     *
     * @return void
     ******************************************************/
    public function displayHome($listeTicket)
    {
    foreach ($listeTicket as $key) {
           $source = $key['date_debut'];
           $dateDebut = new DateTime($source);
           $dateFin = $key['date_fin'];
           if($dateFin == "0000-00-00 00:00:00"){
               $dateFin = "";
           }
           if($key['id_status']=='1'){
               $color="danger";
               $btnAction = '<div class="col"><a href="index.php?controller=action&id='.$key['id_ticket'].'" class="btn btn-success float-right col-md-1 mb-2 ">+ Action</a></div>';
           }if($key['id_status']=='2'){
            $color="warning";
            $btnAction = '<div class="col"><a href="index.php?controller=action&id='.$key['id_ticket'].'" class="btn btn-success float-right col-md-1 mb-2 ">+ Action</a></div>';
        }if($key['id_status']=='3'){
            $color="success";
            $btnAction = '';
        }
           $this->page .='<div class="card m-2">
                            <div class="card-header font-weight-bold">Ticket n°20200'.$key['id_ticket'].'</div>
  <div class="card-body">
   <div class="row">
        <div class="col-md-2 col-sm-12 text-center">
            <h5 class="card-title">Nom</h5>
            <p>'.ucfirst($key['nom']).'</p>
        </div>
        <div class="col-md-1 col-sm-12 text-center">
        <h5 class="card-title">Prénom</h5>
        <p>'.ucfirst($key['prenom']).'</p>
    </div>
    <div class="col-md-2 col-sm-12 text-center">
    <h5 class="card-title">Email</h5>
    <p>'.$key['email'] .'</p>
    </div>
    <div class="col-md-2 col-sm-12 text-center">
    <h5 class="card-title">Sujet</h5>
    <p>'.$key['sujet'] .'</p>
    </div>
    <div class="col-md-2 col-sm-12 text-center">
    <h5 class="card-title">Statut</h5>
    <span class="badge badge-pill badge-'.$color.'">'.$key['nom_status'].'</span>
    </div>
    <div class="col-md-2 col-sm-12 text-center">
    <h5 class="card-title">Date début</h5>
    <p>'.$dateDebut->format('d/m/Y') .'</p>
    </div>
    <div class="col-md-1 col-sm-12 text-center">
    <h5 class="card-title">Date fin</h5>
    <p>'.$dateFin .'</p>
    </div>
   </div>'.$btnAction.'</div></div>';
          
        }
        $this->displayPage();
    }
  
}