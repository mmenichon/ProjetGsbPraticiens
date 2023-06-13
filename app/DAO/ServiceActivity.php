<?php

namespace App\DAO;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ServiceActivity
{
    public function listeActivitesCompl() {
        try {
            $lesActivitesCompl = DB::table('activite_compl')
                -> select('id_activite_compl', 'date_activite', 'lieu_activite', 'theme_activite', 'motif_activite')
                -> get();
            return $lesActivitesCompl;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function praticiensParActivites($uneActivite) {
        try {
            $lesActivitesPraticiens = DB::table('inviter')
                -> select('inviter.id_activite_compl', 'inviter.id_praticien', 'nom_praticien', 'prenom_praticien')
                -> join('activite_compl', 'activite_compl.id_activite_compl', '=', 'inviter.id_activite_compl')
                -> join('praticien', 'praticien.id_praticien', '=', 'inviter.id_praticien')
                -> where('inviter.id_activite_compl', '=', $uneActivite)
                -> get();
            return $lesActivitesPraticiens;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function praticienJamaisInvites() {
        try {
            $idActivite = Session::get('id_activite_compl');
            $lesPraticien = DB::table('praticien')
                -> whereNotExists(function ($query) use ($idActivite) {
                    $query
                        -> select(DB::raw(1))
                        -> from('inviter')
                        -> whereRaw('praticien.id_praticien = inviter.id_praticien')
                        -> where('inviter.id_activite_compl', '=', $idActivite);
                })
                -> get();

            return $lesPraticien;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

}
