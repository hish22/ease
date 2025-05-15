<?php

namespace Eases;

enum Ease : String {
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
    case INCLUDE = 'INCLUDE';
    case HEAD = "HEAD";
    case PATCH = "PATCH";
    case IF = "IF";
    case ELSEIF = "ELSEIF";
    case ENDIF = "ENDIF";
    case PRINT = "PRINT";
    case LOOP = "LOOP";
    case ENDLOOP = "ENDLOOP";

}