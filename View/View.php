<?php

abstract class View
{
    protected $page;

    public function __construct()
    {
        $this->page = file_get_contents('template/head.html');
    }
    //######################################################
    /**
     * Affichage de la page
     *
     * @return void
     ******************************************************/
    protected function displayPage()
    {
        $this->page .= file_get_contents('template/footer.html');
        echo $this->page;
    }
}
