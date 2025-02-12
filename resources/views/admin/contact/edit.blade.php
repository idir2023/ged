@extends('layouts.master')

@section('title')
    Modifier un Contact
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            contact
        @endslot
        @slot('li_2')
            {{ route('contact.index') }}
        @endslot
        @slot('title')
            Modifier un Contact
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.update', $contact->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <label for="nom" class="col-sm-3 col-form-label">Nom</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $contact->nom) }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="tele" class="col-sm-3 col-form-label">Téléphone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tele" name="tele" value="{{ old('tele', $contact->tele) }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $contact->email) }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="description" name="description" required>{{ old('description', $contact->description) }}</textarea>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
