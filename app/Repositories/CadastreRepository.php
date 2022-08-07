<?php


namespace App\Repositories;


use App\Models\Cadastre;

class CadastreRepository
{
    public function getData($zipcode, $constructionType) {
        return Cadastre::where('codigo_postal', $zipcode)
            ->where('uso_construccion', Cadastre::TYPES[$constructionType])->get();
    }
}
