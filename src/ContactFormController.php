<?php

namespace KevinOrriss\ContactForm;

use Illuminate\Http\Request;

use Mail;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use ReCaptcha\ReCaptcha;
use Collective\Html\FormFacade as Form;

class ContactFormController extends Controller
{
    public function index()
    {
    	return view(env('CONTACT_FORM_VIEW', 'contact'));
    }

    public function post(Request $request)
    {
    	// get the data and its validation rules
        $data = [
            'email' => $request->input('email'),
            'message' => $request->input('message')];
        $rules = [
            'email' => 'bail|required|email',
            'message' => 'required'];
    	
        // build the validator
        $validator = Validator::make($data, $rules);

        // verify the reCAPTCHA with Google
        $recaptcha = new ReCaptcha(env('RECAPTCHA_SECRET'));
        $recaptcha_resp = $recaptcha->verify($request->input('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);

        // validate the request
        $recaptcha_failed = $recaptcha_resp->isSuccess() == FALSE;
        $validator_failed = $validator->fails();

        // if the reCAPTCHA failed then add a message to the validator
        if ($recaptcha_resp->isSuccess() == FALSE) {
            $validator->errors()->add('recaptcha', 'Prove you are not a robot.');
        }

        // if the validation failed then redirect back to the register page
        if ($recaptcha_failed || $validator_failed) {
            return redirect(route('contactform.get'))->withErrors($validator)->withInput();
        }

        // send the email to the webmaster
        $email = $data['email'];
        Mail::raw($data['message'], function ($m) use ($email) {
            $m->from($email, $email);
            $m->to(env('CONTACT_FORM_EMAIL'), env('CONTACT_FORM_NAME'));
            $m->subject('Message revieved from user');
        });

        // flash a success message back to the contact page
        Session::flash('success', 'Your message has been sent.');
        return redirect(route('contactform.get'));
    }
}
