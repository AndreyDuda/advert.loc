<?php

return [
    'host'    => explode(',', env('ELASTICSEARCH_HOST')),
    'retries' => 1
];
