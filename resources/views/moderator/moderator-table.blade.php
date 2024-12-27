@extends('admin.layout.app')
@section('content')
    <div>
        <x-alert/>
        {{--        <x-loader target="none"/>--}}
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5"><span class="path1"></span>
                        <span class="path2"></span></i>
                    {{--                    <form action="" id="search_form">--}}
                    <input type="text" id="search" name="search" data-table="datatable" autocomplete="off"
                           class="form-control form-control-solid w-250px ps-12 table_search"
                           placeholder="{{__('app.panel.search_name', ['name' => str()->plural(__('admin.moderator'))])}}">
                    {{--                    </form>--}}
                </div>
                <div class="card-title">
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end">
                        <a href="{{route('admin.moderator.create')}}" class="btn btn-primary btn-sm">
                            <i class="ki-duotone ki-plus fs-2"></i> {{__('app.panel.create_name', ['name' => __('admin.moderator')])}}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <table id="datatable">
                    <thead>
                    <tr>
                        <th class="min-w-125px">Id</th>
                        <th class="min-w-125px">Profile Image</th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Email</th>
                        <th class="min-w-125px">Status</th>
                        <th class="min-w-125px">Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // if (document.querySelectorAll('#search').length) {
        //     $('#search').keyup(function () {
        //         $('#datatable').dataTable().fnDraw();
        //     });
        // }
        $(document).ready(function () {
            let table = $('#datatable').dataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: '{{ route('admin.moderator.index') }}',
                    data: function (data) {
                        data.searchData = $('#search').val();
                    },
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: 'image', name: 'image', render: function (data) {
                            if (data) {
                                return `<a href="${data}"><img src="${data}" alt="Image" style="width: 50px; height: 50px; object-fit: cover;" /></a>`;
                            }
                            // If no media is present, return a placeholder or empty text
                            return `<span>No Image</span>`;
                        }
                    },
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {
                        data: 'status', name: 'status', render: function (item) {
                            return (item === 0) ? "InActive" : "Active";
                        }
                    },
                    {data: 'action', name: 'action', searchable: false},
                ]
            });
        })


        $(document).on('click', '#delete_moderator', function (el) {
            el.preventDefault();
            $('#way_to_grave').attr('action', $(this).attr('href'));
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // AddLoader();
                    $('#way_to_grave').submit();
                }
            })
        });
    </script>
@endsection
@section('style')
    <style>
        .dataTables_filter label input {
            padding: 10px;
            border-radius: .475rem;
            background-color: var(--bs-body-bg);
            border: 1px solid var(--bs-gray-300);
        }
    </style>
@endsection

{{--return '<form action="' + editUrl + '" method="post" style="display: inline-block;" >' +--}}
{{--    '@csrf' +--}}
{{--    '<button type="submit" class="btn btn-sm btn-primary status_switch">' +--}}
{{--        '<i class="fa-solid fa-pen icon edit-icon"></i> ' +--}}
{{--        '</button>' +--}}
{{--    '</form>' +--}}
{{--'<form method="post" style="display: inline-block;" id="way_to_grave">' +--}}
{{--    '@csrf' +--}}
{{--    '@method('DELETE')' +--}}
{{--    '<button type="submit" class="btn btn-sm btn-danger status_switch" id="delete_moderator" href="' + deleteUrl + '">' +--}}
{{--        '<i class="fa-solid fa-trash icon"></i>' +--}}
{{--        '</button>' +--}}
{{--    '</form>';--}}

{{--{--}}
{{--data: 'action', name: 'action', orderable: false,--}}
{{--searchable: false, render: function (data, type, row) {--}}
{{--let editUrl = `{{ route('admin.moderator.edit', 'id') }}`.replace('id', row.id);--}}
{{--let deleteUrl = `{{ route('admin.moderator.destroy', 'id') }}`.replace('id', row.id);--}}

{{--return `<a href="${editUrl}" > ` +--}}
{{--    '<i class="fa-solid fa-pen icon edit-icon"></i> ' +--}}
{{--    `<a href="${deleteUrl}" id="delete_moderator"> ` +--}}
{{--        '<i class="fa-solid fa-trash icon"></i>';--}}
{{--        }--}}
