<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePartnerRequest;
use App\Models\Partner;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdatePartnerRequest $request, Partner $partner)
    {
    }
}
