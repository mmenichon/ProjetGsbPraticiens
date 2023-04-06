@extends('layouts.master')
@section('content')
    {!! Form::open(['url' => 'addSpecialite']) !!}
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
                               onclick="if (confirm('Voulez-vous vraiment supprimer ?'))
                               { window.location = '{{ url('/deleteSpecialite') }}/{{ $uneSpecialite->id_specialite }}' }">
                            </a>
                        </td>

                    </tr>
                @endforeach
            </table>

            <div class="col-md-10">
                <select class="form-control" name="cbGenres" required>
                    <option value="0">Sélectionner une spécialité</option>
                    @foreach ($lesSpecialites as $laSpecialite)
                        <option value="{{ $laSpecialite->id_specialite }}">{{ $laSpecialite->lib_specialite }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Valider</button>
                </div>
            </div>

        </div>
    </div>
@stop
