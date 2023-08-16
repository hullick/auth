<?php

namespace Tests\StaticData\Http\Controllers\Security;

use Tests\StaticData\RequestData;

class IncorrectUserRegisterRequestData
{
    use RequestData;

    public $name = "Fulanadetal";
    public $email = "fulana.de.tal";
    public $password = "!MeuExemplo";
    public $password_confirmation = "!MeuExempl1";
}