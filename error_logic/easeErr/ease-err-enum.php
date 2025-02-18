<?php

namespace Error_logic;

enum Ease_err_enum : String {
    case ERR101 = "No such ease is Known!";
    case ERR102 = "regular eases can't have arguments!";
    case ERR103 = "each IF ease must have an equivalent ENDIF!";
    case ERR104 = "each ENDIF ease must have an equivalent IF!";
    case ERR105 = "Wrong condition statment provided!";
    case ERR106 = "null argument value provided!";
    case ERR107 = "Can't print empty parentheses";
    case ERR201 = "null file location provided!";
    case ERR202 = "No such ease file!";
    case ERR203 = "invalid include of same file!";
}