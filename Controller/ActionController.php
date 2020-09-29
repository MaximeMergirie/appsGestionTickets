<?php

include 'Model/ActionModel.php';
include 'View/ActionView.php';

class ActionController extends Controller
{


    public function __construct()
    {
        $this->view = new ActionView();
        $this->model = new ActionModel();
    }
    //######################################################
    /**
     * Construction de la page d'accueil
     * Liste des informations
     * @return void
     ******************************************************/
    public function start()
    {
        $model = new ActionModel();
        $listeAction = $model->getActions();
        $ticket = $model->getTicket();
        $this->view->displayHome($listeAction,$ticket);
    }
    //######################################################
    /**
     * Ajout d'une info en DB
     *
     * @return void
     ******************************************************/
    public function addDB()
    {
        $this->model->addDB();
        header('location:index.php?controller=action&id='.$_GET['id']);
    }

    public function closeTicket()
    {
        $this->model->closeTicket();
        header('location:index.php?controller=ticket');
    }

    //######################################################
    /**
     * Gestion de l'affichage du formulaire d'ajout
     *
     * @return void
     ******************************************************/
    public function addForm()
    {
        $ticket = $this->model->getTicket();
        $listeUsers = $this->model->getUsers();
        $this->view->addForm($ticket,$listeUsers);
    }
    /**
     * Récupération d'une info en DB
     *
     * @return void
     ******************************************************/
    public function editForm()
    {
        $listeUsers = $this->model->getUsers();
        $action = $this->model->getAction();
        $this->view->editForm($action,$listeUsers);
    }
    //######################################################
    //######################################################
    /**
     * Moddification d'une info en DB
     *
     * @return void
     ******************************************************/
    public function editDB()
    {
        $this->model->editDB();
        header('location:index.php?controller=action&id='.$_GET['id']);
    }

     //######################################################
    /**
     * Suppression d'une info en DB
     *
     * @return void
     ******************************************************/
    // public function delDB()
    // {
    //     $this->model->delDB();
    //     header('location:index.php?controller=action');
    // }
    //######################################################

}