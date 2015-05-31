<?php

namespace Controllers\Admin;

use Controllers\BaseController;
 
use Tricks\Repositories\TrickRepositoryInterface;

class JobOppRepController extends BaseController
{
    /**
     * User repository.
     *
     * @var \Tricks\Repositories\UserRepositoryInterface
     */
    protected $tricks;

    /**
     * Create a new UsersController instance.
     *
     * @param  \Tricks\Repositories\UserRepositoryInterface $users
     * @return void
     */
    public function __construct(TrickRepositoryInterface $tricks)
    {
        parent::__construct();

        $this->tricks = $tricks;
    }


    /**
     * Show the users index page.
     *
     * @return \Response
     */
    public function getIndex()
    {
       // $users = $this->users->findAllPaginated();
     $fromdate            = new  \Carbon\Carbon(\Input::get('fromdate'));
     $todate              = new  \Carbon\Carbon(\Input::get('todate'));
     $category            = \Input::get('category');
     $company                = \Input::get('user');


  $tricks =\DB::table('tricks')
            ->join('category_trick', 'tricks.id', '=', 'category_trick.trick_id')
            ->join('users', 'tricks.user_id', '=', 'users.id')
            ->join('lookup_trick_status', 'tricks.trick_status', '=', 'lookup_trick_status.id')
            ->where('category_trick.category_id','=', $category )
            ->where('tricks.user_id','=', $company )
            ->whereBetween('tricks.created_at', array($fromdate,$todate))
            ->select('users.companyname', 'users.phonenumber', 'users.email','tricks.id','tricks.title','tricks.created_at','tricks.trick_status','tricks.slug','tricks.description as desc','lookup_trick_status.description','tricks.vote_cache')
            ->get();


        $this->view('admin.users.jobOppRep', compact('tricks'));
    }
   

}