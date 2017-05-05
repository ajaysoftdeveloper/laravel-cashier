<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller {

	public function subscription(){
		return view('subscription');
	}

	public function postSubscription(Request $request){
		$user = new User;
	    $user->name  = $request->name;	    
	    $user->email = $request->email;
	    $user->password = bcrypt($request->password);
	    $user->save();
	    $user->newSubscription('main',$request->subscription)->create($request->token);
	    if ($user->subscribed('main')) {
   			return response()->json(['msg'=>'Successfully subscribed']);
		}
   		return response()->json(['msg'=>'Oops there is something error with your input']);
	    	
	}

}