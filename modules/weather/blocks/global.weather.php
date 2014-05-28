<?php

/**
 * @Project Tuan Chau Dev
 * @Author Hau Pham (phamdinhhau@gmail.com)
 * @Copyright (C) 2014 Hau's Corp. All rights reserved
 * @Createdate 24/5/2014, 12:56 
 */


if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_weather_blocks' ) )
{

	function nv_block_config_weather_blocks( $module, $data_block, $lang_block )
	{
		$html = "";
		$html .= "<tr>";
		$html .= "	<td>" . $lang_block['location'] . "</td>";
		$html .= "	<td><select name=\"location\">\n";
		$sql = "SELECT * FROM `" . NV_PREFIXLANG . "_weather` WHERE `status` = 1 ORDER BY `weight` ASC";	
        $list = nv_db_cache( $sql, '', $module );
        foreach( $list as $l )
		{
			$html .= '<option value="' . $l['location_code'] . '" ' . ( ( $data_block['location'] == $l['location_code'] ) ? ' selected="selected"' : '' ) . '>' . $l['location_name'] . '</option>';
		}
		$html .= "</select></td>";
		$html .= "</tr>";
                
        $html .= "<tr>";
		$html .= "	<td>" . $lang_block['numday'] . "</td>";
		$html .= "	<td><select name=\"numday\">\n";
        //Hiện tại chỉ có 9 ngày
        for( $i = 1; $i < 10; $i++ )
		{
			$html .= '<option value="' . $i . '" ' . ( ( $data_block['numday'] == $i ) ? ' selected="selected"' : '' ) . '>' . $i . ' ' . $lang_block['day'] . '</option>';
		}
		$html .= "</select></td>";
		$html .= "</tr>";
        
		return $html;
	}

	function nv_block_config_weather_blocks_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array();
		$return['error'] = array();
		$return['config'] = array();
		$return['config']['location'] = $nv_Request->get_int( 'location', 'post', 0 );
        $return['config']['numday'] = $nv_Request->get_int( 'numday', 'post', 0 );
		return $return;
	}

	function nv_weather_blocks( $block_config )
	{

		global $global_config, $site_mods, $db, $module_name;
		$module = $block_config['module'];
		$array_th = array();

		$sql = "SELECT * FROM `" . NV_PREFIXLANG . "_weather` WHERE `status` = 1 ORDER BY `weight` ASC";
		$list = nv_db_cache( $sql, '', $module );        

		if( file_exists( NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/weather/block.weather.tpl" ) )
		{
			$block_theme = $global_config['module_theme'];
		}
		elseif( file_exists( NV_ROOTDIR . "/themes/" . $global_config['site_theme'] . "/modules/weather/block.weather.tpl" ) )
		{
			$block_theme = $global_config['site_theme'];
		}
		else
		{
			$block_theme = "default";
		}

		$xtpl = new XTemplate( "block.weather.tpl", NV_ROOTDIR . "/themes/" . $block_theme . "/modules/weather" );

		$xtpl->assign( 'TEMPLATE', $block_theme );
        $xtpl->assign( 'CODE', $block_config['location'] );
        $xtpl->assign( 'NUM_DAY', $block_config['numday'] );

		foreach( $list as $row )
		{
            ( $block_config['location'] == $row['location_code'] ) ? $row['selected'] = ' selected="selected"' : $row['selected'] = '';		  
			$xtpl->assign( 'ROW', $row );
			$xtpl->parse( 'main.loop' );
		}
		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
	}

}

if( defined( 'NV_SYSTEM' ) )
{
	$content = nv_weather_blocks( $block_config );
}