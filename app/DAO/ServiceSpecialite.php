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
    public function getSpecialites($idSpecialite) {
        try {
            $id_praticien = Session::get('id_praticien');
            $lesSpecialites = DB::table('specialite')
                -> whereNotExists(function ($query) use ($id_praticien) {
                    $query
                        -> select(DB::raw(1))
                        -> from('posseder')
                        -> whereRaw('specialite.id_specialite = posseder.id_specialite')
                        -> where('posseder.id_specialite', '=', $id_praticien);
                })
                -> get();
            Session::put('id_specialite', $idSpecialite);
            return $lesSpecialites;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getAllSpecialites() {
        try {
            $allSpecialites = DB::table('specialite')
                -> select()
                -> get();
            return $allSpecialites;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getDeleteSpecialite($idSpecialite) {
        try {
            DB::table('posseder')
                -> where('id_specialite', '=', $idSpecialite)
                -> where('id_praticien', Session::get('id_praticien'))
                -> delete();
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getAddSpecialite($idPraticien, $idSpecialite) {
        try {
            DB::table('posseder')
                -> insert(['id_praticien' => $idPraticien,
                    'id_specialite' => $idSpecialite,
                    'diplome' => 'test',
                    'coef_prescription' => 8.7]);
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

}
