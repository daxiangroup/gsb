<?php

Autoloader::namespaces(array(
    'GSB\Dashboard' => Bundle::path('dashboard').'models',
));

Autoloader::directories(array(
    Bundle::path('dashboard').'models',
));
