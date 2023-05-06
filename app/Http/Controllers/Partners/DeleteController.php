<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partners\DeleteRequest;
use App\Models\Partner;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(DeleteRequest $request, Partner $partner)
    {
        $data = $request->validated();

        $partner->delete();

        return response()->noContent();
    }
}
