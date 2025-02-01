<?php

namespace Engine\Summon;

use Eases\Ease;

use Error_logic\Ease_errors;
use function Engine\Render\Render;

use function Eases\dynamic\put;
use function Eases\dynamic\delete;
use function Eases\dynamic\inculde_content;
use function Eases\dynamic\head;
use function Eases\dynamic\patch;
class Extracter {

    use Ease_errors;

    // No need to construct such a class
    private function __construct(){}

    public static function extract(&$parsed_content,&$ease,&$ease_with_space,&$line,&$lines_count,&$filename): void {
        
        $removed_spaces_from_extract_ease = trim($ease_with_space[1] ?? '');

        switch ($ease) {
            case Ease::PUT:
                self::no_args_for_reg_ease($removed_spaces_from_extract_ease,
                "err104: regular eases can't have arguments!",$line,$lines_count,$filename);

                $parsed_content[] = htmlspecialchars(put());
            break;

            case Ease::DELETE:
                self::no_args_for_reg_ease($removed_spaces_from_extract_ease,
                "err104: regular eases can't have arguments!",$line,$lines_count,$filename);

                $parsed_content[] = htmlspecialchars(delete());
            break;

            case Ease::HEAD:
                self::no_args_for_reg_ease($removed_spaces_from_extract_ease,
                "err104: regular eases can't have arguments!",$line,$lines_count,$filename);

                $parsed_content[] = htmlspecialchars(head());
            break;

            case Ease::INCLUDE:
                self::null_parm_or_argum($removed_spaces_from_extract_ease,
                "err102: null file location provided!",$line,$lines_count,$filename);

                self::no_same_file_included($filename,$removed_spaces_from_extract_ease,
                "err103: invalid include of same file!",$line,$lines_count);

                $parsed_content[] = htmlspecialchars(inculde_content($removed_spaces_from_extract_ease));
            break;

            case Ease::PATCH:
                self::no_args_for_reg_ease($removed_spaces_from_extract_ease,
                "err104: regular eases can't have arguments!",$line,$lines_count,$filename);

                $parsed_content[] = htmlspecialchars(patch());
            break;

            default:
                self::no_such_ease_error("err101: No such ease is Known!",
                $line,$lines_count,$filename);
            break;

        }
    }


}