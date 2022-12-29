<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['migration_enabled'] = true;
$config['migration_type'] = 'timestamp';
$config['migration_table'] = 'migrations';
$config['migration_auto_latest'] = true;
$config['migration_version'] = 0;
$config['migration_path'] = APPPATH . 'migrations/';
