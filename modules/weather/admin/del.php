<?php

/**
 * @Project Tuan Chau Dev
 * @Author Hau Pham (phamdinhhau@gmail.com)
 * @Copyright (C) 2014 Hau's Corp. All rights reserved
 * @Createdate 24/5/2014, 12:43 
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$id = $nv_Request->get_int( 'id', 'post', 0 );

$sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id;
$_id = $db->query( $sql )->fetchColumn();

if( empty( $_id ) ) die( 'NO_' . $id );

$sql = 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id = ' . $id;
if( $db->exec( $sql ) )
{
	nv_insert_logs( NV_LANG_DATA, $module_name, 'Delete', 'ID: ' . $id, $admin_info['userid'] );

	$sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . ' ORDER BY weight ASC';
	$result = $db->query( $sql );
	$weight = 0;
	while( $row = $result->fetch() )
	{
		++$weight;
		$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET weight=' . $weight . ' WHERE id=' . $row['id'];
		$db->query( $sql );
	}
	nv_del_moduleCache( $module_name );
}
else
{
	die( 'NO_' . $id );
}

include NV_ROOTDIR . '/includes/header.php';
echo 'OK_' . $id;
include NV_ROOTDIR . '/includes/footer.php';