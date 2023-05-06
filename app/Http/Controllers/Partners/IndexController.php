<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partners\IndexRequest;
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
        $data = $request->validated();

        $query = QueryBuilder::for(Partner::class)
            ->allowedFilters([
                AllowedFilter::exact('trading_name'),
                AllowedFilter::exact('owner_name'),
                AllowedFilter::exact('document'),
                AllowedFilter::scope('address'),
                AllowedFilter::scope('coverage_area'),
            ])
            ->allowedSorts('trading_name', 'owner_name', 'address', 'created_at', 'updated_at')
            ->defaultSort('address');

        $partners = $query->paginate((int) $request->input('pageSize', 12))->withQueryString();

        return PartnerResource::collection($partners);
    }
}
