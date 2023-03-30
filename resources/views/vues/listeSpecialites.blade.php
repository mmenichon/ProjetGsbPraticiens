@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="col-md-5">
            <div class="blanc">
                <h1>Liste des praticiens</h1>
            </div>

            <table class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                    <th style="width:60%">Libelle</th>
                    <th style="width:20%">Modifier</th>
                    <th style="width:20%">Supprimer</th>
                </tr>

                </thead>
                @foreach($mesSpecialites as $uneSpecialite)
                    <tr>
                        <td> {{ $uneSpecialite->lib_specialite }} </td>

                        <td style="text-align:center">
                            <a href="{{ url('/updateSpecialite') }}/{{ $uneSpecialite->id_specialite }}">
                                <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span>
                            </a>
                        </td>

                        <td style="text-align:center">
                            <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                               onclick="javascript:if (confirm('Voulez-vous vraiment supprimer ?'))
                               { window.location = '{{ url('/deleteSpecialite') }}/{{ $uneSpecialite->id_specialite }}' }">
                            </a>
                        </td>

                    </tr>
                @endforeach
            </table>

        </div>
    </div>
@stop
