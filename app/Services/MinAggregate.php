<?php


namespace App\Services;


use App\Models\Cadastre;
use Illuminate\Support\Collection;

class MinAggregate extends AggregateAbstract
{
    public function doAggregate(Collection $cadastres)
    {
        $minPriceUnit = $this->getPriceUnit($cadastres->first());
        $minPriceUnitConstruction = $this->getPriceUnitConstruction($cadastres->first());

        $cadastres->each(function (Cadastre $cadastre) use (&$minPriceUnit, &$minPriceUnitConstruction) {
            $minPriceUnit = $minPriceUnit < $this->getPriceUnit($cadastre)
                ? $minPriceUnit
                : $this->getPriceUnit($cadastre);
            $minPriceUnitConstruction = $minPriceUnitConstruction < $this->getPriceUnitConstruction($cadastre)
                ? $minPriceUnit
                : $this->getPriceUnitConstruction($cadastre);
        });
        $elements = $cadastres->count();

        return [
            "type" => "min",
            "price_unit" => $minPriceUnit,
            "price_unit_construction" => $minPriceUnitConstruction,
            "elements" => $elements
        ];
    }
}
