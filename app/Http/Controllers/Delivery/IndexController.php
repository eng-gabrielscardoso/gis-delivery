<?php

namespace App\Http\Controllers\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delivery\IndexRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(IndexRequest $request)
    {
        $query = QueryBuilder::for(Partner::class)
            ->allowedFields([AllowedFilter::scope('coverage_area')])
            ->allowedSorts('address')
            ->defaultSort('address');

        $partners = $query->paginate((int) $request->input('pageSize', 12))->withQueryString();

        return PartnerResource::collection($partners);
    }
}
