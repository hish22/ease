<?php

namespace Engine\Summon;


use Eases\Ease;
use Eases\conditional;

use Error_logic\Block_err\Ease_block_err;
use Error_logic\Ease_err_enum;
use Error_logic\Ease_errors;
use Error_logic\EaseErrorsHandler;
use Error_logic\Line_err\Ease_line_err;

use function Eases\conditional\end_ease_if;
use function Engine\Render\Render;

use function Eases\dynamic\put;
use function Eases\dynamic\delete;
use function Eases\dynamic\inculde_content;
use function Eases\dynamic\head;
use function Eases\dynamic\patch;
use function Eases\conditional\if_ease_cond;
use function Eases\dynamic\_print;

class Extracter {

    use Ease_line_err;

    // No need to construct such a class
    private function __construct(){}

    public static function extract(&$parsed_content,&$ease,&$ease_with_space,&$line,&$lines_count,&$c_line_count,&$filename): void {
        $removed_spaces_from_extract_ease = trim($ease_with_space[1] ?? '');

        // self::init_block_check();

        switch ($ease) {
            case Ease::PUT:
               $err = new EaseErrorsHandler(
                    Ease_err_enum::ERR104->value,
                    $filename,
                    Ease_err_enum::ERR104->name,
                    $line,
                    $lines_count);
                    $err->no_args_for_reg_ease($removed_spaces_from_extract_ease);

                $parsed_content[] = htmlspecialchars(put());
            break;
    
            case Ease::DELETE:
                $err = new EaseErrorsHandler(
                    Ease_err_enum::ERR104->value,
                    $filename,
                    Ease_err_enum::ERR104->name,
                    $line,
                    $lines_count);
                    $err->no_args_for_reg_ease($removed_spaces_from_extract_ease);

                $parsed_content[] = htmlspecialchars(delete());
            break;

            case Ease::HEAD:
                $err = new EaseErrorsHandler(
                    Ease_err_enum::ERR104->value,
                    $filename
                    ,Ease_err_enum::ERR104->name,
                    $line,
                    $lines_count);
                    $err->no_args_for_reg_ease($removed_spaces_from_extract_ease);

                $parsed_content[] = htmlspecialchars(head());
            break;

            case Ease::INCLUDE:

                $err = new EaseErrorsHandler(Ease_err_enum::ERR102->value,
                $filename,
                Ease_err_enum::ERR102->name,
                $line,
                $lines_count);
                $err->null_parm_or_argum($removed_spaces_from_extract_ease);

                $err = new EaseErrorsHandler(Ease_err_enum::ERR103->value,
                $filename,
                Ease_err_enum::ERR103->name,
                $line,
                $lines_count);
                $err->no_same_file_included($removed_spaces_from_extract_ease);

                $err = new EaseErrorsHandler(Ease_err_enum::ERR105->value,
                $filename,
                Ease_err_enum::ERR105->name,
                $line,
                $lines_count);
                $err->no_such_ease_file($removed_spaces_from_extract_ease);

                $parsed_content[] = htmlspecialchars(inculde_content($removed_spaces_from_extract_ease));
            break;

            case Ease::PATCH:
                $err = new EaseErrorsHandler(Ease_err_enum::ERR104->value,
                $filename,
                Ease_err_enum::ERR104->name,
                $line,
                $lines_count);
                $err->no_args_for_reg_ease($removed_spaces_from_extract_ease);

                $parsed_content[] = htmlspecialchars(patch());
            break;

            case Ease::IF:
                $err = new EaseErrorsHandler(Ease_err_enum::ERR108->value,
                $filename,
                Ease_err_enum::ERR108->name,
                $line,
                $lines_count);
                $err->null_parm_or_argum_inc_pran($line);

                // self::cond_ease_error(Ease_err_enum::ERR106->value,
                // $line,
                // $filename,
                // Ease_err_enum::ERR106->name)->no_ease_endif_included($c_line_count);

                $parsed_content[] = htmlspecialchars(if_ease_cond($line));

            break;

            case Ease::ENDIF:

                $err = new EaseErrorsHandler(
                    Ease_err_enum::ERR104->value,
                    $filename
                    ,Ease_err_enum::ERR104->name,
                    $line,
                    $lines_count);
                    $err->no_args_for_reg_ease($removed_spaces_from_extract_ease);

                    // self::cond_ease_error(Ease_err_enum::ERR107->value,
                    // $line,
                    // $filename,
                    // Ease_err_enum::ERR107->name)->no_ease_endif_included($c_line_count);

                $parsed_content[] = htmlspecialchars(end_ease_if());
            break;

            case Ease::PRINT:
                $parsed_content[] = htmlspecialchars(_print($line));
            break;

            default:
            $err = new EaseErrorsHandler(Ease_err_enum::ERR101->value,
            $filename,Ease_err_enum::ERR101->name,$line,$lines_count);
                $err->throwErr();
            break;

        }

        // self::bucketCheck($lines_count);

    }


}