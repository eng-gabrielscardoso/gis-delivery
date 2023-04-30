<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdatePartnerRequest $request, Partner $partner)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            if (Arr::has($data, 'tradingName')) {
                $partner->trading_name = Arr::get($data, 'tradingName');
            }

            if (Arr::has($data, 'ownerName')) {
                $partner->owner_name = Arr::get($data, 'ownerName');
            }

            if (Arr::has($data, 'document')) {
                $partner->document = Arr::get($data, 'document');
            }

            if (Arr::has($data, 'coverageArea')) {
                $partner->coverage_area = Arr::get($data, 'coverageArea');
            }

            if (Arr::has($data, 'address')) {
                $partner->address = Arr::get($data, 'address');
            }

            $partner->save();

            DB::commit();

            return new PartnerResource($partner);
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }
}
