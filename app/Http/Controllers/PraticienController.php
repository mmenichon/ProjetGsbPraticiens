<?php

namespace App\Http\Controllers;

use App\DAO\ServicePraticien;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;

class PraticienController
{
    public function getListePraticiens() {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServicePraticien = new ServicePraticien();
            $mesPraticiens = $unServicePraticien->getPraticiens();
            return view('vues/listePraticiens', compact('mesPraticiens', 'monErreur'));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }



}
