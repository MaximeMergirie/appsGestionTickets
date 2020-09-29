<?php

include 'Model/TicketModel.php';
include 'View/TicketView.php';

class TicketController extends Controller
{
    public function __construct()
    {
        $this->view = new TicketView();
        $this->model = new TicketModel();
    }
    //######################################################
    /**
     * Construction de la page d'accueil
     * Liste des informations
     * @return void
     ******************************************************/
    public function start()
    {
        $model = new TicketModel();
        $listeTicket = $model->getTickets();
        $this->view->displayHome($listeTicket);
    }

    // public function changeStatus()
    // {
    //     $this->model->changeStatus();
    // }
}