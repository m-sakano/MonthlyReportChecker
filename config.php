<?php

/*
create database monthly_report_checker;
grant all on monthly_report_checker.* to dbuser@localhost identified by 'asdfasdf';

use monthly_report_checker

create table users (
    id int not null auto_increment primary key,
    google_user_id varchar(30) unique,
    google_email varchar(255),
    google_name varchar(255),
    google_picture varchar(255),
    google_access_token varchar(255),
    created datetime,
    modified datetime
);
*/

define('DSN', 'mysql:host=localhost;dbname=monthly_report_checker');
define('DB_USER', 'dbuser');
define('DB_PASSWORD', 'asdfasdf');

define('CLIENT_ID', '957141889512-hsiekeccn0vau8aur3e89igu0skn7kee.apps.googleusercontent.com');
define('CLIENT_SECRET', 'd9HYUCpQOnA_YkvZDJAilkK1');

define('SITE_URL', 'http://www.chemicalbrain.net/MonthlyReportChecker/');

error_reporting(E_ALL &~E_NOTICE);

session_set_cookie_params(0, '/MonthlyReportChecker/');
