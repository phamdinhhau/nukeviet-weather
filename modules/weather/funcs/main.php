<?php

/**
 * @Project Tuan Chau Dev
 * @Author Hau Pham (phamdinhhau@gmail.com)
 * @Copyright (C) 2014 Hau's Corp. All rights reserved
 * @Createdate 24/5/2014, 12:55 
 */

if ( ! defined( 'NV_IS_MOD_WEATHER' ) ) die( 'Stop!!!' );

$array_data = array();

$contents = '';

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
