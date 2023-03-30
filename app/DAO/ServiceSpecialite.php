<?php

namespace App\DAO;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ServiceSpecialite
{
    // affiche la liste des spécialités par praticien
    public function getSpecialitesParPraticien($idPraticien) {
        try {
            $lesSpecialitesPraticiens = DB::table('posseder')
                -> select('posseder.id_specialite', 'lib_specialite')
                -> join('specialite', 'specialite.id_specialite', '=', 'posseder.id_specialite')
                -> join('praticien', 'praticien.id_praticien', '=', 'posseder.id_praticien')
                -> where('posseder.id_praticien', '=', $idPraticien)
                -> get();
            return $lesSpecialitesPraticiens;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    // affiche la liste de toutes les spécialités
    public function getSpecialites() {
        try {
            $lesSpecialites = DB::table('specialite')
                -> select('id_specialite', 'lib_specialite')
                -> get();
            return $lesSpecialites;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getDeleteSpecialite($id_spe) {
        try {
            DB::table('posseder')
                -> where('id_specialite', '=', $id_spe)
                -> where('id_praticien', Session::get('id_praticien'))
                -> delete();
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

//    public function updateSpecialite($id_specialite) {
//        try {
//            $dateJour = date("Y-m-d");
//            DB::table('frais')
//                ->where('id_frais', '=', $id_specialite)
//                ->update(['anneemois' => $anneemois, 'nbjustificatifs' => $nbjustification, 'datemodification' => $dateJour]);
//        } catch (QueryException $e) {
//            throw new MonException($e->getMessage(), 5);
//        }
//    }
//


}
