<?php

namespace App\DAO;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceSpecialite
{
    public function getSpecialites() {
        try {
            $lesSpecialites = DB::table('specialite')
                -> select('id_specialite', 'lib_specialite')
//                -> join('posseder', 'praticien.id_praticien', '=', 'posseder.id_praticien')
//                -> join('specialite', 'posseder.id_specialite', '=', 'specialite.id_specialite')
//                -> orderBy('nom_praticien')
                -> get();
            return $lesSpecialites;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }



    public function updateSpecialite($id_specialite) {
        try {
            $dateJour = date("Y-m-d");
            DB::table('frais')
                ->where('id_frais', '=', $id_specialite)
                ->update(['anneemois' => $anneemois, 'nbjustificatifs' => $nbjustification, 'datemodification' => $dateJour]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function deleteSpecialite($id_frais) {
        try {
            DB::table('fraishorsforfait')->where('id_frais', '=', $id_frais)->delete();
            DB::table('frais')->where('id_frais', '=', $id_frais)->delete();
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

}
