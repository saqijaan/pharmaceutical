<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index()
    {
        //echo 'user index';
        //exit;
        $users = User::all();
        return view('users.index',['users'=>$users]);
    }


    public function login(Request $request)
    {
        $user = new User();

        if( $request->has('email'))
        {
            $user->checkUser($request->email,$request->password);
        }

        $users = User::find(Auth::user()->id);
        if ($request->ios_token != '')
        {
            $users->ios_token = $request->ios_token;
            $users->save();
        }

        if ($request->android_token != '')
        {
            $users->android_token = $request->android_token;
            $users->save();
        }




        return response()->json(['code'=>'1','message'=>'success','data'=>$users]);
    }


    public function logout()
    {
        Auth::logout();
        return response()->json(['code'=>'1','message'=>'User is successfully logout']);
    }

    public function signUp(Request $request)
    {

        $user = new User();
        $params = array();

        if($request->has('fb_id'))
        {
            $fb = $request->fb_id.'@facebook.com';
            if($user->userExists($fb))
            {
                $params['fb_id'] = $request->fb_id;
                $params['email'] = $fb;
                $params['password'] = bcrypt($request->password);
                if($request->has('user_name'))
                {
                    $params['name'] = ($request->user_name);
                }
            }

        }
        if($request->has('email'))
        {
            if($user->userExists($request->email))
            {
                $params['email'] = $request->email;
            }
        }
        if($request->has('password'))
        {
            $params['password'] = bcrypt($request->password);
        }

        $user1 = User::create($params);
        $user = User::find($user1->id);
        return response()->json(['code'=>'1','message'=>"success",'data'=>$user]);
    }

    public function editProfile(Request $request)
    {
        $user = new User();

        if( $request->has('email'))
        {
            $user->checkUser($request->email,$request->password);
        }
        $users = User::find(Auth::user()->id);

        if($request->has('changeEmail'))
        {
            if($user->userExists($request->changeEmail))
            {
                $users->email = $request->changeEmail;
            }
        }
        if($request->has('changePassword'))
        {
            $users->password = bcrypt($request->changePassword);
        }
        if($request->has('user_name'))
        {
            $users->name = ($request->user_name);
        }
        if($request->has('address'))
        {
            $users->address = ($request->address);
        }
        if($request->has('phone'))
        {
            $users->phone = ($request->phone);
        }
        if($request->has('zip'))
        {
            $users->zip = ($request->zip);
        }
        if($request->has('city'))
        {
            $users->city = ($request->city);
        }
        if($request->has('chat'))
        {
            $users->chat = ($request->chat);
        }
        if($request->has('daysession'))
        {
            $users->daysession = ($request->daysession);
        }
        if($request->has('inspection'))
        {
            $users->inspection = ($request->inspection);
        }
        if($request->has('gps'))
        {
            $users->gps = ($request->gps);
        }
        if($request->has('soscontact1'))
        {
            $users->soscontact1 = ($request->soscontact1);
        }
        if($request->has('latitude'))
        {
            $users->latitude = ($request->latitude);
        }
        if($request->has('longitude'))
        {
            $users->longitude = ($request->longitude);
        }
        if($request->has('soscontact2'))
        {
            $users->soscontact2 = ($request->soscontact2);
        }
        if($request->has('soscontact3'))
        {
            $users->soscontact3 = ($request->soscontact3);
        }
        if($request->has('triggertime'))
        {
            $users->triggertime = ($request->triggertime);
        }
        if($request->has('sos'))
        {
            $users->sos = ($request->sos);
        }

        if( $request->hasFile('image') )
        {

            /*$validator = Validator::make(Input::all(), [
                "image" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            ]);

            $val = array_values($validator->errors()->toArray());

            if( !empty($val))
            {
                return response()->json(['errors'=>$val[0]]);
            }*/

            $imageName = rand( 11111, 99999 ) . '.' . request()->image->getClientOriginalExtension();

            Storage::put('/user/'.$imageName,file_get_contents($request->file('image')));

            $users->image = $imageName;

        }
        $users->save();

        return response()->json(['code'=>'1','message'=>'success','data'=>$users]);
    }

    public function deleteUser(Request $request)
    {
        $user = new User();

        if( $request->has('email'))
        {
            $user->checkUser($request->email,$request->password);
        }
        $users = User::find(Auth::user()->id);

        if($users->image !="")
        {
            Storage::delete('/user/'.basename($users->image));
        }
        $horses = Horse::where('user_id',$users->id)->get();

        if( isset($horses) && count($horses) > 0 )
        {
            foreach ($horses as $horse)
            {
                $horse_follows = HorseFollow::where('horse_id',$horse->id)->orwhere('user_id',$users->id)->get();
                if( isset($horse_follows) && count($horse_follows) > 0 )
                {
                    foreach ($horse_follows as $horse_follow)
                    {
                        $horse_follow->delete();
                    }
                }

                $horse_invitations = HorseInvitation::where('horse_id',$horse->id)->where('user_id',$users->id)->get();
                if( isset($horse_follows) && count($horse_invitations) > 0 )
                {
                    foreach ($horse_invitations as $horse_invitation)
                    {
                        $horse_invitation->delete();
                    }
                }
                if($horse->image !="")
                {
                    Storage::delete('/horse/'.basename($horse->image));
                }
                $horse->delete();
            }
        }


        $users->delete();

        return response()->json(['code'=>'1','message'=>'success']);
    }

    public function forgot(Request $request)
    {
        if( $request->email != "" )
        {

            if( User::where('email',$request->get('email'))->count() > 0 )
            {
                return response()->json(['code'=>'1','message'=>'Email sent your mailbox !']);
            }
            else
            {
                return response()->json(['code'=>'0','message'=>'Email does not exists']);
            }

        }

    }

    public function sendSosMessage(Request $request)
    {
        $user = new User();

        if( $request->has('email'))
        {
            $user->checkUser($request->email,$request->password);
        }

        $user = User::find(Auth::user()->id);

        if( $user )
        {
            return response()->json(['code'=>'1','message'=>'success']);
        }
        else
        {
            return response()->json(['code'=>'0','message'=>'user does not exists']);
        }


    }


}
