<?php

namespace Controllers\Admin;

use Controllers\BaseController;
use Tricks\Repositories\UserRepositoryInterface;

class JobSeekerRepController extends BaseController
{
    /**
     * User repository.
     *
     * @var \Tricks\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Create a new UsersController instance.
     *
     * @param  \Tricks\Repositories\UserRepositoryInterface $users
     * @return void
     */
    public function __construct(UserRepositoryInterface $users)
    {
        parent::__construct();

        $this->users = $users;
    }


    /**
     * Show the users index page.
     *
     * @return \Response
     */
    public function getIndex()
    {
       
     $fromdate            = new  \Carbon\Carbon(\Input::get('fromdate'));
     $todate              = new  \Carbon\Carbon(\Input::get('todate'));
     $category            = \Input::get('category');
     $tags                = \Input::get('tags');
     $gender              = \Input::get('GENDER');
     $exp_no              = \Input::get('exp_no');
     $det_spe            = \Input::get('det_spec');
   
 

  if ($gender <>'0'){
    if($tags <> '0'){
        $users =\DB::table('users')
            ->join('cv', 'users.id','=','cv.id')
            ->whereExists(function($query)
            {
                $query->select(\DB::raw(1))
                      ->from('cv_exp_v1')
                      ->whereRaw('cv_exp_v1.id = users.id')
                      ->where('cv_exp_v1.period', '>=',\Input::get('exp_no'))
                      ->where('cv_exp_v1.tag_id','=',\Input::get('tags'))
                      ->where('cv_exp_v1.title', 'LIKE', "%".\Input::get('det_spec')."%");
            })
            ->where('users.user_cat','=','1')
            ->where('users.section','=',\Input::get('category'))
            ->where('users.gender','LIKE',"%".$gender."%")
            ->whereBetween('cv.updated_at', array($fromdate,$todate))
            ->get();

    } 
     else{
        $users =\DB::table('users')
            ->join('cv', 'users.id','=','cv.id')
            ->whereExists(function($query)
            {
                $query->select(\DB::raw(1))
                      ->from('cv_exp_v1')
                      ->whereRaw('cv_exp_v1.id = users.id')
                      ->where('cv_exp_v1.period', '>=',\Input::get('exp_no'))
                      ->where('cv_exp_v1.title', 'LIKE', "%".\Input::get('det_spec')."%");
            })
            ->where('users.user_cat','=','1')
            ->where('users.section','=',\Input::get('category'))
            ->where('users.gender','LIKE',"%".$gender."%")
            ->whereBetween('cv.updated_at', array($fromdate,$todate))
            ->get();
     }

           }

  else{
     
     if($tags <> '0'){
        $users =\DB::table('users')
            ->join('cv', 'users.id','=','cv.id')
            ->whereExists(function($query)
            {
                $query->select(\DB::raw(1))
                      ->from('cv_exp_v1')
                      ->whereRaw('cv_exp_v1.id = users.id')
                      ->where('cv_exp_v1.period', '>=',\Input::get('exp_no'))
                      ->where('cv_exp_v1.tag_id','=',\Input::get('tags'))
                      ->where('cv_exp_v1.title', 'LIKE', "%".\Input::get('det_spec')."%");
            })
            ->where('users.user_cat','=','1')
            ->where('users.section','=',\Input::get('category'))
            ->whereBetween('cv.updated_at', array($fromdate,$todate))
            ->get();

    } 
     else{
        $users =\DB::table('users')
            ->join('cv', 'users.id','=','cv.id')
            ->whereExists(function($query)
            {
                $query->select(\DB::raw(1))
                      ->from('cv_exp_v1')
                      ->whereRaw('cv_exp_v1.id = users.id')
                      ->where('cv_exp_v1.period', '>=',\Input::get('exp_no'))
                      ->where('cv_exp_v1.title', 'LIKE', "%".\Input::get('det_spec')."%");
            })
            ->where('users.user_cat','=','1')
            ->where('users.section','=',\Input::get('category'))
            ->whereBetween('cv.updated_at', array($fromdate,$todate))
            ->get();
     }
           } 
 //return date("d/m/Y", strtotime(\Input::get('fromdate')));
     
        $this->view('admin.users.jobseekerReport', compact('users'));
    }
   

}