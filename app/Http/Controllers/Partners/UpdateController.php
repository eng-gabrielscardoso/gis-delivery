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

            if (Arr::has($data, 'trading_name')) {
                $partner->trading_name = Arr::get($data, 'trading_name');
            }

            if (Arr::has($data, 'owner_name')) {
                $partner->owner_name = Arr::get($data, 'owner_name');
            }

            if (Arr::has($data, 'document')) {
                $partner->document = Arr::get($data, 'document');
            }

            if (Arr::has($data, 'coverage_area')) {
                $partner->coverage_area = Arr::get($data, 'coverage_area');
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
