<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Invoice\DestroyRequest;
use App\Http\Requests\Api\Invoice\IndexRequest;
use App\Http\Requests\Api\Invoice\ShowRequest;
use App\Http\Requests\Api\Invoice\StoreRequest;
use App\Http\Requests\Api\Invoice\UpdateRequest;
use App\Models\Invoice;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    /**
     * InvoiceController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return void
     */
    public function index(IndexRequest $request)
    {
        $invoices = Invoice::query()
            ->select('id', 'school_name', 'description', 'amount', 'status', 'payed_by', 'payed_at')
            ->with('payeer:id,name')
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return response()->success($invoices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return void
     */
    public function store(StoreRequest $request)
    {
        $requestData = $request->only(['school_name', 'description', 'amount']);

        if($invoice = Invoice::query()->create($requestData))
        {
            return response()->success($invoice);
        }

        return response()->error("Error while saving data.");
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @param $id
     * @return void
     */
    public function show(ShowRequest $request, $id)
    {
        $invoice = Invoice::query()->find($id);
        return response()->success($invoice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param $id
     * @return void
     */
    public function update(UpdateRequest $request, $id)
    {
        $requestData = $request->only(['school_name', 'description', 'amount']);

        $invoice = Invoice::query()
            ->where('id', '=', $id)
            ->update($requestData);

        if($invoice) return response()->successMessage("Successfully updated.");

        return response()->error("Error while saving data.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param int $id
     * @return Response
     */
    public function destroy(DestroyRequest $request, $id)
    {
        $invoice = Invoice::query()
            ->where('id', '=', $id)
            ->delete();

        if($invoice) return response()->successMessage("Successfully deleted.");

        return response()->error("Error while deleting data.");
    }
}
