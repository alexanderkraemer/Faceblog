<?php

	/*
		For using this Faceblog set the constant "DIR" to the 
		Directory it is placed, then open your Browser and type in
		the url.
	*/
	const DIR = '/faceblog';

	// set development true, if you want more detailed error messages
	const DEVELOP = false;

	// set error_reporting to "E_ALL" to see all errors
	// for usage, it is recommended to set it to "0"
	error_reporting(E_ALL);

	spl_autoload_register ( function ( $class )
	{
		$str = str_replace ( '_', '/', $class );

		$incpath = [ ];
		$incpath[] = dirname ( __FILE__ ) . '/Controller';
		$incpath[] = dirname ( __FILE__ ) . '/Libs';
		$incpath[] = dirname ( __FILE__ ) . '/Models';

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

	$app = new Bootstrap ();
	$app->init ();