@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="col-md-5">
            <div class="blanc">
                <h1>Liste des activités complémentaires</h1>
            </div>

            <table class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                    <th style="width:60%">Date</th>
                    <th style="width:60%">Lieu</th>
                    <th style="width:60%">Thème</th>
                    <th style="width:60%">Motif</th>
                    <th style="width:60%">Praticiens</th>

                </tr>
                </thead>

                @foreach($mesActivites as $uneActivite)
                    <tr>
                        <td> {{ $uneActivite->date_activite }} </td>
                        <td> {{ $uneActivite->lieu_activite }} </td>
                        <td> {{ $uneActivite->theme_activite }} </td>
                        <td> {{ $uneActivite->motif_activite }} </td>

                        <td style="text-align:center">
                            <a href="{{ url('/activitesPraticien') }}/{{ $uneActivite->id_activite_compl }}">
                                <span class="glyphicon glyphicon-list" data-toggle="tooltip" data-placement="top" title="Spécialités"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
@stop
