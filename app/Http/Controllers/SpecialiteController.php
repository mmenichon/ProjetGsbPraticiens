<?php

namespace App\Http\Controllers;

use App\DAO\ServiceSpecialite;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class SpecialiteController
{
    public function listeSpecialitesParPraticien($idPraticien) {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceSpecialite = new ServiceSpecialite();
            $mesSpecialites = $unServiceSpecialite->getSpecialitesParPraticien($idPraticien);
            // appel de la liste de toutes les spécialités
            $lesSpecialites = $unServiceSpecialite->getSpecialites($idPraticien);
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

            $lesSpecialites = $unServiceSpecialite->getAllSpecialites();
            return view('vues/listeSpecialites', compact('mesSpecialites', 'lesSpecialites', 'monErreur'));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }


    public function postAddSpecialite() {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $idPraticien = Session::get('id_praticien');
            $idSpecialite = Request::input('idSpecialite');
            $unServiceSpecialite = new ServiceSpecialite();
            $unServiceSpecialite->getAddSpecialite($idPraticien, $idSpecialite);

            $mesSpecialites = $unServiceSpecialite->getSpecialitesParPraticien($idPraticien);
            $lesSpecialites = $unServiceSpecialite->getAllSpecialites();
            return view('vues/listeSpecialites', compact('mesSpecialites', 'lesSpecialites', 'monErreur'));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues\error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues\error', compact('monErreur'));
        }
    }

}
