<?php
	const DIR = '/faceblog';

	const DEVELOP = false;

	error_reporting(E_ALL);

	spl_autoload_register ( function ( $class )
	{
		$str = str_replace ( '_', '/', $class );
		global $incpath;
		if ( !$incpath )
		{
			$incpath = [ ];
			{
				$incpath[] = dirname ( __FILE__ ) . '/Controller';
				$incpath[] = dirname ( __FILE__ ) . '/Libs';
				$incpath[] = dirname ( __FILE__ ) . '/Models';
			}
		}
		foreach ( $incpath as $p )
		{
			$f = $p . '/' . $str . '.php';
			if ( file_exists ( $f ) )
			{
				require_once $f;

				return;
			}
		}
		require_once $str . '.php';
	} );

	$app = new Bootstrap;
	$app->init ();