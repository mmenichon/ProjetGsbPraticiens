<?php

namespace App\Http\Controllers;

use App\DAO\ServiceActivity;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;

class ActivityController
{
    public function listeActivitesCompl() {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceActivity = new ServiceActivity();
            $mesActivites = $unServiceActivity->listeActivitesCompl();

            return view('vues/listeActivitesCompl', compact('mesActivites', 'monErreur'));
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

    public function getListePraticienParActivites($idActivite) {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceActivity = new ServiceActivity();
            $mesPraticiens = $unServiceActivity->praticiensParActivites($idActivite);
            Session::put('id_activite_compl', $idActivite);

            return view('vues/listePraticienParActivites', compact('mesPraticiens', 'monErreur'));
        }
        catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

    public function listePraticiensJamaisInvites() {
        try {
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceActivity = new ServiceActivity();
            $lesPraticiens = $unServiceActivity->praticienJamaisInvites();

            return view('vues/listePraticiensJamaisInvites', compact('lesPraticiens', 'monErreur'));

        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }
}
