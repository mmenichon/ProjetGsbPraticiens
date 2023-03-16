<?php

namespace App\Http\Controllers;

use App\DAO\ServiceSpecialite;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;

class SpecialiteController
{
    public function getListeSpecialite() {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceSpecialite = new ServiceSpecialite();
            $id_visiteur = Session::get('id');
            $mesSpecialites = $unServiceSpecialite->getSpecialites();
            return view('vues/listeFrais', compact('mesSpecialites', 'monErreur'));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues\error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues\error', compact('monErreur'));
        }
    }


}
