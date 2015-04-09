<?php

/**
 * @Project Tuan Chau Dev
 * @Author Hau Pham (phamdinhhau@gmail.com)
 * @Copyright (C) 2014 Hau's Corp. All rights reserved
 * @Createdate 24/5/2014, 12:11
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$id = $nv_Request->get_int( 'id', 'post', 0 );

$sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id;
$id = $db->query( $sql )->fetchColumn();
if( empty( $id ) ) die( 'NO_' . $id );

$new_weight = $nv_Request->get_int( 'new_weight', 'post', 0 );
if( empty( $new_weight ) ) die( 'NO_' . $id );

$sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id!=' . $id . ' ORDER BY weight ASC';
$result = $db->query( $sql );

$weight = 0;
while( $row = $result->fetch() )
{
	++$weight;
	if( $weight == $new_weight ) ++$weight;

	$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET weight=' . $weight . ' WHERE id=' . $row['id'];
	$db->query( $sql );
}

$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET weight=' . $new_weight . ' WHERE id=' . $id;
$db->query( $sql );

nv_del_moduleCache( $module_name );

include NV_ROOTDIR . '/includes/header.php';
echo 'OK_' . $id;
include NV_ROOTDIR . '/includes/footer.php';