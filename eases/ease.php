<?php

namespace Eases;

enum Ease : String {
    case PUT = 'PUT';
    case DELETE = 'DELETE';
    case INCLUDE = 'INCLUDE';
    case HEAD = "HEAD";
    case PATCH = "PATCH";

}