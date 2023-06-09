<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partners\ShowRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ShowRequest $request, Partner $partner)
    {
        $data = $request->validated();

        return new PartnerResource($partner);
    }
}
