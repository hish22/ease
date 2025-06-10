<?php

namespace Eases\Parse\Dynamic;

use function Eases\Exceptions\duplicatedInclusion;
use function Eases\Exceptions\nullParams;
use function Eases\Exceptions\wrongInclusion;

/**
 * Summary of inculde_content
 * @param mixed $content
 * @return string
 * Include content from a file.
 * The file name is passed as an argument.
 */
function inculde_content($params): string {

    // removed_spaces_from_extract_ease
    $content = $params['removed_spaces'];

    nullParams($params);
    wrongInclusion($params);
    duplicatedInclusion($params);

    $filtered = basename($content);
    return "<?php include 'storage/{$filtered}.php' ?>";
}
