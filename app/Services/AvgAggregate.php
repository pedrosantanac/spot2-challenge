<?php


namespace App\Services;


use App\Models\Cadastre;
use Illuminate\Support\Collection;

class AvgAggregate extends AggregateAbstract
{
    public function doAggregate(Collection $cadastres)
    {
        $priceUnit = 0;
        $priceUnitConstruction = 0;

        $cadastres->each(function (Cadastre $cadastre) use (&$priceUnit, &$priceUnitConstruction){
            $priceUnit += $this->getPriceUnit($cadastre);
            $priceUnitConstruction += $this->getPriceUnitConstruction($cadastre);
        });
        $elements = $cadastres->count();

        return [
            "type" => "avg",
            "price_unit" => $priceUnit / $elements,
            "price_unit_construction" => $priceUnitConstruction / $elements,
            "elements" => $elements
        ];
    }
}
