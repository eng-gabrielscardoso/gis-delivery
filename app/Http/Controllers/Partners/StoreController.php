<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnerRequest;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StorePartnerRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $partner = Partner::create([
                'trading_name' => Arr::get($data, 'tradingName'),
                'owner_name' => Arr::get($data, 'ownerName'),
                'document' => Arr::get($data, 'document'),
                'coverage_area' => Arr::get($data, 'coverageArea'),
                'address' => Arr::get($data, 'address'),
            ]);

            DB::commit();

            return new PartnerResource($partner);
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }
}
