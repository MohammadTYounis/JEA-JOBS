<?php
namespace Controllers;
use Tricks\Repositories\TagRepositoryInterface;
use Tricks\Cv as Cv;
use Tricks\User as User;
use Tricks\CvExp as CvExp;



class CvController extends BaseController{


/**
     * Tag repository.
     *
     * @var \Tricks\Repositories\TagRepositoryInterface
     */
    protected $tags;

    public function __construct(TagRepositoryInterface $tags){
        parent::__construct();
        $this->beforeFilter('auth');
        $this->tags       = $tags;
    }


    public function getcvNew(){
 
      if (!empty(\Auth::user()->user_cat)){


         $tagList      = $this->tags->listAll();
           

             $user_cat = \Auth::user()->user_cat; 

               if ($user_cat == 2 ){   
                 return \Redirect::to('user/tricks/new');
                } 
                }


              $id      = \Auth::user()->id;
              $cv_exp  =   CvExp::find($id);
              //$items   = CvExp::where('id','=',$id)->get();
             $items =\DB::table('cv_exp_v1')
                        ->where('cv_exp_v1.id','=', $id)
                        ->select('cv_exp_v1.id','cv_exp_v1.from_date','cv_exp_v1.to_date', 'cv_exp_v1.period','cv_exp_v1.exp_type', 'cv_exp_v1.created_at', 'cv_exp_v1.title', 'cv_exp_v1.des', 'cv_exp_v1.updated_at', 'cv_exp_v1.ser', 'cv_exp_v1.tag_id') 
                        ->get();
              $cv      =  Cv::find($id);
              
                 
   if (isset($cv)) {  

          return $this->view('cv.new', compact('cv','cv_exp','items','tagList'));
                }
   elseif((isset($cv_exp))){

         return $this->view('cv.new', compact('cv','cv_exp','items','tagList'));
   }
   else {
       return $this->view('cv.new', compact('tagList'));
                  }

  }

    public function postcvNew()
    {
    

 

     $flag_save = \Input::get('flag_save');
     $exp_type  = \Input::get('exp_type');
      
  //return \Input::get('rel');


  //return \Input::get('title');
     if ($flag_save =="cv_exp_delete"){
     $ser = \Input::get('ser2');
     //$cv_exp->delete($ser);
     $affectedRows = CvExp::where('ser', '=', $ser)->delete();
     

}

     if ($flag_save =="cv_exp"){
      if($exp_type<>-1){
      
              $user2             = \Auth::user()->id;
              $cv_exp            = new CvExp; 
              $fdate             = new  \Carbon\Carbon(\Input::get('from_date'));
              $todate            = new  \Carbon\Carbon(\Input::get('to_date'));
       if ($fdate < $todate)
          {         
 $cv_exp=CvExp::create(array('id'=> $user2 , 
                                'title'=> \Input::get('title') ,
                                'desc'=>\Input::get('desc'),
                                'tag_id'=>\Input::get('tags'),
                                'exp_type'=>\Input::get('exp_type'),
                                'from_date'=>$fdate ,
                                'to_date'=>$todate));
     
    

          $cv_exp->save();
        }

     }
}

     if ($flag_save =="user"){ //// Eng info

              $user_id   = \Auth::user()->id;
              $user     = User::find($user_id); 
              $avatar   =\Input::get('avatar');

              $user->phonenumber  =  \Input::get('cv_eng_phone'); 
              $user->email        =  \Input::get('cv_email');
              //$user->photo        =  \Input::get('avatar');


        if ($avatar != '') {
            \File::move(public_path().'/img/avatar/temp/'.$avatar, 'img/avatar/'.$avatar);

           /* if ($user->photo) {
                \File::delete(public_path().'/img/avatar/'.$user->photo);
            }*/

            $user->photo = $avatar;
        }
               
              $user->save();  /// end Eng ifno
}
 /////////////////////////////////////////////////////               
     if ($flag_save =="cv"){
            
           $user   =\Auth::user()->id;
          $fuser   =Cv::find($user);
     if (!empty($fuser)) {
      
          
          $z=\Input::file('cv_attachment');  
          
          $z="CV_".$user;
           
           $user     = \Auth::user()->id;
           $cv       = Cv::find($user); 
           $cv->cv_title      =  \Input::get('cv_title'); 
           $cv->cv_summary    =  \Input::get('cv_summary'); 
           
          if (\Input::hasFile('cv_attachment')){
            $size = \Input::file('cv_attachment')->getSize();  
          $mime = \Input::file('cv_attachment')->getMimeType();
          if ($size < 500000){
            
    if ($mime == "application/msword") {

           \Input::file('cv_attachment')->move("img/CV/", $z);
            $cv->cv_attachment =  $z;
          }
          elseif ($mime == "application/pdf")
          {
        \Input::file('cv_attachment')->move("img/CV/", $z);
            $cv->cv_attachment =  $z;
          }  
        }} 

         $cv->save();   
         }
            else{
          $cv=Cv::create(array('id'  => $user , 
                                'cv_title' => \Input::get('cv_title') ,
                                'cv_summary'=>\Input::get('cv_summary'),
                                'cv_attachment'=>(\Input::file('cv_attachment')) 
                          ));
     
          $cv->save(); 

            }   
          }

    

      return \Redirect::to('user/cv/new');

    }


        public function getcvUpdate(){
        
              $id     = \Auth::user()->id;
              $cv       = Cv::find($id); 

              return \View::make('cv.edit')->with('cv',$cv);   
    }


        public function postcvUpdate(){
    

              $user     = \Auth::user()->id;
              $cv       = Cv::find($user); 

              $cv->cv_title   =  \Input::get('cv_title'); 
              $cv->cv_summary =  \Input::get('cv_summary'); 
               
              $cv->save(); 

             # return \View::make('cv.view')->with('cv',$cv);   
              return \Redirect::to('user/settings'); 
              
    }


}
