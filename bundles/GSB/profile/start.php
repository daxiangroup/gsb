<?php

Autoloader::namespaces(array(
    'GSB\Profile' => Bundle::path('profile').'models',
    'GSB\Base' => Bundle::path('base'),
));

Autoloader::directories(array(
    Bundle::path('profile').'models',
));
