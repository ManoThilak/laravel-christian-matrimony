<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\OTPVerificationController;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Models\Member;
use App\Models\Package;
use App\Models\Setting;
use App\Models\EmailTemplate;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Mail;
use App\Mail\EmailManager;
use Notification;
use App\Notifications\DbStoreNotification;
use App\Utility\EmailUtility;
use App\Utility\SmsUtility;
use App\Models\SpiritualBackground;
use App\Models\PhysicalAttribute;
use App\Models\Address;
use App\Models\Religion;
use App\Models\MaritalStatus;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm()
    {
        $religions          = Religion::all();
        $marital_statuses   = MaritalStatus::all();
        $countries          = Country::where('id',101)->get();
        $states             = State::all();
        $cities             = City::all();

      
        return view('frontend.user_registration', compact('religions','marital_statuses','countries','states','cities'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'  => ['required', 'string', 'max:255','regex:/^[a-zA-Z0-9\s\-\.\'\,\&]+$/'],
            'last_name'   => ['required', 'string', 'max:255','regex:/^[a-zA-Z0-9\s\-\.\'\,\&]+$/'],
            'password'    => ['required', 'string', 'min:8', 'confirmed'],
            'email'       => ['required', 'digits:10'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $approval = get_setting('member_approval_by_admin') == 1 ? 0 : 1;
        // if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $user = User::create([
                'first_name'  => $data['first_name'],
                'last_name'   => $data['last_name'],
                'email'       => $data['email'],
                'phone'       => $data['email'],
                'password'    => Hash::make($data['password']),
                'code'        => unique_code(),
                'approved'    => $approval,
                'membership'    => 2,
                'photo'    => $data['photo'],
            ]);
        // }
        // else{
        //     if(addon_activation('otp_system'))
        //     {
        //         $user = User::create([
        //             'first_name'  => $data['first_name'],
        //             'last_name'   => $data['last_name'],
        //             'phone'       => '+'.$data['country_code'].$data['phone'],
        //             'password'    => Hash::make($data['password']),
        //             'code'        => unique_code(),
        //             'approved'    => $approval,
        //             'verification_code' => rand(100000, 999999)
        //         ]);
        //     }
        // }
        if(addon_activation('referral_system'))
        {
          if($data['referral_code'] != null){
              $reffered_user = User::where('code',$data['referral_code'])->first();
              if($reffered_user != null){
                  $user->referred_by = $reffered_user->id;
                  $user->save();
              }
          }
        }

        $member                             = new Member;
        $member->user_id                    = $user->id;
        $member->save();
        $member->marital_status_id          = $data['marital_status'];
        $member->gender                     = $data['gender'];
        $member->on_behalves_id             = $data['on_behalf'];
        $member->job                        = $data['job'];
        $member->salary                     = $data['salary'];
        $member->religion                        = $data['religion'];
        $member->caste                     = $data['caste'];
        $member->birthday                   = date('Y-m-d', strtotime($data['date_of_birth']));

        $package                                = Package::where('id',1)->first();
        $member->current_package_id             = $package->id;
        $member->remaining_interest             = $package->express_interest;
        $member->remaining_photo_gallery        = $package->photo_gallery;
        $member->remaining_contact_view         = $package->contact;
        $member->remaining_profile_image_view   = $package->profile_image_view;
        $member->remaining_gallery_image_view   = $package->gallery_image_view;
        $member->auto_profile_match             = $package->auto_profile_match;
        $member->package_validity               = Date('Y-m-d', strtotime($package->validity." days"));
        $member->registered             = 1;
        $member->save();


        // // $spiritual_backgrounds = SpiritualBackground::where('user_id', $id)->first();
        // //  if(empty($spiritual_backgrounds)){
        //      $spiritual_backgrounds          = new SpiritualBackground;
        //      $spiritual_backgrounds->user_id = $user->id;
        // //  }
        
        //  $spiritual_backgrounds->religion_id        = $data['member_religion_id'];
        //  $spiritual_backgrounds->caste_id           = $data['member_caste_id'];
        //  $spiritual_backgrounds->sub_caste_id       = 1;


        // $spiritual_backgrounds->save();


        // $physical_attribute = PhysicalAttribute::where('user_id', $id)->first();
        //  if(empty($physical_attribute)){
            $physical_attribute = new PhysicalAttribute;
            $physical_attribute->user_id = $user->id;
        //  }

        $physical_attribute->complexion    = $data['complexion'];
        $physical_attribute->disability    = $data['disability'];

        $physical_attribute->save();



        // $address = Address::where('user_id', $id)->where('type',$request->address_type)->first();
        //  if(empty($address)){
             $address = new Address;
             $address->user_id = $user->id;
        //  }
        //  if($address_type == 'present'){
            $address->country_id   = 101;
            $address->state_id     = $data['permanent_state_id'];
            $address->city_id      = $data['permanent_city_id'];
           // $address->postal_code  = $request->permanent_postal_code;
        //  }
        $address->type             = 'present';
        $address->save();



            
        if(addon_activation('otp_system') && $data['phone'] != null)
        {
            $otpController = new OTPVerificationController;
            $otpController->send_code($user);
        }

        // Email to member
        if($data['email'] != null  && env('MAIL_USERNAME') != null)
        {
            $account_oppening_email = EmailTemplate::where('identifier','account_oppening_email')->first();
            if($account_oppening_email->status == 1)
            {
                EmailUtility::account_oppening_email($user->id, $data['password']);
            }
        }

        return $user;

    }

    public function register(Request $request)
    {
        // $file = $request->image;
        // // @dd($file);
        // // $path = $file->store('uploads/all', 'local');
        // $path = $request->file('image')->store('uploads/all', 'local');

        // // if($data['file']){
        //     // $files = $data['image'];
             
        //     // //  $path = $files->store('uploads/all', 'local');
        //     //  $name='ki';  
            
        //     // $files->move('uploads',$name); 
        //     @dd($path);
        //     // Save file information to the database
        //     // $originalName = $file->getClientOriginalName();
        // // }


        // if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if(User::where('email', $request->email)->first() != null){
                flash(translate('Phone already exists.'));
                return back();
            }
            $string = $request->email;
            $length = strlen($string);  
            if($length > 10){
                flash(translate('Phone Number cannot be greater than 10 Digits'));
                return back();
            }
        // }
        // elseif (User::where('phone', '+'.$request->country_code.$request->phone)->first() != null) {
        //     flash(translate('Phone already exists.'));
        //     return back();
        // }

        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        if(get_setting('member_approval_by_admin') != 1 )
        {
          $this->guard()->login($user);
        }

        try{
            $notify_type = 'member_registration';
            $id = unique_notify_id();
            $notify_by = $user->id;
            $info_id = $user->id;
            $message = translate('A new member has been registered to your system. Name: ').$user->first_name.' '.$user->last_name;
            $route = route('members.index', $user->membership);

            Notification::send(User::where('user_type', 'admin')->first(), new DbStoreNotification($notify_type, $id, $notify_by, $info_id, $message, $route));
        }
        catch(\Exception $e){
            // dd($e);
        }

        if($user->email != null  && env('MAIL_USERNAME') != null && (get_email_template('account_opening_email_to_admin','status') == 1))
        {
            $admin = User::where('user_type', 'admin')->first();
            EmailUtility::account_opening_email_to_admin($user, $admin);
        }


        if($user->email != null){
            if(get_setting('email_verification') != 1){
                $user->email_verified_at = date('Y-m-d H:m:s');
                $user->save();
                flash(translate('Registration successfull.'))->success();
            }
            else {
                event(new Registered($user));
                flash(translate('Registration successfull. Please verify your email.'))->success();
            }
        }
        if($user->phone != null){
         // flash(translate('Registration successfull. Please verify your phone number.'))->success();
        }

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        if(get_setting('member_approval_by_admin') == 1 )
        {
          return redirect()->route('home');
        }
        else {
          return redirect()->route('dashboard');
         // return redirect()->route('packages');
        }
    }
}
