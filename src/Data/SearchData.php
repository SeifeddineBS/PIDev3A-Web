<?php


namespace App\Data;


use App\Entity\Activite;

class SearchData
{
    /**
     * @var String
     */
    public $lieu ;
    /**
     * @var String
     */
    public $description ;


    /**
     * @var int
     */
    public $nombremax ;

    /**
     * @var Activite[]
     */
    public $Activite = [];

}