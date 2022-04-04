<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;


class MyController extends Controller
{
    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function update(Request $request){

        $valid = $request->validate([
            'id' =>''

        ]);
        DB::table('form')->where('id', $request['id']) ->update([ 'status'     => 1 ]);
        return redirect()->route('manager');

    }
    public function home(){
        if (session()->get('user_id')!=null){

            $user=User::find(session()->get('user_id'));
            if ($user->role!=2)
                return redirect()->route('manager');
            else
                return redirect()->route('form');
       }
        else{;
            return view('login');
        }
    }
    public function test(){


    }
    public function logout(){
        session()->remove('user_id');
        session()->remove('timer');
        return redirect()->route('login');

    }
    public function login(){
        return view('login');
    }
    public function manager(){
        if (session()->has('user_id')){
        $manager=User::find(session()->get('user_id'));
        if ($manager->role!=2){
        $forms=Form::all();
        $users=User::all();
        return view('managersPanel', compact('forms', $forms), compact('users', $users), compact('manager', $manager));}
        else return redirect()->route('home');}
        else return redirect()->route('home');

    }
    public function sign(){
        return view('sign');
    }
    public function user(Request $request){
        if (session()->has('user_id'))   {
            $manager=User::find(session()->get('user_id'));
            if ($manager->role==2)
                 return view('user');
            else
                 return redirect()->route('home');
        }
        else return redirect()->route('home');

    }
    public function register(Request $request){
        $valid = $request->validate([
            'login' =>'Required|min:5|max:50',
            'password' =>'Required|min:5|max:200',
            'name' =>'Required|min:5|max:200',
            'email' =>'Required|min:5|max:200',


        ]);
        if($valid){
            User::create($valid);
            return redirect()->route('login');
        }
    }
    public function request_check(Request $request){

        $form=Form::where('user_id',session()->get('user_id'))->get();
        $totalDuration=null;
        if (Form::where('user_id',session()->get('user_id'))->get())
        {
           // dd("eeeeeeeeeeeee");
            $totalDuration=200000000000000;
        }

        ;
        foreach ($form as $f){

            $todayDate = Carbon::now();
           // $check = Carbon::now()->between($todayDate,$f->created_at,  true);
            $totalDuration = $todayDate->diffInSeconds($f->created_at);


        }
        $valid = $request->validate([

            'title' =>'Required|min:5|max:50',
            'message' =>'Required|min:5|max:200',
            'file'=>'required',
            'file.*' =>'|mimes:jpeg,png,bmp,tiff'


        ]);
        if ($totalDuration>86400) {
            if ($request->hasfile('file')) {

                foreach ($request->file('file') as $image) {

                    $name = $image->getClientOriginalName();
                    $image->move(public_path() . '/images/', $name);
                    $data [] = $name;
                    $form = new Form();
                    $form->filename = json_encode($data);
                    $form->title = $request['title'];
                    $form->message = $request['message'];
                    $form->user_id = $request->session()->get('user_id');
                    $form->save();
                    //dd($request);

                }
            };
            session()->put('timer', false);
            return back()->with('success', 'Your images has been successfully');
        }
        else{
            session()->put('timer', true);
            return redirect()->route('form');
        }
    }
    public function comments_check(Request $request){
        $valid = $request->validate([
            'login' =>'Required|min:5|max:50',
            'password' =>'Required|min:5|max:200',

        ]);


        if($valid){
            $logins=User::all();
           // dump($logins);
            foreach ($logins as $login){
                if ($login->login===$request['login']){
                    if ($login->password===$request['password']){
                        $request->session()->put('user_id',$login->id);
                       if ($login->role!=2)
                           return redirect()->route('manager');
                       else
                           return redirect()->route('form');
                    }
                }

            }
        }

}
}
