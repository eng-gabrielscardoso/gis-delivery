<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partners\IndexRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(IndexRequest $request)
    {
        return PartnerResource::collection(Partner::all());
    }
}
