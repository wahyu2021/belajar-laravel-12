<?php

use Illuminate\Support\Env;

return [
    "author" => [
        "first" => Env::get("NAME_FIRST", "Eko"),
        "last" => Env::get("NAME_LAST", "Khannedy"),
    ],
    "email" => "echo.khannedy@gmail.com",
    "web" => "https://www.youtube.com/ProgrammerZamanNow",
]

?>