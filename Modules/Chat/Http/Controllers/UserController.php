<?php

namespace Modules\Chat\Http\Controllers;

use App\Models\User;
use App\Traits\ImageStore;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Chat\Http\Requests\UserUpdateRequest;
use Modules\Chat\Services\UserService;
use Modules\UserActivityLog\Traits\LogActivity;

class UserController extends Controller
{
    use ImageStore;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('chat::index');
    }

    public function create()
    {
        return view('chat::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('chat::show');
    }

    public function edit($id)
    {
        return view('chat::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'keywords' => 'required',
        ]);

        if ($validation->fails()){
            Toastr::error(__('validation.required', ['attribute' => 'Keywords']));
            return redirect()->back();
        }

        $keywords = $request->keywords;
        $users = $this->userService->search($keywords)->load('activeStatus');

        return view('chat::user.search_result', compact('keywords', 'users'));

    }

    public function profile()
    {
        return view('chat::user.profile');
    }

    public function profileUpdate(UserUpdateRequest $request)
    {
        if ($request->profile_avatar != null) {
            $request['avatar'] = $this->saveAvatarImage($request->profile_avatar);
        }

        try{
            $this->userService->profileUpdate($request->except('_token','profile_avatar'));
            Toastr::success(__('Data successfully updated!'));
            return redirect()->back();
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error('Something happened Wrong!', 'Error!!');
            return redirect()->back();
        }
    }

    public function passwordUpdate(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'current_password' => 'min:8|required',
            'password' => 'min:8|required|confirmed',
        ]);

        if ($validation->fails()){
            return redirect()->back()->withErrors($validation);
        }

        if (!\Hash::check($request->current_password, auth()->user()->password)) {
            Toastr::error(__('Oops! your current password is wrong!'));
            return redirect()->back();
        }

        auth()->user()->update([
            'password' => bcrypt($request->password)
        ]);
        Toastr::success(__('Your password updated!'));
        return redirect()->back();
    }

    public function passwordResetLink(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'email' => 'email|required',
        ]);

        $user = User::where('email', '=', $request->email)
            ->exists();
        if (count($user) < 1) {
            return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
        }

        \DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => \Str::random(60),
            'created_at' => Carbon::now()
        ]);

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
        $user = DB::table('users')->where('email', $email)->select('firstname', 'email')->first();

        try {
            \Mail::send([], [], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Password Reset')
                    ->setBody('Hi, welcome user!')
                    ->setBody('<h1>Hi, welcome user!</h1><br> <a href="">{{ $token}}</a>', 'text/html'); // for HTML rich messages
            });
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function changeStatus($type)
    {
        if ($type > 3){
            Toastr::error(__('Oops! Something went wrong!'));
            return redirect()->to(request()->url);
        }
        userStatusChange(auth()->id(), $type);
        Toastr::success(__('Your Status successfully updated!'));
        return redirect()->to(request()->url);
    }

    public function blockAction($type, $user)
    {
        try{
            $this->userService->blockAction($type, $user);
            Toastr::success(__('You just '. $type. ' this user!'));
            return redirect()->route('chat.index');
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error('Something happened Wrong!', 'Error!!');
            return redirect()->back();
        }
    }

    public function blockedUsers()
    {
        $users = $this->userService->allBlockedUsers();
        return view('chat::user.blocked', compact('users'));
    }

    public function settings()
    {
        return view('chat::settings');
    }

    public function invitationRequirementSetting(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'invitation_requirement' => 'required',
        ]);

        if ($validation->fails()){
            Toastr::error($validation->messages());
            return redirect()->back();
        }
        app('general_settings')->put('chat_invitation_requirement', $request->invitation_requirement);
        Toastr::success('Invitation requirement setting updated!','Success');
        return redirect()->back();
    }

    public function settingsUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'pusher_app_id' => 'required_if:chat_method,pusher',
            'pusher_app_key' => 'required_if:chat_method,pusher',
            'pusher_app_secret' => 'required_if:chat_method,pusher',
            'pusher_app_cluster' => 'required_if:chat_method,pusher',
        ]);

        if ($validation->fails()){
            Toastr::error($validation->messages());
            return redirect()->back();
        }

        try {
            app('general_settings')->put([
                "chatting_method" => $request['chat_method'],
            ]);

            if ($request->chat_method == 'pusher'){
                $this->updateDotEnv('BROADCAST_DRIVER','pusher');
                foreach ($request->except('_token','chat_method') as $key => $val) {
                    $this->putPermanentEnv(strtoupper($key), $val);
                }
            }else{
                $this->updateDotEnv('BROADCAST_DRIVER','null');
            }
            Toastr::success(__('Chat method has been updated Successfully'));
            return redirect()->back();
        }catch(\Exception $e){
            LogActivity::errorLog($e->getMessage());
            Toastr::error('Something went Wrong!', 'Error!!');
            return redirect()->back();
        }
    }

    public function putPermanentEnv($key, $value)
    {
        $path = app()->environmentFilePath();

        $escaped = preg_quote('='.env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));
    }

    protected function updateDotEnv($key, $newValue, $delim='')
    {

        $path = base_path('.env');
        // get old value from current env
        $oldValue = env($key);
        if ($oldValue === null){
            $oldValue = 'null';
        }

        // was there any change?
        if ($oldValue === $newValue) {
            return;
        }

        // rewrite file content with changed data
        if (file_exists($path)) {
            // replace current value with new value
            file_put_contents(
                $path, str_replace(
                    $key.'='.$delim.$oldValue.$delim,
                    $key.'='.$delim.$newValue.$delim,
                    file_get_contents($path)
                )
            );
        }
    }
}
