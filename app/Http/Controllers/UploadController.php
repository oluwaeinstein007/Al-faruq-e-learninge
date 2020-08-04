<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassSubject;
use Illuminate\support\Facades\Storage;
use Illuminate\Support\Stringable;


class UploadController extends Controller
{

    public function index(){
        $data = ClassSubject::all();
        return view('uploaddash', compact('data'));
    }

    public function direct (String $exam) {
      $urlDirections = [
        'jamb' => function () {
          return $this->myjambcourselist();
        },
        'waec' => function () {
          return $this->mywaeccourselist();
        },
        'post-jamb' => function () {
          return $this->mypostcourselist();
        },
        'ielts' => function () {
          return $this->myieltscourselist();
        },
        'sat' => function () {
          return $this->mysatcourselist();
        }
      ];
      $results = array_key_exists($exam, $urlDirections);
      if ($results) {
        return $urlDirections[$exam]();
      } else {
        return redirect('home');
      }
    }


    public function VideoUpload(Request $request){

            $request->validate([
                'video_title' => 'required|max:255',
                'video_descrip' => 'required|min:25',                
                'tutorial_videos' => 'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040|required',
                'class_levels' => 'required',
            ]);
               $file = $request->tutorial_videos;
               $path="";
               // $img_data=str_replace(' ','+',$file);
                $video_data =str_replace('data:video/mp4;base64,', '',$file );

               $decoded= base64_decode($video_data);
               $path = md5(time().uniqid()).".mp4";
               file_put_contents('uploads/'.$path, $decoded);


               $post = ClassSubject::create([
                   'video_title'=>$request->video_title,
                   'description'=>$request->video_descrip,
                   'class_levels'=>$request->class_levels,
                   'video_title'=>$request->video_title,
                   'tutorial_videos'=>'uploads/'.$path
                ]);                    
                $post->save();
         return redirect('uploaddash');



           
          
           
           
          
  }


  public function myjambcourselist()
  {
    //get all videos belongs to jamb
    $jam = 'jamb_vid';
    $jamblist=ClassSubject::where('class_levels',$jam)->get();
    $mycount = $jamblist->count();
      return view('Jamb',compact('jamblist','mycount'));
  }

    public function myieltscourselist()
    {
      //get all videos belongs to ielts_vid
       $Ieltslist = 'ielts_vid';
       $Ieltslist=ClassSubject::where('class_levels',$Ieltslist)->get();
        $mycount = $Ieltslist->count();
      return view('Ielts',compact('Ieltslist','mycount'));
    }
    public function mypostcourselist()
    {
      //get all videos belongs to postutme_vid
      $postutme_vid = 'postutme_vid';
       $postutme_vid=ClassSubject::where('class_levels',$postutme_vid)->get();
       $mycount = $postutme_vid->count();
        return view('Postutme',compact('postutme_vid','mycount'));
    }
    public function mysatcourselist()
    {
      $sat_vid = 'sat_vid';
       $sat_vid=ClassSubject::where('class_levels',$sat_vid)->get();
       $mycount = $sat_vid->count();
        return view('Sat',compact('sat_vid','mycount'));
    }

    public function mywaeccourselist()
    {
      $waec_vid = 'waec_vid';
       $waec_vid=ClassSubject::where('class_levels',$waec_vid)->get();
       $mycount = $waec_vid->count();
        return view('WAEC',compact('waec_vid','mycount'));
    }



}
