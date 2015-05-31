<?php

namespace Controllers;

use Illuminate\Support\Facades\Auth;
use Tricks\Repositories\TagRepositoryInterface;
use Tricks\Repositories\TrickRepositoryInterface;
use Tricks\Repositories\CategoryRepositoryInterface;
use Tricks\Repositories\UserRepositoryInterface;
use Tricks\Votes as Votes;
use Tricks\User as User;

class UserTricksController extends BaseController
{
    /**
     * Trick repository.
     *
     * @var \Tricks\Repositories\TrickRepositoryInterface
     */
    protected $trick;


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
    protected $votes;
     
    protected $users;
    /**
     * Create a new TrickController instance.
     *
     * @param  \Tricks\Repositories\TrickRepositoryInterface  $trick
     * @param  \Tricks\Repositories\TagRepositoryInterface  $tags
     * @param  \Tricks\Repositories\CategoryRepositoryInterface  $categories
     * @return void
     */
    public function __construct(
        TrickRepositoryInterface $trick,
        TagRepositoryInterface $tags,
        CategoryRepositoryInterface $categories,
        UserRepositoryInterface $users
    ) {
        parent::__construct();

        $this->beforeFilter('auth');
        $this->beforeFilter('trick.owner', [
            'only' => [ 'getEdit', 'postEdit', 'getDelete' ]
        ]);

        $this->trick      = $trick;
        $this->tags       = $tags;
        $this->categories = $categories;
        $this->users      = $users;
    }

    /**
     * Show the create new trick page.
     *
     * @return \Response
     */
    public function getNew()
    {


         if (!empty(\Auth::user()->user_cat)){

             $user_cat = \Auth::user()->user_cat; 

               if ($user_cat == 1 ){   
                 return \Redirect::to('user/cv/new');
                }
                else{
                  if(\Auth::user()->active_account == 0){
                 return $this->redirectRoute('user.index');
                  }   
                } 
                }
        $tagList      = $this->tags->listAll();
        $categoryList = $this->categories->listAll();
        $userList    = $this->users->listAllCompany();
        $this->view('tricks.new', compact('tagList', 'categoryList','$userList'));
    }


    /**
     * Show the create new trick page.
     *
     * @return \Response
     */
    public function getcvNew()
    {
        $tagList      = $this->tags->listAll();
        $categoryList = $this->categories->listAll();
        $userList    = $this->users->listAll();
       
        $this->view('cv.new', compact('tagList', 'categoryList'.'userList'));
    }

    /**
     * Handle the creation of a new trick.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNew()
    {
        $form = $this->trick->getCreationForm();

        if (! $form->isValid()) {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        $data = $form->getInputData();
        $data['user_id'] = Auth::user()->id;

        $trick = $this->trick->create($data);
///////////////////////////////////////////////////

\Mail::queue('emails.auth.jobsNotification', array('msg'=>\Lang::get('emails.welcomelogin')), function($message)
{
    $message->to('m.younis@jea.org.jo')->subject(\Lang::get('emails.newjobs'));
});
//////////////////////////////////////////////////
   return $this->redirectRoute('user.index');
    }


/**
     * Handle the creation of a new trick.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postcvNew()
    {
        $form = $this->trick->getCreationForm();

        if (! $form->isValid()) {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        $data = $form->getInputData();
        $data['user_id'] = Auth::user()->id;

        $trick = $this->trick->create($data);

        return $this->redirectRoute('user.index');
    }

    /**
     * Show the edit trick page.
     *
     * @param  string $slug
     * @return \Response
     */
    public function getEdit($slug)
    {
        $trick        = $this->trick->findBySlug($slug);
        $tagList      = $this->tags->listAll();
        $categoryList = $this->categories->listAll();
        $userList    = $this->users->listAll();
       
        $selectedTags       = $this->trick->listTagsIdsForTrick($trick);
        $selectedCategories = $this->trick->listCategoriesIdsForTrick($trick);

        $this->view('tricks.edit', [
            'tagList'            => $tagList,
            'selectedTags'       => $selectedTags,
            'categoryList'       => $categoryList,
            'selectedCategories' => $selectedCategories,
            'trick'              => $trick
        ]);
    }

    /**
     * Show the edit trick page.
     *
     * @param  string $slug
     * @return \Response
     */
    public function getData($slug)
    {
        

  
        $trick        = $this->trick->findBySlug($slug);
         

        //$votes        = Votes::where('trick_id','=',$trick->id);
      // $results = \DB::select('select * from users where id any (?)', array(3,5,7)); 
       //$results = \DB::select('SELECT u.id FROM users u , votes v WHERE u.id = v.user_id and v.trick_id =?', $trick->id); 
    $results =\DB::table('users')
            ->join('votes', 'users.id', '=', 'votes.user_id')
            ->where('votes.trick_id', '=', $trick->id)
            ->select('users.companyname', 'users.phonenumber', 'users.email','users.id','users.eng_birthdate','users.username','users.GENDER')
            ->get();
       
   

      //  $user         = User::whereIn('id', $votes->user_id);
           

           
         return $this->view('tricks.applyreport', compact('results')); 
         /*

        $selectedTags       = $this->trick->listTagsIdsForTrick($trick);
        $selectedCategories = $this->trick->listCategoriesIdsForTrick($trick);

        $this->view('tricks.edit', [
            'tagList'            => $tagList,
            'selectedTags'       => $selectedTags,
            'categoryList'       => $categoryList,
            'selectedCategories' => $selectedCategories,
            'trick'              => $trick
        ]);*/
    }



    /**
     * Handle the editing of a trick.
     *
     * @param  string $slug
     * @return \Illuminate\Http\RedirectResponse
     */


    public function postEdit($slug)
    {
        $trick = $this->trick->findBySlug($slug);
        $form  = $this->trick->getEditForm($trick->id);

        if (! $form->isValid()) {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        $data  = $form->getInputData();
        $trick = $this->trick->edit($trick, $data);

        return $this->redirectRoute('tricks.edit', [ $trick->slug ], [
            'success' => \Lang::get('تم التعديل بنجاح')
        ]);
    }

    /**
     * Delete a trick from the database.
     *
     * @param  string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($slug)
    {
        $trick = $this->trick->findBySlug($slug);

        $trick->tags()->detach();
        $trick->categories()->detach();
        $trick->delete();

        return $this->redirectRoute('user.index', null, [
            'success' => \Lang::get('user_tricks.trick_deleted')
        ]);
    }
}
