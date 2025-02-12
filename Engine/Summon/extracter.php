<?php

namespace Engine\Summon;


use Eases\Ease;
use Eases\conditional;

use Error_logic\Ease_err_enum;
use Error_logic\EaseErrorsHandler;
use Error_logic\Line_err\Ease_line_err;

use function Eases\conditional\end_ease_if;

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
    /**
     * Extracts and processes a specified ease from the knowledge base and returns the corresponding PHP or HTML output.
     * 
     * This function handles various types of eases, such as PUT, DELETE, HEAD, INCLUDE, PATCH, IF, ENDIF, PRINT, and more. 
     * It also performs error handling by checking the ease syntax and validity before processing.
     * 
     * - The $ease parameter is passed and converted into the corresponding (Ease::Type) version.
     * - For each ease type, the function validates the parameters and generates the appropriate PHP/HTML code.
     * - Error handling is applied for missing arguments or invalid configurations.
     * 
     * @param Ease $ease The ease type used to extract the matched content.
     * @param array $ease_with_space The ease expression with spaces split.
     * @param string $line The current line being processed.
     * @param int $lines_count The total number of lines in the file.
     * @param string $filename The name of the file being processed.
     * 
     * @return string The generated PHP or HTML code corresponding to the specified ease.
     */
    public static function extract(Ease $ease,array &$ease_with_space,string $line,int $lines_count,string $filename): string {
        $removed_spaces_from_extract_ease = trim($ease_with_space[1] ?? '');

        switch ($ease) {
            case Ease::PUT:
               $err = new EaseErrorsHandler(
                    Ease_err_enum::ERR104->value,
                    $filename,
                    Ease_err_enum::ERR104->name,
                    $line,
                    $lines_count);
                    $err->no_args_for_reg_ease($removed_spaces_from_extract_ease);

                return htmlspecialchars(put());
            break;
    
            case Ease::DELETE:
                $err = new EaseErrorsHandler(
                    Ease_err_enum::ERR104->value,
                    $filename,
                    Ease_err_enum::ERR104->name,
                    $line,
                    $lines_count);
                    $err->no_args_for_reg_ease($removed_spaces_from_extract_ease);

                return htmlspecialchars(delete());
            break;

            case Ease::HEAD:
                $err = new EaseErrorsHandler(
                    Ease_err_enum::ERR104->value,
                    $filename
                    ,Ease_err_enum::ERR104->name,
                    $line,
                    $lines_count);
                    $err->no_args_for_reg_ease($removed_spaces_from_extract_ease);

                return htmlspecialchars(head());
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

                return htmlspecialchars(inculde_content($removed_spaces_from_extract_ease));
            break;

            case Ease::PATCH:
                $err = new EaseErrorsHandler(Ease_err_enum::ERR104->value,
                $filename,
                Ease_err_enum::ERR104->name,
                $line,
                $lines_count);
                $err->no_args_for_reg_ease($removed_spaces_from_extract_ease);

                return htmlspecialchars(patch());
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

                return htmlspecialchars(if_ease_cond($line));

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

                return htmlspecialchars(end_ease_if());
            break;

            case Ease::PRINT:
                return htmlspecialchars(_print($line));
            break;

            default:
            $err = new EaseErrorsHandler(Ease_err_enum::ERR101->value,
            $filename,Ease_err_enum::ERR101->name,$line,$lines_count);
                $err->throwErr();
                return '';
            break;

        }

    }


}