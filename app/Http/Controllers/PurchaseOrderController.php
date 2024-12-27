<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            \Log::info($request->input('search'));
            $purchase_order = PurchaseOrder::when($request->input('searchData'), function (Builder $query, $searchData) {
                return $query->where('order_no', 'like', "%{$searchData}%")
                    ->orWhere('order_id', 'like', "%{$searchData}%")
                    ->orWhere('priority', 'like', "{$searchData}%")
                    ->orWhere('priority_so', 'like', "%{$searchData}%");
            })
                ->when($request->input('date_range') , function (Builder $query, $date_range) {
                    $date=explode(" - ", $date_range);
                    $startAt = Carbon::createFromFormat('d/m/Y H:i:s', $date[0]. ' 00:00:00');
                    $endAt = Carbon::createFromFormat('d/m/Y H:i:s', $date[1]. ' 23:59:59');
                    return $query->whereBetween('created_at', [$startAt, $endAt]);
                })
                ->latest('order_id');
            return DataTables::of($purchase_order)->make(true);
        }
        return view('purchase-order.purchase-order', ['title' => 'Purchase Order']);
    }

    public function export()
    {

    }
}
