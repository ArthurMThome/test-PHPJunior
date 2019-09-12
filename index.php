<?php
// Arthur Martins Thome
// 12/09/2019

#region [ CONSTANTS ]
// -- Constant array with possible routes and the autonomy of each route.

define 	( "ROUTES", [ 
			'route1' => [ "origin"=> "A", "destiny"=> "B", "autonomy"=> "10" ],
			'route2' => [ "origin"=> "B", "destiny"=> "D", "autonomy"=> "15" ], 
			'route3' => [ "origin"=> "A", "destiny"=> "C", "autonomy"=> "20" ],
			'route4' => [ "origin"=> "C", "destiny"=> "D", "autonomy"=> "30" ],
			'route5' => [ "origin"=> "B", "destiny"=> "E", "autonomy"=> "50" ],
			'route6' => [ "origin"=> "D", "destiny"=> "E", "autonomy"=> "30" ],
		] );

#endregion [ CONSTANTS ]


#region [ TEST ]

/*
echo ChooseRoute ( "a", "b", 3.00 );  	// -- The best route is AB costing R$ 3,00.
echo ChooseRoute ( "a", "c", 3.33 );  	// -- The best route is AC costing R$ 6,66.
echo ChooseRoute ( "a", "d", 2.50 );	// -- The best route is ABD costing R$ 6,25.
echo ChooseRoute ( "a", "e", 4.15 );	// -- The best route is ABDE costing R$ 22,83.
*/

#endregion [ TEST ]


#region [ FunctionMain  ]
// -- Main function.
// -- Calculates which route is best according to the autonomy of each route and return a string 
// -- stating which route the user should take and how much will be spent.
// -- Receives 3 parameters, being the origin point, the destination point and the liter value of gasoline. 

function ChooseRoute ( $origin, $destiny, $gasolinePrice ) {
	$autonomyTotal	= array ( );
	$autonomySum 	= array ( );
	$route 			= array ( );
	$cont 			= 0;
	$min 			= 0;

	// Format strings
	$origin 	= strtoupper ( $origin );
	$destiny 	= strtoupper ( $destiny );

	$originTemp = $origin;

	foreach ( ROUTES as $key => $value) 
	{
		if ( $value [ 'origin' ] == $originTemp ) 
		{
			array_push ( $autonomySum, $value [ 'autonomy' ] );

			if ( $value [ 'destiny' ] == $destiny ) 
			{
				AddAutonomy ( array_sum ( $autonomySum ), $cont ); 
			}
			else 
			{
				$originTemp = $value [ 'destiny' ];

				$route [ $cont ] = '';

				foreach ( ROUTES as $key => $value) 
				{
					if ( $value [ 'origin' ] == $originTemp ) 
					{
						array_push ( $autonomySum, $value [ 'autonomy' ] );
						
						$route [ $cont ] .= $originTemp;

						if ( $value [ 'destiny' ] == $destiny ) 
						{
							AddAutonomy ( array_sum ( $autonomySum ), $cont );	
						}
						else 
						{
							$originTemp = $value [ 'destiny' ];
						}
					}
				}
			}

			$originTemp = $origin;

			$autonomySum = array ( );
		}

		$cont++;
	}

	return FormatReturn ( $route, $gasolinePrice, $origin, $destiny );
}

#endregion [ FunctionMain  ]



#region [ FormatReturn ]
// -- Function to format the return string for the user.
// -- Receives 4 parameters, which are the array of possible routes, the price of the liter of gas, the origin point and the destination point.

function FormatReturn ( $route, $gasolinePrice, $origin, $destiny ) {

	// ------ [ Formatacao do retorno ] 

	$return = "The best route is $origin";
	$return = FormatRoute ( $route,  AutonomyMin ( ), $return );

	// ------ [ Formatacao do valor em R$ ]

	$value = ( $GLOBALS [ 'min' ] / 10 ) * $gasolinePrice;
	$value = number_format ( $value, 2, ',', '');

	// ------ [ End Formatacao do valor em R$ ]

	$return .= "$destiny costing  R$ " . $value . ".";

	// ------ [ End Formatacao do retorno ]

	return $return;
}

#endregion [ FormatReturn ]



#region [ AutonomyMin ]
// -- Function that returns the smallest value of an array, which is the autonomy cost of the best route to the destination.

function AutonomyMin ( ) {
	$GLOBALS [ 'min' ] = min ( $GLOBALS [ 'autonomyTotal' ] );

	foreach ( $GLOBALS [ 'autonomyTotal' ] as $key => $value) {
		if ( $value == $GLOBALS [ 'min' ] ) {
			return $key;
		}
	}
}

#endregion [ AutonomyMin ]



#region [ AddAutonomy ]
// -- Function to save in an array the total value of the autonomy of a given route.
// -- Receive 2 parameters, which is the sum of the total autonomy of a given route and the index that will be saved in the array of all autonomies.

function AddAutonomy ( $sum, $count ) {

	if ( $sum != 0 ) 
	{
		$GLOBALS [ 'autonomyTotal' ] [ $count ] = $sum;
	} 
}

#endregion [ AddAutonomy ]



#region [ FormatRoute ]
// -- Function to check for repeated letters in the route array.
// -- Receive 3 parameters, they are an array with the routes to the destination, the index of the best route in the array and the string that will be returned to the user.

function FormatRoute ( $route, $index, $return ) {

	if ( count ( $route ) > 0 && array_key_exists ( $index, $route ) ) 
	{
		$temp = $route [ $index ];

		$temp = preg_replace ( '/(.)\1+/', '$1', $temp );

		$return .= $temp;
	}

	return $return;
}

#endregion [ FormatRoute ]

?>