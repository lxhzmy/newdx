<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: cache_fields_connect_register.php 22725 2011-05-18 06:45:29Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function build_cache_fields_connect_register() {
	global $_G;
	$data = array();
	$fields = array();
	if($_G['setting']['connect']['register_gender']) {
		$fields[] = 'gender';
	}
	if($_G['setting']['connect']['register_birthday']) {
		$fields[] = 'birthyear';
		$fields[] = 'birthmonth';
		$fields[] = 'birthday';
	}
	if($fields) {
		$query = DB::query("SELECT * FROM ".DB::table('common_member_profile_setting')." WHERE fieldid IN (".dimplode($fields).")");

		while($field = DB::fetch($query)) {
			$choices = array();
			if($field['selective']) {
				foreach(explode("\n", $field['choices']) as $item) {
					list($index, $choice) = explode('=', $item);
					$choices[trim($index)] = trim($choice);
				}
				$field['choices'] = $choices;
			} else {
				unset($field['choices']);
			}
			$field['showinregister'] = 1;
			$field['available'] = 1;
			$data['field_'.$field['fieldid']] = $field;
		}
	}

	save_syscache('fields_connect_register', $data);
}

?>