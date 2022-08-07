<?php

namespace Tests\Unit;

use App\Models\Cadastre;
use App\Services\AvgAggregate;
use App\Services\MaxAggregate;
use App\Services\MinAggregate;
use App\Services\PriceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AggregateTest extends TestCase
{
    /**
     *
     * @test
     * @dataProvider providerCadastresAVG
     * @param $cadastres
     * @param $averages
     * @return void
     */
    public function it_should_return_average_price($cadastres, $average)
    {
        $avgAggregate = app(AvgAggregate::class);
        $result = $avgAggregate->doAggregate($cadastres);
        $this->assertEquals($result['type'], $average['type']);
        $this->assertEquals($result['price_unit'], $average['price_unit']);
        $this->assertEquals($result['price_unit_construction'], $average['price_unit_construction']);
        $this->assertEquals($result['elements'], $average['elements']);
    }

    /**
     *
     * @test
     * @dataProvider providerCadastresMAX
     * @param $cadastres
     * @param $maximum
     * @return void
     */
    public function it_should_return_maximun_price($cadastres, $maximum)
    {
        $maxAggregate = app(MaxAggregate::class);
        $result = $maxAggregate->doAggregate($cadastres);
        $this->assertEquals($result['type'], $maximum['type']);
        $this->assertEquals($result['price_unit'], $maximum['price_unit']);
        $this->assertEquals($result['price_unit_construction'], $maximum['price_unit_construction']);
        $this->assertEquals($result['elements'], $maximum['elements']);
    }

    /**
     *
     * @test
     * @dataProvider providerCadastresMIN
     * @param $cadastres
     * @param $minimum
     * @return void
     */
    public function it_should_return_minimun_price($cadastres, $minimum)
    {
        $minAggregate = app(MinAggregate::class);
        $result = $minAggregate->doAggregate($cadastres);
        $this->assertEquals($result['type'], $minimum['type']);
        $this->assertEquals($result['price_unit'], $minimum['price_unit']);
        $this->assertEquals($result['price_unit_construction'], $minimum['price_unit_construction']);
        $this->assertEquals($result['elements'], $minimum['elements']);
    }

    public function providerCadastresAVG(): array
    {
        return [
            [
                collect([
                    new Cadastre([
                        'superficie_terreno' => 211,
                        'superficie_construccion' => 209,
                        'valor_suelo' => 257325.05,
                        'subsidio' => 687.12
                    ]),
                    new Cadastre([
                        'superficie_terreno' => 210,
                        'superficie_construccion' => 104,
                        'valor_suelo' => 542415.3,
                        'subsidio' => 662.34
                    ])
                ]),
                [
                    "type" => "avg",
                    "price_unit" => 0.00060490026352644,
                    "price_unit_construction" => 0.00050317315498661,
                    "elements" => 2
                ]
            ]
        ];
    }

    public function providerCadastresMAX(): array
    {
        return [
            [
                collect([
                    new Cadastre([
                        'superficie_terreno' => 211,
                        'superficie_construccion' => 209,
                        'valor_suelo' => 257325.05,
                        'subsidio' => 687.12
                    ]),
                    new Cadastre([
                        'superficie_terreno' => 210,
                        'superficie_construccion' => 104,
                        'valor_suelo' => 542415.3,
                        'subsidio' => 662.34
                    ])
                ]),
                [
                    "type" => "max",
                    "price_unit" => 0.00082216997308231,
                    "price_unit_construction" => 0.00081437689276873,
                    "elements" => 2
                ]
            ]
        ];
    }

    public function providerCadastresMIN(): array
    {
        return [
            [
                collect([
                    new Cadastre([
                        'superficie_terreno' => 211,
                        'superficie_construccion' => 209,
                        'valor_suelo' => 257325.05,
                        'subsidio' => 687.12
                    ]),
                    new Cadastre([
                        'superficie_terreno' => 210,
                        'superficie_construccion' => 104,
                        'valor_suelo' => 542415.3,
                        'subsidio' => 662.34
                    ])
                ]),
                [
                    "type" => "min",
                    "price_unit" => 0.00038763055397058,
                    "price_unit_construction" => 0.00019196941720448,
                    "elements" => 2
                ]
            ]
        ];
    }
}
