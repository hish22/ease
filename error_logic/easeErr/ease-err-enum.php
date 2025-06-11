<?php

namespace Error_logic;

enum Ease_err_enum : String {
    case ERR101 = "No such ease is Known";
    case ERR102 = "Regular eases can't have arguments";
    case ERR103 = "Each conditional/iterative ease must have an equivalent closing ease";
    case ERR104 = "Each closing ease must have an equivalent start ease";
    case ERR105 = "Wrong condition statment provided";
    case ERR106 = "Null argument value provided";
    case ERR107 = "No parentheses have been provided";
    case ERR108 = "Each ELSEIF ease must have an equivalent IF";
    case ERR201 = "Empty arguments provided";
    case ERR202 = "No such ease file";
    case ERR203 = "Invalid include of same file";
    case ERR301 = "Block Error found";
}