<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\PriceResource;
use App\Models\Cadastre;
use App\Services\PriceService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PriceController extends Controller
{
    protected $priceService;

    public function __construct(PriceService $priceService)
    {
        $this->priceService = $priceService;
    }

    public function prices(Request $request, $zip_code, $aggregate)
    {
        $constructionType = $request->get('construction_type');
        try {
            $prices = $this->priceService->prices($zip_code, $aggregate, $constructionType);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], $e->getCode());
        }

        return response()->json(new PriceResource($prices), Response::HTTP_OK);
    }

    public function zipcodes()
    {
        return response()->json(['status' => true, 'payload' => ['zipcodes' => Cadastre::where('codigo_postal', '!=', ' ')->pluck('codigo_postal')->unique()]], Response::HTTP_OK);
    }
}
