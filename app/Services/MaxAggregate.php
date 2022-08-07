<?php


namespace App\Services;


use App\Models\Cadastre;
use Illuminate\Support\Collection;

class MaxAggregate extends AggregateAbstract
{
    public function doAggregate(Collection $cadastres)
    {
        $maxPriceUnit = $this->getPriceUnit($cadastres->first());
        $maxPriceUnitConstruction = $this->getPriceUnitConstruction($cadastres->first());

        $cadastres->each(function (Cadastre $cadastre) use (&$maxPriceUnit, &$maxPriceUnitConstruction) {
            $maxPriceUnit = $maxPriceUnit > $this->getPriceUnit($cadastre)
                ? $maxPriceUnit
                : $this->getPriceUnit($cadastre);
            $maxPriceUnitConstruction = $maxPriceUnitConstruction > $this->getPriceUnitConstruction($cadastre)
            ? $maxPriceUnitConstruction
            : $this->getPriceUnitConstruction($cadastre);
        });
        $elements = $cadastres->count();

        return [
            "type" => "max",
            "price_unit" => $maxPriceUnit,
            "price_unit_construction" => $maxPriceUnitConstruction,
            "elements" => $elements
        ];
    }
}
