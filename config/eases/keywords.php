<?php

return [
    'control' => [
        'start' => [
            Eases\Ease::IF->name,
            Eases\Ease::LOOP->name,
            Eases\Ease::FILTER->name
        ],
        'mid' => [
            Eases\Ease::ELSEIF->name
        ],
        'end' => [
            Eases\Ease::ENDIF->name,
            Eases\Ease::ENDLOOP->name,
            Eases\Ease::ENDFILTER->name
        ]
    ],
    'dynamic' => [
        Eases\Ease::HEAD->name,
        Eases\Ease::DELETE->name,
        Eases\Ease::INCLUDE->name,
        Eases\Ease::PATCH->name,
        Eases\Ease::PUT->name,
        Eases\Ease::PRINT->name
    ]
];