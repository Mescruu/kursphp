<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class NewPasswordController extends Controller
{
    public function validatePasswordRequest (Request $request){
        $user = DB::table('uzytkownik')->where('email', '=', $request->email)
            ->first();
//Check if the user exists
        if ($user->id <= 0) {
            return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
        }

//Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => str_random(60),
            'created_at' => Carbon::now()
        ]);

//Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
        } else {
            return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        }
    }


    private function sendResetEmail($email, $token)
    {
//Retrieve the user from the database
        $user = DB::table('uzytkownik')->where('email', $email)->select('imie', 'email')->first();
//Generate, the password reset link. The token generated is embedded in the link
        $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);
        try {

            Mail::to($email)->send(new SendEmail('reset password', $link));

            //Here send the link with CURL with an external email API
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function resetPassword(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:uzytkownik,email',
            'password' => 'required|confirmed'
        ]);

        //check if input is valid before moving on
        if ($validator->fails()) {
            return redirect()->back()->withErrors(['email' => 'Please complete the form']);
        }

        $password = $request->password;
// Validate the token
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();


// Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('auth.passwords.email');

        $user = User::where('email', $tokenData->email)->first();
// Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
//Hash and update the new password
        $user->haslo = \Hash::make($password);
        $user->update(); //or $user->save();

        //login the user immediately they change password successfully
        Auth::login($user);

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        //Send Email Reset Success Email
        if ($this->sendSuccessEmail($tokenData->email)) {
            return view('index');
        } else {
            return redirect()->back()->withErrors(['email' => trans('A Network Error occurred. Please try again.')]);
        }

    }
    private function sendSuccessEmail($email)
    {

            Mail::to($email)->send(new SendEmail('reset password', 'udalo sie'));

    }

}
