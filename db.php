<?php
const DBHOST = 'localhost';
const DBUSER = 'root';
const DBPASS = '';
const DBDB = 'sakila';

$db = mysqli_connect(DBHOST, DBUSER, DBPASS, DBDB);
mysqli_query($db, "SET NAMES utf8"); // niekoniecznie, póki co
