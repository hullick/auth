<?php

namespace Mkoders\Auth\Tests\StaticData\Http\Controllers\Security;

use Tests\StaticData\RequestData;

class CorrectUserAuthenticateRequestData
{
    use RequestData;

    public $email = "fulana.de.tal@meuemail.com";
    public $password = "!MeuExempl1";
}