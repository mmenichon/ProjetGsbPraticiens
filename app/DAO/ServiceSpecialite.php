<?php

namespace App\DAO;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceSpecialite
{
    public function getSpecialitesPraticiens($idPraticien) {
        try {
            $lesSpecialites = DB::table('posseder')
                -> select('posseder.id_specialite', 'lib_specialite')
                -> join('specialite', 'specialite.id_specialite', '=', 'posseder.id_specialite')
                -> join('praticien', 'praticien.id_praticien', '=', 'posseder.id_praticien')
                -> where('posseder.id_praticien', '=', $idPraticien)
                -> get();
            return $lesSpecialites;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function deleteSpecialite($id_frais) {
        try {
            DB::table('posseder')
                ->where('id_frais', '=', $id_frais)
                ->delete();
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
