<?php

Autoloader::namespaces(array(
    'GSB\Login' => Bundle::path('login').'models',
    'GSB\Profile' => Bundle::path('profile').'models',
));

Autoloader::directories(array(
    Bundle::path('login').'models',
));
