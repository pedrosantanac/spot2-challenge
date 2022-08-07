<?php


namespace App\Repositories;


interface CadastreRepositoryInterface
{
    public function getData($zipcode, $constructionType);
}
