<?php
//<project>/the_application/boot/boot_routes.php 1.0.0
use \TheApplication\Components\ComponentRouter as R;

R::add("/sqlite/","Homes","sqlite");
R::add("/contact/","Contact");
R::add("/tests/","Tests");
