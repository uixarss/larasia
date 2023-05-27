<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SiswaDetail;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\DataOrangTua;
use App\Models\Guru;
use App\Models\Dosen;
use App\Models\Pengampu;
use App\Models\Pegawai;
use App\Models\Mahasiswa;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Client as ClientG;
use Intervention\Image\Facades\Image;

class UserController extends BaseController
{
    public $successStatus = 200;

    // use IssueTokenTrait;

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            //'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addDays(30);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'email' => $user->email,
            'name' => $user->name
        ]);
    }



    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('Personal Access Token')->accessToken;
        $success['name'] =  $user->name;
        $success['email'] = $user->email;


        return $this->sendResponse($success, 'User register successfully.');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|different:old_password',
        ]);



        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashedPassword)) {

            if (!Hash::check($request->new_password, $hashedPassword)) {
                $user = Auth::user();
                $user->password = bcrypt($request->new_password);
                $user->updated_at = now();
                $user->save();

                return response()->json($user);
            } else {
                $data['error'] = true;
                $data['message'] = 'New password cannot be the same as old password.';
                return response()->json($data);
            }
        } else {
            $data['error'] = true;
            $data['message'] = 'Current password not match.';
            return response()->json($data);
        }



        // return response()->json($user);
    }

    public function updateProfileSiswa(Request $request)
    {
        $user = User::find(Auth::id());
        $siswa = Mahasiswa::where('user_id', Auth::id())->first();

        $this->validate($request,[
            'nama_mahasiswa' => 'required',
        ]);

        $siswa->update([
            // 'NISN' => $request->NISN,
            'nama_mahasiswa' => $request->nama_mahasiswa
        ]);
        $user->name = $request->nama_mahasiswa;
        $user->save();


        return response()->json($siswa);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request)
    {

        return response()->json($request->user());
    }

    public function getUserDetail(Request $request)
    {

        $mahasiswa = Mahasiswa::where('user_id', $request->user()->id)->with('prodi','kelas')->first();

        $success['user'] = $request->user();
        $success['mahasiswa'] = $mahasiswa;
        return response()->json($success);
    }

    public function getOrtuProfile(Request $request)
    {
        $ortu = DataOrangTua::where('user_id', $request->user()->id)->first();
        $data['user'] = $request->user();
        $data['ortu'] = $ortu;
        return response()->json($data);
    }

    public function userRefreshToken(Request $request)
    {

        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();



        $data = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'scope' => ''
        ];
        $requests = Request::create('oauth/token', 'POST', $data);
        $content = json_decode(app()->handle($requests)->getContent());

        return response()->json([
            'error' => false,
            'data' => [
                'meta' => [
                    'token' => $content->access_token,
                    'refresh_token' => $content->refresh_token,
                    'type' => 'Bearer'
                ]
            ]
        ]);
    }

    public function userRefreshTokens(Request $request)
    {

        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();



        $http = new ClientG;

        $response = $http->post('http://localhost:80/sim/public/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $request->refresh_token,
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function refreshToken()
    {
        $http = new ClientG;

        $response = $http->post('http://your-app.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => 'the-refresh-token',
                'client_id' => 'client-id',
                'client_secret' => 'client-secret',
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);
    }

    public function refresh()
    {
        $token = Auth::guard()->refresh();

        return response()->json()([
            'status' => 'ok',
            'token' => $token,
            'expires_in' => Auth::guard()->factory()->getTTL() * 60
        ]);
    }

    public function refreshTokens(Request $request)
    {
        $this->validate($request, [
            'refresh_token' => 'required'
        ]);

        return $this->issueToken($request, 'refresh_token');
    }

    public function dataSiswa()
    {
        $ortu = DataOrangTua::where('user_id', Auth::id())->first();

        $data_siswa = Siswa::where('id', $ortu->siswa_id)->first();
        $data_siswa_detail = SiswaDetail::where('siswa_id', $ortu->siswa_id)->first();

        $data['profile_siswa'] = $data_siswa;
        $data['profile_siswa_detail'] = $data_siswa_detail;

        return response()->json($data);
    }

    public function profileGuru()
    {
        $guru = Dosen::where('user_id', Auth::id())->first();

        return response()->json($guru);
    }

    public function profilePegawai()
    {
        $guru = Guru::where('user_id', Auth::id())->with('mapel')->first();
        $pegawai = Pegawai::where('user_id', Auth::id())->first();

        if ($guru != null) {

            return response()->json($guru);
        } elseif($pegawai != null){

            return response()->json($pegawai);
        }
        
    }

    public function updateAvatareSiswa(Request $request)
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension();
            // $filename =  $siswa->NIS . '_' . $siswa->nama_depan . '.' .$extension;
            $filename = $siswa->NIS . '.' .$extension;
            if (File::exists($photo)) {
              $photo->move('admin/assets/images/users/siswa/',$filename);
              File::delete($photo);
            }

            $siswa->update([
                'photo' =>  $filename
            ]);

        }
        return response()->json($siswa);
    }

    public function updateAvatareGuru(Request $request)
    {
        $guru = Guru::where('user_id', Auth::id())->first();

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension();
            $filename = $guru->nama_lengkap. '_'.$guru->NIP. '.' .$extension;
            if (File::exists($photo)) {
              $photo->move('admin/assets/images/users/guru/',$filename);
              File::delete($photo);
            }

            $guru->update([
                'photo' => 'admin/assets/images/users/guru/' . $filename
            ]);

        }
        return response()->json($guru);
    }
}
