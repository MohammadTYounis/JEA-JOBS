<?php

namespace Controllers\Admin;
 
use Controllers\BaseController;
use Tricks\Repositories\TrickRepositoryInterface;
use Tricks\Repositories\UserRepositoryInterface;

class TricksController extends BaseController
{
    /**
     * User repository.
     *
     * @var \Tricks\Repositories\TrickRepositoryInterface
     */
    protected $tricks;
    protected $users;
    /**
     * Create a new UsersController instance.
     *
     * @param  \Tricks\Repositories\TrickRepositoryInterface $tricks
     * @return void
     */
    public function __construct(TrickRepositoryInterface $tricks,UserRepositoryInterface $users)
    {
        parent::__construct();

        $this->tricks = $tricks;
        $this->users = $users;
    }

    /**
     * Show the users index page.
     *
     * @return \Response
     */
    public function getIndex()
    {
        $tricks = $this->tricks->findAllPaginatedAdmin();
        $users = $this->users->findAllPaginated();
        $this->view('admin.tricks.list', compact('tricks','users'));
    }


    /*   public function getJobIndex()
    {


        return '11111'; 
        

        $tricks = $this->tricks->findAllPaginatedAdmin();
        $users = $this->users->findAllPaginated();
        $this->view('admin.tricks.jobopp', compact('tricks','users'));
    }
*/
    /**
     * Handle the creation of a tag.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postIndex()
    {
          
        

              $trickid       = $this->tricks->findById(\Input::get('trickid')); 
               
              $trickid->trick_status   =  \Input::get('tt'); 
              
               
          $trickid->save(); 
         $tricks = $this->tricks->findAllPaginatedAdmin();
        $users = $this->users->findAllPaginated();
        $this->view('admin.tricks.list', compact('tricks','users'));
    }

}
