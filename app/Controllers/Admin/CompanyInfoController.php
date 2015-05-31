<?php

namespace Controllers\Admin;
use Tricks\Repositories\TagRepositoryInterface;
use Tricks\Repositories\CategoryRepositoryInterface;
use Controllers\BaseController;
use Tricks\Repositories\UserRepositoryInterface;


class CompanyInfoController extends BaseController
{
    /**
     * User repository.
     *
     * @var \Tricks\Repositories\UserRepositoryInterface
     */
    protected $users;
    /**
     * Tag repository.
     *
     * @var \Tricks\Repositories\TagRepositoryInterface
     */
    protected $tags;
    /**
     * Category repository.
     *
     * @var \Tricks\Repositories\CategoryRepositoryInterface
     */
    protected $categories;
    /**
     * Create a new UsersController instance.
     *
     * @param  \Tricks\Repositories\UserRepositoryInterface $users
     * @return void
     */
    public function __construct(UserRepositoryInterface $users,
        TagRepositoryInterface $tags,
        CategoryRepositoryInterface $categories)
    {
        parent::__construct();

        $this->users = $users;
         $this->tags  = $tags;
        $this->categories = $categories;
    }


    /**
     * Show the users index page.
     *
     * @return \Response
     */
    public function getIndex($users)
    {
        
        $userList    = $this->users->findByUsername($users);
   //var_dump($userList);

        $this->view('admin.users.companyinfo', compact('userList'));
    }
   

}