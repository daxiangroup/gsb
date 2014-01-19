<?php

Autoloader::namespaces(array(
    'GSB\Base' => Bundle::path('base'),
));

Autoloader::directories(array(
    Bundle::path('base'),
));