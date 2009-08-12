<?php
/**************
This PHP script Extracts MySQL table and downloads into an Excel Spreadsheet.
Script by Jeff Johns, for a full explanation and tutorial on this, see: http://www.phpfreaks.com/tutorials/114/0.php
**************
CONFIGURATION:

YOUR DATABASE HOST = (ex. localhost)
USERNAME = username used to connect to host
PASSWORD = password used to connect to host
DB_NAME = your database name
TABLE_NAME = table in the database used for extraction
**************
To extract specific fields and not the whole table, simply replace
the * in the $select variable with the fields you want
**************/
define(db_host, 'localhost');
define(db_user, 'donavo5_donavo5');
define(db_pass, 'reefmaster');
define(db_link, mysql_connect(db_host,db_user,db_pass));
define(db_name, 'donavo5_donavonsreefdb');
define(DEFAULT_TABLE, 'subscribers');
mysql_select_db(db_name, db_link);
/*************
Get table name from query string or set a default
*************/
$table_name = isset($_GET['table']) ? $_GET['table'] : DEFAULT_TABLE;
/*************
Build query, call it, and find the number of fields
/*************/
if (!isset($_GET['table']) || $_GET['table'] == '') {
	$select = "SELECT name, email, date_joined FROM $table_name WHERE unsubscribe = 'n' ORDER BY date_joined DESC";
} else $select = "SELECT * FROM $table_name";
$export = mysql_query($select) or die("No results. ".mysql_error());
$count = mysql_num_fields($export);
/************
Extract field names and write them to the $header variable
/***********/
for ($i = 0; $i < $count; $i++) $header .= ucwords(str_replace('_', ' ', mysql_field_name($export, $i))).',';
/***********
Extract all data, format it, and assign to the $data variable
/**********/
while($row = mysql_fetch_row($export)) {
	$line = '';
	foreach($row as $value) {
		if (!isset($value) || $value == '') {
			$value = "\t";
		} else {
			$value = str_replace('"', '""', $value);
			$value = '"' . $value . '"' . ',';
		}
		$line .= $value;
	}
	$data .= trim($line)."\n";
}
$data = str_replace("\r", '', $data);
/************
Set the default message for zero records
/************/
if ($data == '') $data = "\n(0) Records Found!\n";
mysql_close(db_link);
/************
Set the automatic download section
/************/
header('Content-type: application/octet-stream');
//header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$table_name.csv");
header('Pragma: no-cache');
header('Expires: 0');
print "$header\n$data";
exit;