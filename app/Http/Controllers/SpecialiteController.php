<?php

namespace App\Http\Controllers;

use App\DAO\ServiceSpecialite;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;

class SpecialiteController
{
    public function listeSpecialitesParPraticien($idPraticien) {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceSpecialite = new ServiceSpecialite();
            $mesSpecialites = $unServiceSpecialite->getSpecialitesParPraticien($idPraticien);
            $lesSpecialites = $unServiceSpecialite->getSpecialites();
            // récupération de l'ID du praticien
            Session::put('id_praticien', $idPraticien);
            return view('vues/listeSpecialites', compact('mesSpecialites', 'lesSpecialites', 'monErreur'));
        }
        catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

    public function deleteSpecialite($idSpe) {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceSpecialite = new ServiceSpecialite();
            $unServiceSpecialite->getDeleteSpecialite($idSpe);
            $mesSpecialites = $unServiceSpecialite->getSpecialitesParPraticien(Session::get('id_praticien'));

            return view('vues/listeSpecialites', compact('mesSpecialites', 'monErreur'));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

    public function addSpecialite($idSpecialite) {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceSpecialite = new ServiceSpecialite();
            $idPraticien = Session::get('id_praticien');
            $unServiceSpecialite->getAddSpecialite($idPraticien, $idSpecialite);
            return view('vues/');
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues\error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues\error', compact('monErreur'));
        }
    }

}
