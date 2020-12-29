<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Payment\PayInvoiceRequest;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    /**
     * Invoice pay request
     * @param PayInvoiceRequest $request
     * @return Response
     */
    public function payInvoice(PayInvoiceRequest $request)
    {
        $invoiceID = $request->get('invoice_id');

        $payment = Invoice::query()
            ->where('status', '=', (string) Invoice::PENDING)
            ->whereNull('payed_at')
            ->where('id', '=', $invoiceID)
            ->update([
                'payed_at' => Carbon::now(),
                'payed_by' => auth()->user()->id,
                'status' => (string) Invoice::PAYED
            ]);

        if($payment) return response()->successMessage("Payment Successfully processed.");

        return response()->error("Error while processing payment.");
    }
}
