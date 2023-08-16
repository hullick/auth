<?php

namespace Tests\StaticData\Http\Controllers\Security;

use Tests\StaticData\RequestData;

class IncorrectUserAuthenticateRequestData
{
    use RequestData;

    public $email = "fulana.de.tal";
    public $password = "!MeuExemplo";
}