@extends('layouts.master')

@section('title')
    @lang('Gestion des Utilisateurs')
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            @lang('Utilisateurs')
        @endslot
        @slot('li_2')
            {{ route('manage_users.index') }}
        @endslot
        @slot('title')
            @lang('Gestion des Utilisateurs')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-4" id="action_btns">
                        <a href="{{ route('manage_users.create') }}" class="btn btn-rounded btn-success waves-effect waves-light ms-2">
                            <i class="bx bx-plus font-size-16 me-2 align-middle"></i>
                            @lang('Ajouter un Utilisateur')
                        </a>
                    </div>

                    <table id="datatable" class="table-hover table-bordered nowrap w-100 table">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>@lang('Photo')</th>
                                <th>@lang('Nom')</th>
                                <th>@lang('Email')</th>
                                <th>@lang('Rôle')</th>
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

    {{-- DataTable initialization --}}
    <script type="text/javascript">
        $(function() {
            let table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
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

                ajax: "{{ route('manage_users.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { 
                        data: 'photo', 
                        name: 'photo',
                        orderable: false,
                        searchable: false
                    },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'role' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            // Init buttons
            new $.fn.dataTable.Buttons(table, {
                buttons: [
                    {
                        extend: 'colvis',
                        text: "@lang('Afficher/Masquer colonnes')"
                    }
                ]
            });

            // Add buttons to action_btns
            table.buttons().container()
                .prependTo($('#action_btns'));

            // Select dropdown styling
            $('.dataTables_length select').addClass('form-select form-select-sm');

            // Add margin top to pagination and info
            $('.dataTables_info, .dataTables_paginate').addClass('mt-3');
        });
    </script>
@endsection
