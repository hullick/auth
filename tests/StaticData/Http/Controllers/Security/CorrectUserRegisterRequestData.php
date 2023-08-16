<?php

namespace Tests\StaticData\Http\Controllers\Security;

use Tests\StaticData\RequestData;

class CorrectUserRegisterRequestData
{
    use RequestData;

    public $name = "Fulana de tal";
    public $email = "fulana.de.tal@meuemail.com";
    public $password = "!MeuExempl1";
    public $password_confirmation = "!MeuExempl1";
}