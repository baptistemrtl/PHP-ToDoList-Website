<?php

class Validation{

	public static function ValidationString(string $string) : bool{
		$string = Nettoyage::NettoyageString($string);
		if (isset($string) or empty($string)) {
			return false;
		}
		if (filter_var($string, FILTER_SANITIZE_STRING)) {
			return true;
		}
		return false;
	}

	public static function ValidationEmail(string $email) : bool{
		$email = Nettoyage::NettoyageEmail($email);
		if (isset($email) or empty($email)) {
			return false;
		}
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}

	public statis function ValidationInt(int $entier) : bool{
		$entier = Nettoyage::NettoyageInt($entier);
		if (isset($entier) or empty(entier)) {
			return false;
		}
		if (filter_var($entier, FILTER_VALIDATE_INT)) {
			return true;
		}
		return false;
	}

	public static function ValidationBoolean(bool $boolean): bool
    {
        if (!isset($boolean) or empty($boolean))
            return false;
        if (filter_var($boolean, FILTER_VALIDATE_BOOLEAN)) {
            return true;
        }
        return false;
    }

    public static function ValidationConnexion(string login,string passwd) : bool{
    	if (!ValidationString($login)) {
    		$Vueerreur[]='Login mal tapé (vide ou caractères incorrects)'
    	}
    	if (!ValidationString($passwd)) {
    		$Vueerreur[]='Password mal tapé (vide ou caractères incorrects)'
    	}
    	return $Vueerreur;

    }
}
?>