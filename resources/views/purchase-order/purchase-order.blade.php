@extends('admin.layout.app')
@section('content')
    <div>
        <x-alert/>
        {{--        <x-loader target="none"/>--}}
        <form action="" id="export_form"></form>
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
                               name="date_range" id="date_range" value="" autocomplete="off">
                    </div>
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5"><span class="path1"></span>
                            <span class="path2"></span></i>
                        <select name="search_by_status" id="search_by_status"
                                class="form-control w-250px ps-12 search_by_status" data-table="datatable" value="">
                            <option value="" class="text-muted" selected>Search Priority Status</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-info btn-sm" id="export-btn" data-table="datatable">
                        <i class="fa-solid fa-file-export"></i>
                        Export
                    </button>
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
                        <th>Priority Status</th>
                        <th>Priority SO</th>
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
        $('#search_by_status').change(function () {

        });
        $(document).on('click', '#export-btn', function (el) {
            el.preventDefault();
            const data = {
                searchData: $('#search').val(),
                date_range: $('#date_range').val(),
                search_by_status: $('#search_by_status').val(),
            };
            const queryString = $.param(data);
            const routeUrl = `{{ route('admin.purchase.export') }}?${queryString}`;
            window.location.href = routeUrl;
        });

            let searchTable = undefined;
            $('#search_by_status').change(function () {
                const table = this.dataset.table;
                if (table) {
                    if (searchTable !== undefined) {
                        clearTimeout(searchTable);
                    }
                    searchTable = setTimeout(function () {
                        $('#' + table).dataTable().api().draw();
                    }, 500);
                }
        });
        $('input[name="date_range"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'DD/MM/YYYY',
            }
        })
            .on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                $('#datatable').dataTable().api().draw();
            });

        $(document).ready(function () {
            let table = $('#datatable').dataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: '{{ route('admin.purchase.purchase-order') }}',
                    data:

                        function (data) {
                            data.searchData = $('#search').val();
                            data.date_range = $('#date_range').val();
                            data.search_by_status = $('#search_by_status').val();
                        },
                },
                columns: [
                    {data: 'order_no', name: 'order_no'},
                    {data: 'order_id', name: 'order_id'},
                    {
                        data: 'priority', name: 'priority', render: function (data) {
                            if (data == 'sync') {
                                return `<span class="bg-success rounded p-1 text-light">Completed</span>`;
                            }
                            return `<span class="bg-danger rounded p-1 text-light">Pending</span>`;
                        }
                    },
                    {data: 'priority_so', name: 'priority_so'},
                    {data: 'created_at', name: 'csearchDatareated_at'},
                ],
            });
            {{--$('#export-btn').click(function () {--}}
            {{--    $.ajax({--}}
            {{--        url: '{{ route('admin.purchase.export') }}',--}}
            {{--        data:--}}
            {{--            {--}}
            {{--                "searchData": $('#search').val(),--}}
            {{--                "date_range": $('#date_range').val(),--}}
            {{--                "search_by_status": $('#search_by_status').val(),--}}
            {{--            },--}}
            {{--    })--}}
            {{--});--}}
        });

    </script>
@endsection
