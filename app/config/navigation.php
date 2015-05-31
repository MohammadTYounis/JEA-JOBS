<?php

// Defining menu structure here
// the items that need to appear when user is logged in should have logged_in set as true

if (!empty(\Auth::user()->user_cat)){

$user_cat = \Auth::user()->user_cat; 
$active_account = \Auth::user()->active_account;
   if ($user_cat == 1 )
    {return array(

	'menu' => array(
		array(
			'label' => 'الرئيسية',
			'route' => 'browse.recent',
			'active' => array('/','popular','comments')
		),
		array(
			'label' => 'التخصصات',
			'route' => 'browse.categories',
			'active' => array('categories*')
		),
		array(
			'label' => 'التخصصات الفرعية',
			'route' => 'browse.tags',
			'active' => array('tags*')
		),
		array(
			'label' => 'اضف سيرتك',
			'route' => 'cv.new',
			'active' => array('user/cv/new'),
			// 'logged_in' => true
		),
	),

	'browse' => array(
		array(
			'label' => 'الوظائف الاحدث',
			'route' => 'browse.recent',
			'active' => array('/')
		),
		array(
			'label' => 'الاكثر مشاهدة',
			'route' => 'browse.popular',
			'active' => array('popular')
		),
		/*array(
			'label' => 'الأكثر إعجابا',
			'route' => 'browse.comments',
			'active' => array('comments')
		),*/
	),);}/////////////////Eng 



  elseif($user_cat == 2 ) {
      if($active_account == 0){
       return array(

	'menu' => array(
		array(
			'label' => 'الرئيسية',
			'route' => 'browse.recent',
			'active' => array('/','popular','comments')
		),
		array(
			'label' => 'التخصصات',
			'route' => 'browse.categories',
			'active' => array('categories*')
		),
		array(
			'label' => 'التخصصات الفرعية',
			'route' => 'browse.tags',
			'active' => array('tags*')
		),
	  
	),

	'browse' => array(
		array(
			'label' => 'الوظائف الاحدث',
			'route' => 'browse.recent',
			'active' => array('/')
		),
		array(
			'label' => 'الاكثر مشاهدة',
			'route' => 'browse.popular',
			'active' => array('popular')
		),
		/*array(
			'label' => 'الأكثر إعجابا',
			'route' => 'browse.comments',
			'active' => array('comments')
		),*/
	),);}
      else
      {return array(

	'menu' => array(
		array(
			'label' => 'الرئيسية',
			'route' => 'browse.recent',
			'active' => array('/','popular','comments')
		),
		array(
			'label' => 'التخصصات',
			'route' => 'browse.categories',
			'active' => array('categories*')
		),
		array(
			'label' => 'التخصصات الفرعية',
			'route' => 'browse.tags',
			'active' => array('tags*')
		),
	
		array(
			'label' => 'اضف وظيفة',
			'route' => 'tricks.new',
			'active' => array('user/tricks/new'),
			// 'logged_in' => true
		),  
	),

	'browse' => array(
		array(
			'label' => 'الوظائف الاحدث',
			'route' => 'browse.recent',
			'active' => array('/')
		),
		array(
			'label' => 'الاكثر مشاهدة',
			'route' => 'browse.popular',
			'active' => array('popular')
		),
		/*array(
			'label' => 'الأكثر إعجابا',
			'route' => 'browse.comments',
			'active' => array('comments')
		),*/
	),);}
     } //////////////////// Company 


 else{
      if($active_account == 0){
       return array(

	'menu' => array(
		array(
			'label' => 'الرئيسية',
			'route' => 'browse.recent',
			'active' => array('/','popular','comments')
		),
		array(
			'label' => 'التخصصات',
			'route' => 'browse.categories',
			'active' => array('categories*')
		),
		array(
			'label' => 'التخصصات الفرعية',
			'route' => 'browse.tags',
			'active' => array('tags*')
		),
	  
	),

	'browse' => array(
		array(
			'label' => 'الوظائف الاحدث',
			'route' => 'browse.recent',
			'active' => array('/')
		),
		array(
			'label' => 'الاكثر مشاهدة',
			'route' => 'browse.popular',
			'active' => array('popular')
		),
		/*array(
			'label' => 'الأكثر إعجابا',
			'route' => 'browse.comments',
			'active' => array('comments')
		),*/
	),);}
      else
      {return array(

	'menu' => array(
		array(
			'label' => 'الرئيسية',
			'route' => 'browse.recent',
			'active' => array('/','popular','comments')
		),
		array(
			'label' => 'التخصصات',
			'route' => 'admin.categories.index',
			'active' => array('categories*')
		),
		array(
			'label' => 'التخصصات الفرعية',
			'route' => 'admin.tags.index',
			'active' => array('tags*')
		),
	
		array(
			'label' => 'إدارة المستخدمين ',
			'route' => 'admin.users.list',
			'active' => array('users*'),
			// 'logged_in' => true
		), 
		array(
			'label' => 'إدارة الوظائف',
			'route' => 'admin.tricks.list',
			'active' => array('tricks*'),
			// 'logged_in' => true
		), 
		array(
			'label' => 'اضف وظيفة',
			'route' => 'tricks.new',
			'active' => array('user/tricks/new'),
			// 'logged_in' => true
		),   
	),

	'browse' => array(
		array(
			'label' => 'الوظائف الاحدث',
			'route' => 'browse.recent',
			'active' => array('/')
		),
		array(
			'label' => 'الاكثر مشاهدة',
			'route' => 'browse.popular',
			'active' => array('popular')
		),
		/*array(
			'label' => 'الأكثر إعجابا',
			'route' => 'browse.comments',
			'active' => array('comments')
		),*/
	),);}
     }  /////////////// Admin 

  }

  
else{return array(

	'menu' => array(
		array(
			'label' => 'الرئيسية',
			'route' => 'browse.recent',
			'active' => array('/','popular','comments')
		),
		array(
			'label' => 'التخصصات',
			'route' => 'browse.categories',
			'active' => array('categories*')
		),
		array(
			'label' => 'التخصصات الفرعية',
			'route' => 'browse.tags',
			'active' => array('tags*')
		),
		array(
			'label' => 'اضف وظيفة',
			'route' => 'tricks.new',
			'active' => array('user/tricks/new'),
			// 'logged_in' => true
		),
		array(
			'label' => 'اضف سيرتك',
			'route' => 'cv.new',
			'active' => array('user/cv/new'),
			// 'logged_in' => true
		),
	),

	'browse' => array(
		array(
			'label' => 'الوظائف الاحدث',
			'route' => 'browse.recent',
			'active' => array('/')
		),
		array(
			'label' => 'الاكثر مشاهدة',
			'route' => 'browse.popular',
			'active' => array('popular')
		),
		/*array(
			'label' => 'الأكثر إعجابا',
			'route' => 'browse.comments',
			'active' => array('comments')
		),*/
	),); }

	//////////////////// for All  
