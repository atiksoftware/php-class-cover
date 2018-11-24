<?php

	include "../vendor/autoload.php";

	use \Atiksoftware\Cover\Arr;

	$example = [
		"user" => [
			"fname" => "Mansur",
			"lname" => "ATİK",
			"age"   => 24,
			"props" => [
				"auths" => [
					"insert" => true,
					"update" => true,
					"delete" => true,
				],
				"langs" => [
					"tr",
					"en",
					"ar"
				]
			]
		]
	];

	echo Arr::Not($example,"user.fname"); # Mansur
	echo "\n";

	Arr::Not($example,"user.props.auths.select",true);
	print_r(Arr::Not($example,"user.props.auths"));
	echo "\n";
