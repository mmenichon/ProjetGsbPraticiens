@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="col-md-5">
            <div class="blanc">
                <h1>Liste des praticiens jamais invités</h1>
            </div>

            <table class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                    <th style="width:60%">Nom</th>
                    <th style="width:60%">Prénom</th>
                </tr>

                </thead>
                @foreach($lesPraticiens as $unPraticien)
                    <tr>
                        <td> {{ $unPraticien->nom_praticien }} </td>
                        <td> {{ $unPraticien->prenom_praticien }} </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
@stop
