<?php

namespace Error_logic\SystemErr;

enum Sys_err_enum : string {

    case ERR501 = "Configuration mismatch, full parsing must be configured as a ParsedType!";
    case ERR502 = "Configuration mismatch, single parsing must be configured as a ParsedType!";
    case ERR503 = "Configuration mismatch, partial parsing must be configured as a ParsedType!";

}