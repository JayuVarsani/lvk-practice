<?php

namespace App\Http\Controllers;

use App\Exports\PurchaseOrderExport;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;
use Yajra\DataTables\DataTables;


class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
//        dd($request->searchData);

        if ($request->ajax()) {
//            dd($this->dataSource($request)->get());
            return DataTables::of($this->dataSource($request))->make(true);
        }
        return view('purchase-order.purchase-order', ['title' => 'Purchase Order']);
    }

    public function export(Request $request)
    {
//        dd($request->searchData, $request->date_range, $request->search_by_status,($this->dataSource($request))->get());
        $data_to_export = ($this->dataSource($request)->get());
        return Excel::download(new PurchaseOrderExport(
            data: $data_to_export
        ), 'purchase_order.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function dataSource($request)
    {
        $search = $request->searchData;
        $date_range = $request->date_range;
        $search_by_status = $request->search_by_status;

        return PurchaseOrder::when(isset($search), function (Builder $query) use ($search) {
            $query->where('order_no', 'like', "%{$search}%")
                ->orWhere('order_id', 'like', "%{$search}%")
                ->orWhere('priority_so', 'like', "%{$search}%");
        })
            ->when(isset($date_range), function (Builder $query) use ($date_range) {
                $date = explode(" - ", $date_range);
                $startAt = Carbon::createFromFormat('d/m/Y H:i:s', $date[0] . ' 00:00:00');
                $endAt = Carbon::createFromFormat('d/m/Y H:i:s', $date[1] . ' 23:59:59');
                $query->whereBetween('created_at', [$startAt, $endAt]);
            })
            ->when(isset($search_by_status), function (Builder $query) use ($search_by_status) {
                if ($search_by_status == "completed") {
                    $value = 'sync';
                }
                if ($search_by_status == "pending") {
                    $value = 'not sync';
                }
                $query->where('priority', 'like', "$value");
            })
            ->latest('order_id');

    }
}
//return PurchaseOrder::when($request->input('searchData') || $request->searchData, function (Builder $query, $searchData) {
//    $query->where('order_no', 'like', "%{$searchData}%")
//        ->orWhere('order_id', 'like', "%{$searchData}%")
//        ->orWhere('priority_so', 'like', "%{$searchData}%");
//})
//    ->when($request->input('date_range') || $request->date_range, function (Builder $query, $date_range) {
//        $date = explode(" - ", $date_range);
//        $startAt = Carbon::createFromFormat('d/m/Y H:i:s', $date[0] . ' 00:00:00');
//        $endAt = Carbon::createFromFormat('d/m/Y H:i:s', $date[1] . ' 23:59:59');
//        $query->whereBetween('created_at', [$startAt, $endAt]);
//    })
//    ->when($request->input('search_by_status') || $request->search_by_status, function (Builder $query, $search_by_status) {
//        $arr_mapping = [
//            'complete' => 'sync',
//            'completed' => 'sync',
//            'pending' => 'not sync'
//        ];
//        if (array_key_exists(strtolower($search_by_status), $arr_mapping)) {
//            $query->where('priority', 'like', "{$arr_mapping[strtolower($search_by_status)]}%");
//        }
//    })
//    ->latest('order_id');

////////////////////////////////////////////////////////////////////////////////////////////////////
