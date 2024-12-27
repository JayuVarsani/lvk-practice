@extends('admin.layout.app')
@section('content')
    <div>
        <x-alert/>
        <x-loader target="none"/>
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="d-flex flex-row justify-content-between">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5"><span class="path1"></span>
                            <span class="path2"></span></i>
                        <input type="text" id="search" name="search" data-table="datatable" autocomplete="off"
                               class="form-control w-250px ps-12 table_search"
                               placeholder="{{__('app.panel.search_name', ['name' => 'Purchase Order'])}}">
                    </div>
                    <div class="mx-2">
                        <input type="text" class="form-control date_range" placeholder="Select Date Range"
                               name="date_range" id="date_range" value="">
                    </div>
                </div>
                <div>
                    <a href="{{route('admin.purchase.export')}}" class="btn btn-info btn-sm">
                        <i class="fa-solid fa-file-export"></i>
                        Export
                    </a>
                    <a href="{{route('admin.purchase.purchase-order')}}" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-x"></i>
                        Reset
                    </a>
                </div>
            </div>
            <div class="card-body pt-0">
                <table id="datatable">
                    <thead>
                    <tr>
                        <th>Order no</th>
                        <th class="max">Order Id</th>
                        <th>Priority</th>
                        <th>Priority_SO</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('input[name="date_range"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'DD/MM/YYYY',
                // cancelLabel: 'Clear',
            }
        })
            .on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                date_selected();
            })
            .on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
                date_selected();
            });
        $(document).ready(function () {
            let table = $('#datatable').dataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: '{{ route('admin.purchase.purchase-order') }}',
                    data: function (data) {
                        data.searchData = $('#search').val();
                        data.date_range = $('#date_range').val();
                    },
                },
                columns: [
                    {data: 'order_no', name: 'order_no'},
                    {data: 'order_id', name: 'order_id'},
                    {data: 'priority', name: 'priority'},
                    {data: 'priority_so', name: 'priority_so'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });
        });


        function date_selected() {
            if ($('#date_range').val() !== '') {
                $('#datatable').dataTable().api().draw();
            }
        }

    </script>
@endsection
