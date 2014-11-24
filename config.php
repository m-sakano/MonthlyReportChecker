<?php

/*
create database monthly_report_checker default character set utf8;
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

create table project_sheet (
    id int not null auto_increment primary key,
    report_month date,
    report_company varchar(255),
    report_organization varchar(255),
    report_name varchar(255),
    report_timeunit time,
    report_begintime time,
    report_endtime time,
    report_intervaltime varchar(255),
    project_name varchar(255),
    project_company varchar(255),
    google_email varchar(255),
    created datetime,
    modified datetime
);

create table project_worktime (
    id int not null auto_increment primary key,
    project_date date,
    project_begintime time,
    project_endtime time,
    project_intervaltime1 time,
    project_intervaltime2 time,
    project_status varchar(255),
    project_notes varchar(255),
    project_substitute_holiday date,
    project_approved boolean,
    is_holiday boolean,
    google_email varchar(255),
    created datetime,
    modified datetime
);

create table house_sheet (
    id int not null auto_increment primary key,
    report_month date,
    report_company varchar(255),
    report_organization varchar(255),
    report_name varchar(255),
    report_timeunit time,
    report_begintime time,
    report_endtime time,
    report_intervaltime varchar(255),
    project_name varchar(255),
    project_company varchar(255),
    google_email varchar(255),
    created datetime,
    modified datetime
);

create table house_worktime (
    id int not null auto_increment primary key,
    house_date date,
    house_begintime time,
    house_endtime time,
    house_intervaltime1 time,
    house_intervaltime2 time,
    house_status varchar(255),
    house_notes varchar(255),
    house_substitute_holiday date,
    house_approved boolean,
    is_holiday boolean,
    google_email varchar(255),
    created datetime,
    modified datetime
);

create table holiday_master (
    id int not null auto_increment primary key,
    holiday_date date,
    holiday_notes varchar(255),
    google_email varchar(255),
    created datetime,
    modified datetime
);

create table result (
    id int not null auto_increment primary key,
    google_user_id varchar(30) unique,
    priority varchar(10),
    message text,
    created datetime,
    modified datetime
);

*/

setlocale(LC_ALL, 'ja_JP.UTF-8');

define('DSN', 'mysql:host=localhost;dbname=monthly_report_checker');
define('DB_USER', 'dbuser');
define('DB_PASSWORD', 'asdfasdf');

define('CLIENT_ID', '957141889512-hsiekeccn0vau8aur3e89igu0skn7kee.apps.googleusercontent.com');
define('CLIENT_SECRET', 'd9HYUCpQOnA_YkvZDJAilkK1');

define('SITE_URL', 'http://www.chemicalbrain.net/MonthlyReportChecker/');

define('LOG_FILE', dirname(__FILE__) . '/app.log');

error_reporting(E_ALL &~E_NOTICE);

session_set_cookie_params(0, '/MonthlyReportChecker/');
