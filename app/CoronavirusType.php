<?php

namespace App;

enum CoronavirusType:string
{
    //
    case active = "active";
    case recovered = "recovered";
    case death = "death";
}
