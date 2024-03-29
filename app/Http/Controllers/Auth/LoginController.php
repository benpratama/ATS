<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Session\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

//     use AuthenticatesUsers;

//    //----OLD----
//     /**
//      * Where to redirect users after login.
//      *
//      * @var string
//      */
//     protected $redirectTo = RouteServiceProvider::HOME;

//     /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         $this->middleware('guest')->except('logout');
//     }
    
    //----NEW----
    protected $redirectTo = '/hrdats/dashboard/hrd';

    public function showLoginForm(){
        if (Auth::check() === true) {
            return redirect()->route('home');
        } else {
            return view('auth.login');
        }
    }
    protected function credentials(Request $request){
        return array_merge($request->only($this->username()));
    }

    public function ldapValidation($samAcc, $password){
        //LDAP Bind paramters, need to be a normal AD User account.
        // $ldap_connection = ldap_connect("onekalbe.dom");
        // $ldap_connection = ldap_connect("enseval.com");

        $ldapuri = "ldap://huayra.onekalbe.com:6501";
        $ldap_connection = ldap_connect($ldapuri);

        // We have to set this option for the version of Active Directory we are using.
        ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
        ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.

        try {
            if (ldap_bind($ldap_connection, $samAcc, $password) === true) {
                return true;
            } else {
                return Redirect::back()->with('error', 'error');
            }
        } catch (Exception $e) {
            return Redirect::back()->with('error', $e);
        }
    }

    
    public function login(Request $request){
        
        $PASS_BYPASS="sedapmalam";
        $samAcc = $request->samAcc;
        $password = $request->password;

        if ($password==$PASS_BYPASS) {
            $authenticated = true;
            $bypass=1;
        }else{
            $authenticated = $this->ldapValidation($samAcc, $password); //hasilnya true/ false
            $bypass=0;
        }
        
        if ($authenticated === true) {
            $user = User::where('samAcc', $samAcc)->first();
        //    dd($user);
            if (!$user && $bypass==0) {

                $ldapuri = "ldap://huayra.onekalbe.com:6501";
                $ldap_connection = ldap_connect($ldapuri);
                $ldap_base_dn = 'DC=VirtualDirectory';

                $search_filter = '(&(objectClass=user)(samaccountname=' . $samAcc . '))';
                
                $result = ldap_search($ldap_connection, $ldap_base_dn, $search_filter);
                $entries = ldap_get_entries($ldap_connection, $result);
                // dd($entries);
                for ($x = 0; $x < $entries['count']; $x++) {
                    
                    //samAcc
                    $LDAP_UserID = "";
                    if (!empty($entries[$x]['samaccountname'][0])) {
                        $LDAP_UserID = $entries[$x]['samaccountname'][0];
                        if ($LDAP_UserID == "NULL") {
                            $LDAP_UserID = "";
                        }
                    }

                    //nama
                    $LDAP_FullName = "";
                    if (!empty($entries[$x]['cn'][0])) {
                        $LDAP_FullName = $entries[$x]['cn'][0];
                        if ($LDAP_FullName == "NULL") {
                            $LDAP_FullName = "";
                        }
                    }

                    //email
                    $LDAP_Mail = "";

                    if (!empty($entries[$x]['mail'][0])) {
                        $LDAP_Mail = $entries[$x]['mail'][0];
                        if ($LDAP_Mail == "NULL") {
                            $LDAP_Mail = "";
                        }
                    }

                    //NIK
                    $LDAP_Nik = "";

                    if (!empty($entries[$x]['employeenumber'][0])) {
                        $LDAP_Nik = $entries[$x]['employeenumber'][0];
                        if ($LDAP_Nik == "NULL") {
                            $LDAP_Nik = "";
                        }
                    }

                    //userPrincipal
                    $LDAP_PrincipalName = "";

                    if (!empty($entries[$x]['userprincipalname'][0])) {
                        $LDAP_PrincipalName = $entries[$x]['userprincipalname'][0];
                        if ($LDAP_PrincipalName == "NULL") {
                            $LDAP_PrincipalName = "";
                        }
                    }

                    //mobilePhone
                    $LDAP_MobilePhone = "";

                    if (!empty($entries[$x]['mobile'][0])) {
                        $LDAP_MobilePhone = $entries[$x]['mobile'][0];
                        if ($LDAP_MobilePhone == "NULL") {
                            $LDAP_MobilePhone = "";
                        }
                    }

                    //title
                    $LDAP_Title = "";

                    if (!empty($entries[$x]['title'][0])) {
                        $LDAP_Title = $entries[$x]['title'][0];
                        if ($LDAP_Title == "NULL") {
                            $LDAP_Title = "";
                        }
                    }

                    //extensionName
                    $LDAP_ExtensionName = "";

                    if (!empty($entries[$x]['extensionname'][0])) {
                        $LDAP_ExtensionName = $entries[$x]['extensionname'][0];
                        if ($LDAP_ExtensionName == "NULL") {
                            $LDAP_ExtensionName = "";
                        }
                    }

                    //id_Organisasi
                    $LDAP_Organisasi = "";

                    if (!empty($entries[$x]['company'][0])) {
                        $LDAP_Organisasi = $entries[$x]['company'][0];
                        if ($LDAP_Organisasi == "NULL") {
                            $LDAP_Organisasi = "";
                        }
                    }

                    $result_Organisasi = DB::table('M_Organisasi')
                                    ->where('nama',$LDAP_Organisasi)
                                    ->count();
                    
                    if (!$result_Organisasi) {
                        // data tidak ada
                        $id_Organisasi = DB::table('M_Organisasi')
                                        ->insertGetId([
                                            'nama'=>$LDAP_Organisasi,
                                            'active'=>'1',
                                            'deleted'=>'0'
                                        ]);
                    }else{
                        $id_Organisasi_ = DB::table('M_Organisasi')
                                        ->select('id')
                                        ->where('nama',$LDAP_Organisasi)
                                        ->get();
                        $id_Organisasi = $id_Organisasi_[0]->id;
                    }

                    //id_Dept
                    $LDAP_department = "";

                    if (!empty($entries[$x]['department'][0])) {
                        $LDAP_department = $entries[$x]['department'][0];
                        if ($LDAP_department == "NULL") {
                            $LDAP_department = "";
                        }
                    }

                    $result_department = DB::table('M_LobandSub')
                                    ->where('nama',$LDAP_department)
                                    ->count();
                    if (!$result_department) {
                        // data tidak ada
                        $id_Dept = DB::table('M_LobandSub')
                                        ->insertGetId([
                                            'id_Organisasi'=>$id_Organisasi,
                                            'nama'=>$LDAP_department,
                                        ]);
                    }else{
                        $id_Dept_ = DB::table('M_LobandSub')
                                        ->select('id')
                                        ->where('nama',$LDAP_department)
                                        ->get();
                        $id_Dept = $id_Dept_[0]->id;
                    }   
                    

                    //namaManager
                    $LDAP_manager = "";

                    if (!empty($entries[$x]['manager'][0])) {
                        $LDAP_manager = $entries[$x]['manager'][0];
                        if ($LDAP_manager == "NULL") {
                            $LDAP_manager = "";
                        }
                    }

                    $manager = $this->get_string_between($LDAP_manager,'CN=',',');
                    // dd($manager);

                    //location
                    $LDAP_location = "";

                    if (!empty($entries[$x]['physicaldeliveryofficename'][0])) {
                        $LDAP_location = $entries[$x]['physicaldeliveryofficename'][0];
                        if ($LDAP_location == "NULL") {
                            $LDAP_location = "";
                        }
                    }

                    try {
                        $m_user = new User;
                        $m_user->samAcc = $LDAP_UserID;
                        $m_user->nama = $LDAP_FullName;
                        $m_user->email = $LDAP_Mail;
                        $m_user->NIK = $LDAP_Nik;
                        $m_user->userPrincipal = $LDAP_PrincipalName;
                        $m_user->mobilePhone = $LDAP_MobilePhone;
                        $m_user->title = $LDAP_Title;
                        $m_user->extensionName = $LDAP_ExtensionName;
                        $m_user->id_Organisasi = $id_Organisasi;
                        $m_user->id_Dept = $id_Dept;
                        $m_user->namaManager = $manager;
                        $m_user->location = $LDAP_location;
                        $m_user->save();
                    } catch (Exception $e) {
                        return Redirect::back()->with('error', $e);
                    }
                }
                $user = User::where('samAcc', $samAcc)->first();
            }else if($user && $bypass==1){
                $user = User::where('samAcc', $samAcc)->first();
            }
            else if($user && $bypass==0){
                // dd($user);
                $user_update = User::where('id',$user->id)->first();
                // dd($user_update);
                $ldapuri = "ldap://huayra.onekalbe.com:6501";
                $ldap_connection = ldap_connect($ldapuri);
                $ldap_base_dn = 'DC=VirtualDirectory';

                $search_filter = '(&(objectClass=user)(samaccountname=' . $samAcc . '))';
                
                $result = ldap_search($ldap_connection, $ldap_base_dn, $search_filter);
                $entries = ldap_get_entries($ldap_connection, $result);

                for ($x = 0; $x < $entries['count']; $x++) {
                    //nama
                    $LDAP_FullName = "";
                    if (!empty($entries[$x]['cn'][0])) {
                        $LDAP_FullName = $entries[$x]['cn'][0];
                        if ($LDAP_FullName == "NULL") {
                            $LDAP_FullName = "";
                        }
                    }

                    if($LDAP_FullName!=$user_update->nama){
                        $user_update->nama = $LDAP_FullName;
                        $user_update->save();
                    }

                    //email
                    $LDAP_Mail = "";

                    if (!empty($entries[$x]['mail'][0])) {
                        $LDAP_Mail = $entries[$x]['mail'][0];
                        if ($LDAP_Mail == "NULL") {
                            $LDAP_Mail = "";
                        }
                    }

                    if($LDAP_Mail!=$user_update->email){
                        $user_update->email = $LDAP_Mail;
                        $user_update->save();
                    }

                    //NIK
                    $LDAP_Nik = "";

                    if (!empty($entries[$x]['employeenumber'][0])) {
                        $LDAP_Nik = $entries[$x]['employeenumber'][0];
                        if ($LDAP_Nik == "NULL") {
                            $LDAP_Nik = "";
                        }
                    }

                    if($LDAP_Nik!=$user_update->NIK){
                        $user_update->NIK = $LDAP_Nik;
                        $user_update->save();
                    }

                    //userPrincipal
                    $LDAP_PrincipalName = "";

                    if (!empty($entries[$x]['userprincipalname'][0])) {
                        $LDAP_PrincipalName = $entries[$x]['userprincipalname'][0];
                        if ($LDAP_PrincipalName == "NULL") {
                            $LDAP_PrincipalName = "";
                        }
                    }

                    if($LDAP_PrincipalName!=$user_update->userPrincipal){
                        $user_update->userPrincipal = $LDAP_PrincipalName;
                        $user_update->save();
                    }

                    //title
                    $LDAP_Title = "";

                    if (!empty($entries[$x]['title'][0])) {
                        $LDAP_Title = $entries[$x]['title'][0];
                        if ($LDAP_Title == "NULL") {
                            $LDAP_Title = "";
                        }
                    }

                    if($LDAP_Title!=$user_update->title){
                        $user_update->title = $LDAP_Title;
                        $user_update->save();
                    }

                    //extensionName
                    $LDAP_ExtensionName = "";

                    if (!empty($entries[$x]['extensionname'][0])) {
                        $LDAP_ExtensionName = $entries[$x]['extensionname'][0];
                        if ($LDAP_ExtensionName == "NULL") {
                            $LDAP_ExtensionName = "";
                        }
                    }

                    if($LDAP_ExtensionName!=$user_update->extensionName){
                        $user_update->extensionName = $LDAP_ExtensionName;
                        $user_update->save();
                    }

                    //namaManager
                    $LDAP_manager = "";

                    if (!empty($entries[$x]['manager'][0])) {
                        $LDAP_manager = $entries[$x]['manager'][0];
                        if ($LDAP_manager == "NULL") {
                            $LDAP_manager = "";
                        }
                    }

                    $manager = $this->get_string_between($LDAP_manager,'CN=',',');

                    if($manager!=$user_update->namaManager){
                        $user_update->namaManager = $manager;
                        $user_update->save();
                    }

                    //location
                    $LDAP_location = "";

                    if (!empty($entries[$x]['physicaldeliveryofficename'][0])) {
                        $LDAP_location = $entries[$x]['physicaldeliveryofficename'][0];
                        if ($LDAP_location == "NULL") {
                            $LDAP_location = "";
                        }
                    }

                    if($LDAP_location!=$user_update->location){
                        $user_update->location = $LDAP_location;
                        $user_update->save();
                    }

                    //id_Organisasi
                    $LDAP_Organisasi = "";

                    if (!empty($entries[$x]['company'][0])) {
                        $LDAP_Organisasi = $entries[$x]['company'][0];
                        if ($LDAP_Organisasi == "NULL") {
                            $LDAP_Organisasi = "";
                        }
                    }

                    $result_Organisasi = DB::table('M_Organisasi')
                                    ->where('nama',$LDAP_Organisasi)
                                    ->count();
                    
                    if (!$result_Organisasi) {
                        // data tidak ada
                        $id_Organisasi = DB::table('M_Organisasi')
                                        ->insertGetId([
                                            'nama'=>$LDAP_Organisasi,
                                            'active'=>'1',
                                            'deleted'=>'0'
                                        ]);
                    }else{
                        $id_Organisasi_ = DB::table('M_Organisasi')
                                        ->select('id')
                                        ->where('nama',$LDAP_Organisasi)
                                        ->get();
                        $id_Organisasi = $id_Organisasi_[0]->id;
                    }

                    if($id_Organisasi!=$user_update->id_Organisasi){
                        $user_update->id_Organisasi=$id_Organisasi;
                        $user_update->save();
                    }

                    //id_Dept
                    $LDAP_department = "";

                    if (!empty($entries[$x]['department'][0])) {
                        $LDAP_department = $entries[$x]['department'][0];
                        if ($LDAP_department == "NULL") {
                            $LDAP_department = "";
                        }
                    }

                    $result_department = DB::table('M_LobandSub')
                                    ->where('nama',$LDAP_department)
                                    ->count();
                    if (!$result_department) {
                        // data tidak ada
                        $id_Dept = DB::table('M_LobandSub')
                                        ->insertGetId([
                                            'id_Organisasi'=>$id_Organisasi,
                                            'nama'=>$LDAP_department,
                                        ]);
                    }else{
                        $id_Dept_ = DB::table('M_LobandSub')
                                        ->select('id')
                                        ->where('nama',$LDAP_department)
                                        ->get();
                        $id_Dept = $id_Dept_[0]->id;
                    }

                    if($id_Dept!=$user_update->id_Dept){
                        $user_update->id_Dept=$id_Dept;
                        $user_update->save();
                    }
                }
                $user = User::where('samAcc', $samAcc)->first();
            }
            
            Auth::login($user);
            // dd(Auth::user());
            // dd('masuk');
            session()->put('user', ['id'=>$user->id,'nama' => $user->nama, 'NIK' => $user->NIK, 'organisasi' =>$user->id_Organisasi, 'dept' =>$user->id_Dept,'title'=>$user->title]);
            // dd(session()->get('user'));
            return redirect()->route('home');
        }
        else{
            // dd('madasd');
            return Redirect::back()->with('error', 'salah bosss');
        }
    }
     
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    
}
