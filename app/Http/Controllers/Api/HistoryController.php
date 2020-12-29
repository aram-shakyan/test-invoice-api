<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\History\UserPaymentHistoryRequest;
use App\Models\Invoice;

class HistoryController extends Controller
{
    /**
     * @param UserPaymentHistoryRequest $request
     * @return mixed
     */
    public function getUserPaymentHistory(UserPaymentHistoryRequest $request)
    {
        $historyPayments = Invoice::query()
            ->select('id', 'school_name', 'description', 'amount', 'payed_at')
            ->where('payed_by', '=', auth()->user()->id)
            ->whereNotNull('payed_at')
            ->where('status', '=', Invoice::PAYED)
            ->orderBy('payed_at','DESC')
            ->paginate(20);

        return response()->success($historyPayments);
    }
}
