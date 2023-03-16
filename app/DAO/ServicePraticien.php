<?php

namespace App\DAO;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServicePraticien
{
    public function getPraticiens() {
        try {
            $lesPraticiens = DB::table('praticien')
                -> select('id_praticien', 'nom_praticien', 'prenom_praticien')
                -> orderBy('nom_praticien')
                -> get();
            return $lesPraticiens;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
}
