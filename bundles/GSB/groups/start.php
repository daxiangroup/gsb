<?php

Autoloader::namespaces(array(
    'GSB\Groups' => Bundle::path('groups').'models',
    'GSB\Base' => Bundle::path('base'),
));

Autoloader::directories(array(
    Bundle::path('groups').'models',
));
