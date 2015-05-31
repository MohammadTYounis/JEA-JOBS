<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"         => "ال:attribute must be accepted.",
	"active_url"       => "ال:attribute is not a valid URL.",
	"after"            => "ال:attribute must be a date after :date.",
	"alpha"            => "ال:attribute may only contain letters.",
	"alpha_dash"       => "ال:attribute may only contain letters, numbers, and dashes.",
	"alpha_num"        => "ال:attribute may only contain letters and numbers.",
	"array"            => "ال:attribute must be an array.",
	"before"           => "ال:attribute must be a date before :date.",
	"between"          => array(
		"numeric" => "ال:attribute must be between :min - :max.",
		"file"    => "ال:attribute must be between :min - :max kilobytes.",
		"string"  => "ال:attribute must be between :min - :max characters.",
		"array"   => "ال:attribute must have between :min - :max items.",
	),
	"confirmed"        => "ال:attribute غير متطابقة.",
	"date"             => "ال:attribute is not a valid date.",
	"date_format"      => "ال:attribute does not match the format :format.",
	"different"        => "ال:attribute and :other must be different.",
	"digits"           => "ال:attribute must be :digits digits.",
	"digits_between"   => "ال:attribute must be between :min and :max digits.",
	"email"            => "ال:attribute format is invalid.",
	"exists"           => "The selected :attribute is invalid.",
	"image"            => "ال:attribute must be an image.",
	"in"               => "The selected :attribute is invalid.",
	"integer"          => "ال:attribute must be an integer.",
	"ip"               => "ال:attribute must be a valid IP address.",
	"max"              => array(
		"numeric" => "ال:attribute قد لا تكون أكبر من :max.",
		"file"    => "ال:attribute قد لا تكون أكبر من :max كيلو بايت.",
		"string"  => "ال:attribute قد لا تكون أكبر من :max الأحرف.",
		"array"   => "ال:attribute قد لا تكون أكبر من :max البنود.",
	),
	"mimes"            => "ال:attribute يجب أن يكون الملف من نوع: :values.",
	"min"              => array(
		"numeric" => "ال:attribute يجب على الاقل :min.",
		"file"    => "ال:attribute يجب على الاقل :min كيلو بايت.",
		"string"  => "ال:attribute يجب على الاقل :min احرف.",
		"array"   => "ال:attribute يجب أن يكون على الأقل :min البنود.",
	),
	"not_in"           => "المحدد :attribute غير صالح.",
	"numeric"          => "ال:attribute يجب انيكون رقم.",
	"regex"            => "ال:attribute تنسيق غير صالح.",
	"required"         => "ال:attribute مطلوب تعبأته.",
	"required_if"      => "ال:attribute field is required when :other is :value.",
	"required_with"    => "ال:attribute field is required when :values is present.",
	"required_without" => "ال:attribute field is required when :values is not present.",
	"same"             => "ال:attribute and :other must match.",
	"size"             => array(
		"numeric" => "ال:attribute يجب ان يكون :size.",
		"file"    => "ال:attribute يجب ان يكون :size كيلو بايت.",
		"string"  => "ال:attribute يجب ان يكون :size حروف.",
		"array"   => "ال:attribute يجب ان يكون :size بنود.",
	),
	"unique"           => "ال:attribute مسجل من قبل.",
	"url"              => "ال:attribute خطأ في التنسيق.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(
	 
    "title"             => "عنوان الوظيفة",
	"description"       => "وصف للوظيفة",
    "tags"              => "تخصصات الفرعية",
    "categories"        => "تخصصات الرئيسية",
    "code"              => "تفاصيل للوظيفة",
    "password"          => "كلمة السر ",

	),

);
