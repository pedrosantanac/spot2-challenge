<?php


namespace App\Services;


use App\Models\Cadastre;
use App\Repositories\CadastreRepository;
use App\Repositories\CadastreRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class PriceService
{
    protected $cadastreRepository;
    protected $aggregateFactory;

    public function __construct(CadastreRepository $cadastreRepository, AggregateFactory $aggregateFactory)
    {
        $this->cadastreRepository = $cadastreRepository;
        $this->aggregateFactory = $aggregateFactory;
    }

    public function prices(int $zipcode, $aggregate, $constructionType)
    {
        $this->validateConstructionType($constructionType);
        $cadastres = $this->cadastreRepository->getData($zipcode, $constructionType);
        if ($cadastres->isEmpty()) {
            throw new \Exception("Information does not exist.", Response::HTTP_NOT_FOUND);
        }
        $aggregate = $this->aggregateFactory->create($aggregate);

        return $aggregate->doAggregate($cadastres);
    }

    /**
     * @param $constructionType
     * @throws \Exception
     */
    private function validateConstructionType($constructionType)
    {
        if (!in_array($constructionType, array_keys(Cadastre::TYPES))) {
            throw new \Exception("Construction Type Invalid.", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
