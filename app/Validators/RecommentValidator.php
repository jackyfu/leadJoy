<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class RecommentValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
		'required|min:4'	=>'	title=>required|min:4',
		'require'	=>'	position=>require',
		'somtimes'	=>'	description=>somtimes',
	],
        ValidatorInterface::RULE_UPDATE => [
		'required|min:4'	=>'	title=>required|min:4',
		'require'	=>'	position=>require',
		'somtimes'	=>'	description=>somtimes',
	],
   ];
}
