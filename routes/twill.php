<?php

use A17\Twill\Facades\TwillRoutes;

// Register Twill routes here eg.
// TwillRoutes::module('posts');

TwillRoutes::singleton('home');
TwillRoutes::singleton('navigation');
TwillRoutes::module('navigations');
TwillRoutes::module('pages');
TwillRoutes::module('programs');
TwillRoutes::module('profiles');
TwillRoutes::module('programs');
TwillRoutes::module('programs.belts');
TwillRoutes::module('news');