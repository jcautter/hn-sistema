<?php
/*
Plugin Name: HN FINANCEIRO
Plugin URI: www.hospedanit.com
Description: Sistema Financeiro HN
Version: 1.0
Author: Joao Cautter & Juliano Senfft
Author URI: http://www.hospedanit.com
License: GPLv2 or later
*/

define ('RADICALFIN','hn_fin');
require_once dirname(__FILE__) . "/".RADICALFIN."_post_type.php";
require_once dirname(__FILE__) . "/".RADICALFIN."_meta_boxe.php";
require_once dirname(__FILE__) . "/".RADICALFIN."_taxonomy.php";
require_once dirname(__FILE__) . "/".RADICALFIN."_role.php";
require_once dirname(__FILE__) . "/".RADICALFIN."_functions.php";
require_once dirname(__FILE__) . "/".RADICALFIN."_page.php";
require_once dirname(__FILE__) . "/".RADICALFIN."_custom_columns.php";
//require_once dirname(__FILE__) . "/boleto";
//require_once dirname(__FILE__) . "/".RADICALFIN."_redirect.php";
require_once dirname(__FILE__) . "/".RADICALFIN."_ajax.php";
//require_once "http://hngrupo.com.br/financeiro/boleto/funcoes_santander_banespa.php";
//require_once "http://hngrupo.com.br/financeiro/boleto/mpdf60/mpdf.php";

?>