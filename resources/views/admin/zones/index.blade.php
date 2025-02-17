@extends('layouts.master')

@section('title')
    @lang('Zones')
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            @lang('Zones')
        @endslot
        @slot('li_2')
            {{ route('zones.index') }}
        @endslot
        @slot('title')
            @lang('Gestion des Zones')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-4" id="action_btns">
                        <a href="{{ route('zones.create') }}" class="btn btn-rounded btn-success waves-effect waves-light ms-2">
                            <i class="bx bx-plus font-size-16 me-2 align-middle"></i>
                            @lang('Ajouter une Zone')
                        </a>
                    </div>

                    <table id="datatable" class="table table-hover table-bordered nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>@lang('Nom de la Zone')</th>
                                <th>@lang('Latitude')</th>
                                <th>@lang('Longitude')</th>
                                <th>@lang('Ville')</th>
                                <th>@lang('Pays')</th>
                                <th>@lang('Chef de Zone')</th>
                                <th>@lang('Actions')</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            let table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: true,
                lengthMenu: [10, 20, 50, 100],
                pageLength: 10,
                scrollX: true,
                order: [[0, "desc"]],
                language: {
                    search: "@lang('Rechercher')",
                    lengthMenu: "@lang('Afficher') _MENU_ @lang('entrées')",
                    processing: "@lang('Traitement en cours...')",
                    info: "@lang('Affichage de') _START_ @lang('à') _END_ @lang('sur') _TOTAL_ @lang('entrées')",
                    emptyTable: "@lang('Aucune donnée disponible')",
                    paginate: {
                        first: "@lang('Premier')",
                        last: "@lang('Dernier')",
                        next: "@lang('Suivant')",
                        previous: "@lang('Précédent')"
                    },
                },
                ajax: {
                    url: "{{ route('zones.index') }}",
                    type: "GET",
                    error: function(xhr, error, thrown) {
                        console.log(xhr.responseText);
                    }
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nom', name: 'nom' },
                    { data: 'latitude', name: 'latitude' },
                    { data: 'longitude', name: 'longitude' },
                    { data: 'city', name: 'city' },
                    { data: 'country', name: 'country' },
                    { data: 'chef_zone', name: 'chef_zone', orderable: false, searchable: false },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            new $.fn.dataTable.Buttons(table, {
                buttons: [
                    {
                        extend: 'colvis',
                        text: "@lang('Afficher/Masquer colonnes')"
                    }
                ]
            });

            table.buttons().container()
                .prependTo($('#action_btns'));

            $('.dataTables_length select').addClass('form-select form-select-sm');
            $('.dataTables_info, .dataTables_paginate').addClass('mt-3');
        });
    </script>
@endsection
