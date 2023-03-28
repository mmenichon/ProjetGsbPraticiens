<?php

namespace App\Http\Controllers;

use App\DAO\ServiceSpecialite;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;

class SpecialiteController
{
    public function getListeSpecialite($idPraticien) {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceSpecialite = new ServiceSpecialite();
            $mesSpecialites = $unServiceSpecialite->getSpecialitesPraticiens($idPraticien);
            Session::put('id_praticien', $idPraticien);
            return view('vues/listeSpecialites', compact('mesSpecialites', 'monErreur'));
        }
        catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues\error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues\error', compact('monErreur'));
        }
    }

    public function getSupprSpecialite($idSpe) {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceSpecialite = new ServiceSpecialite();
            $unServiceSpecialite->deleteSpecialite($idSpe);
            $listeSpecialite = $unServiceSpecialite->getListSpecialites();

            return view('vues/listeSpecialites', compact('listeSpecialite', 'monErreur'));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues\error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues\error', compact('monErreur'));
        }
    }

}
