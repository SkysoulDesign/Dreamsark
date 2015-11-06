<?php

return [

    /**
     * Defaults for Settings
     */

    'settings' => [
        'language' => 'cn'
    ],

    /**
     * Defines the minimum of submission this model
     * should have to be considered not failed
     */
    'project'  => [
        'idea'    => [
            'minimum_of_submissions' => 1
        ],
        'synapse' => [
            'minimum_of_submissions' => 1
        ],
        'script'  => [
            'minimum_of_submissions' => 1
        ]
    ]
];