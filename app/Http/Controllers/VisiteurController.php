<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use App\DAO\ServiceVisiteur;
use App\Metier\Visiteur;


class VisiteurController extends Controller
{
    /**
     * Initialise le formulaire d'authentification
     * @return type vue formLogin
     */
    public function getLogin() {
        try {
            $erreur = "";
            return view('vues/formLogin', compact('erreur'));
        } catch (MonException $e){
            $monErreur = $e->getMessage();
            return view('vues\formLogin', compact('erreur'));
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues\formLogin', compact('erreur'));
        }
    }

    /**
     * Authentifie le visiteur
     * @return type vue formLogin
     */
    public function signIn() {
        try {
            $login = Request::input('login');
            $pwd = Request::input('pwd');
            $unVisiteur = new ServiceVisiteur();
            $connected = $unVisiteur->login($login, $pwd);

            if ($connected) {
                if (Session::get('type') === 'P') {
                    return view('vues/homePraticien');
                } else {
                    return view('home');
                }
            } else {
                $erreur = "Login ou mot de passe inconnu";
                return view('vues/formLogin', compact('erreur'));
            }
        } catch (Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/formLogin', compact('erreur'));
        }
    }

    /**
     * Déconnecte le visiteur authentifié (p.10)
     * @return type vue home
     */
    public function signOut() {
        $unVisiteur = new ServiceVisiteur();
        $unVisiteur->logout();
        return view('home');
    }

}
