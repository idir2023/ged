@extends('layouts.master')

@section('title')
    @lang('Départements')
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            @lang('Départements')
        @endslot
        @slot('li_2')
            {{ route('departements.index') }}
        @endslot
        @slot('title')
            @lang('Gestion des Départements')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-4" id="action_btns">
                        <a href="{{ route('departements.create') }}" class="btn btn-rounded btn-success waves-effect waves-light ms-2">
                            <i class="bx bx-plus font-size-16 me-2 align-middle"></i>
                            @lang('Ajouter un Département')
                        </a>
                    </div>

                    <table id="datatable" class="table-hover table-bordered nowrap w-100 table">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>@lang('Nom du Département')</th>
                                <th>@lang('Actions')</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>

    <script type="text/javascript">
        $(function() {
            let table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: true,
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

                ajax: "{{ route('departements.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });
    </script>
@endsection
