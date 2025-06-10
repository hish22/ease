<?php

namespace Eases\Parse\Raw;
/**
 * Return of an opening and closing PHP tags
 * @param mixed $script
 * @return string
 */
function rawPHP($script) {

    $neatScript = extract_from_braces($script);

    return "<?php $neatScript ?>";
}