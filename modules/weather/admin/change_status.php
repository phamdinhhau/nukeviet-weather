<?php

/**
 * @Project Tuan Chau Dev
 * @Author Hau Pham (phamdinhhau@gmail.com)
 * @Copyright (C) 2014 Hau's Corp. All rights reserved
 * @Createdate 24/5/2014, 11:55 
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$id = $nv_Request->get_int( 'id', 'post', 0 );

$sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . ' WHERE id=' . $id;
$id = $db->query( $sql )->fetchColumn();
if( empty( $id ) ) die( 'NO_' . $id );

$new_status = $nv_Request->get_bool( 'new_status', 'post' );
$new_status = ( int )$new_status;

$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . ' SET status=' . $new_status . ' WHERE id=' . $id;
$db->query( $sql );
nv_del_moduleCache( $module_name );

include NV_ROOTDIR . '/includes/header.php';
echo 'OK_' . $id;
include NV_ROOTDIR . '/includes/footer.php';