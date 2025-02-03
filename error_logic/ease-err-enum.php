<?php

namespace Error_logic;

enum Ease_err_enum : String {
    case ERR101 = "No such ease is Known!";
    case ERR102 = "null file location provided!";
    case ERR103 = "invalid include of same file!";
    case ERR104 = "regular eases can't have arguments!";
    case ERR105 = "No such ease file!";
    case ERR106 = "each IF ease must have an equivalent ENDIF!";
}