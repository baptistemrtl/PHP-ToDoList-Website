<?php

class Validation{

	public static function ValidationString(string $string) : bool{
		if (filter_var($string, FILTER_SANITIZE_STRING)) {
			return true;
		}
		if (isset($string) or empty($string)) {
			return false;
		}
		return false;
	}

	public static function ValidationInt(int $entier) : bool{
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

    public static function ValidationConnexion(string $login,string $passwd){
    	global $Vueerreur;
    	if (!Validation::ValidationString($login)) {
    		$Vueerreur[]='Login mal tapé (vide ou caractères incorrects)';
    	}
    	if (!Validation::ValidationString($passwd)) {
    		$Vueerreur[]='Password mal tapé (vide ou caractères incorrects)';
    	}

    }
}
?>