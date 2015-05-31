<?php

namespace Controllers\Admin;

use Controllers\BaseController;
use Tricks\Repositories\UserRepositoryInterface;

class UsersController extends BaseController
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
     * Get an array of key-value pairs of all users.
     *
     * @return array
     */
    public function listAllCompany()
    {
        $users = $this->model->get();

        return $users;
    }
    /**
     * Show the users index page.
     *
     * @return \Response
     */
    public function getIndex()
    {
        $users = $this->users->findAllPaginated();

        $this->view('admin.users.list', compact('users'));
    }
   
    
/**
     * Handle the creation of a tag.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postIndex()
    {
          


               $userid       = $this->users->findById(\Input::get('userid')); 
               $userid->active_account   =  \Input::get('active_account'); 
               $userid->save(); 
               $users = $this->users->findAllPaginated();
               
 
///////////////////////////////////
    if (\Input::get('active_account')==1){
        if (!empty(\Input::get('emailcompany'))){
\Mail::queue('emails.auth.companyNotification', array('msg'=>\Lang::get('emails.welcomelogin')), function($message)
{
    $message->to(\Input::get('emailcompany'))->subject(\Lang::get('emails.newCompany'));
});
}
//////////////////
}


        $this->view('admin.users.list', compact('users'));
    }
}