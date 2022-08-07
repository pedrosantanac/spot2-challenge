<?php


namespace App\Services;


use Symfony\Component\HttpFoundation\Response;

class AggregateFactory
{
    protected $aggregates = [
        'avg' => AvgAggregate::class,
        'min' => MinAggregate::class,
        'max' => MaxAggregate::class,
    ];

    public function create($aggregate)
    {
        try {
            return new $this->aggregates[$aggregate];
        } catch (\Exception $e) {
            throw new \Exception("Aggregate {$aggregate} not implemented", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
