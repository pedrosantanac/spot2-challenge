<?php


namespace App\Services;


use App\Models\Cadastre;
use Illuminate\Support\Collection;

abstract class AggregateAbstract
{
    abstract public function doAggregate(Collection $data);

    protected function getPriceUnit(Cadastre $cadastre)
    {
        return $cadastre->superficie_terreno / ($cadastre->valor_suelo - $cadastre->subsidio);
    }

    protected function getPriceUnitConstruction(Cadastre $cadastre)
    {
        return $cadastre->superficie_construccion / ($cadastre->valor_suelo - $cadastre->subsidio);
    }


}
