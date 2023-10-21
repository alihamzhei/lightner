<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyCreatedRequest;
use App\Models\Currency;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class CurrencyController extends Controller
{
    use ApiResponse;

    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $currencies = Currency::where('is_active',true)->latest()->paginate(20);

        return $this->successResponse(
            $currencies,
            __('payment.messages.payment_list_found_successfully')
        );
    }

    /**
     * store
     *
     * @param CurrencyCreatedRequest $request
     * @return JsonResponse
     */
    public function store(CurrencyCreatedRequest $request): JsonResponse
    {
        $currency = Currency::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'abbr' => $request->abbr,
            'symbol' => $request->symbol
        ]);

        return $this->successResponse(
            $currency,
            __('payment.messages.payment_successfully_created')
        );
    }

    /**
     * show
     *
     * @param Currency $currency
     * @return JsonResponse
     */
    public function show(Currency $currency): JsonResponse
    {
        return $this->successResponse(
            $currency,
            __('payment.messages.payment_successfully_found')
        );
    }

    /**
     * deactivate
     *
     * @param Currency $currency
     * @return JsonResponse
     */
    public function deactivate(Currency $currency): JsonResponse
    {
        $currency->update([
            'is_active' => false,
        ]);

        return $this->successResponse(
            $currency,
            __('payment.messages.payment_successfully_found')
        );
    }

    /**
     * activate
     *
     * @param Currency $currency
     * @return JsonResponse
     */
    public function activate(Currency $currency): JsonResponse
    {
        $currency->update([
            'is_active' => true,
        ]);

        return $this->successResponse(
            $currency,
            __('payment.messages.payment_successfully_found')
        );
    }
}
