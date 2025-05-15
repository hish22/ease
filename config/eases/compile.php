<?php

return [
    'eases' => [
        Eases\Ease::GET->name => 'Eases\Parse\Dynamic\get',
        Eases\Ease::POST->name => 'Eases\Parse\Dynamic\post',
        Eases\Ease::PUT->name => 'Eases\Parse\Dynamic\put',
        Eases\Ease::DELETE->name => 'Eases\Parse\Dynamic\delete',
        Eases\Ease::HEAD->name => 'Eases\Parse\Dynamic\head',
        Eases\Ease::PATCH->name => 'Eases\Parse\Dynamic\patch',
        Eases\Ease::INCLUDE->name => 'Eases\Parse\Dynamic\inculde_content',
        Eases\Ease::PRINT->name => 'Eases\Parse\Dynamic\_print',
        Eases\Ease::IF->name => 'Eases\Parse\Control\if_ease_cond',
        Eases\Ease::ELSEIF->name => 'Eases\Parse\Control\else_if_ease_cond',
        Eases\Ease::ENDIF->name => 'Eases\Parse\Control\end_ease_if',
        Eases\Ease::LOOP->name => 'Eases\Parse\Control\loop_ease',
        Eases\Ease::ENDLOOP->name => 'Eases\Parse\Control\end_loop_ease',
        Eases\Ease::FILTER->name => 'Eases\Parse\Control\filter_logic',
        Eases\Ease::ENDFILTER->name => 'Eases\Parse\Control\end_filter_logic',
        
    ]
];