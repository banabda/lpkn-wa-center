<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use App\Models\User;
use App\Models\UserCred;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function userApproval()
    {
        $users = User::role('user')->get();
        $creds = Credential::all();
        $userCreds = [];
        $roles = Role::all();
        foreach ($users as $usr) {
            $userc = UserCred::with('user', 'credential')->where('user_id', $usr->id)->first();
            $usr->cred = isset($userc->credential_id) ? $userc->credential_id : null;
            $usr->active = isset($userc->active) ? $userc->active : null;
            array_push($userCreds, $usr);
        }

        return response()->json([
            'creds' => $creds,
            'users' => $userCreds,
            'roles' => $roles
        ]);
    }

    public function assignUser(Request $request)
    {
        $user = UserCred::updateOrCreate([
            "user_id" => isset($request->user) ? $request->user : auth()->id()
        ], [
            "credential_id" => $request->cred,
            "active" => 1
        ]);
        return response($user, 201);
    }

    public function requestCred(Request $request)
    {
        $user = UserCred::updateOrCreate([
            "user_id" => isset($request->user) ? $request->user : auth()->id()
        ], [
            "credential_id" => $request->cred,
            "active" => 1
        ]);
        return back();
    }

    public function activeUser($id)
    {
        $user = UserCred::where('user_id', $id)->first();
        $user->update(['active' => !$user->active]);
        return response($user, 200);
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user = User::firstOrCreate([
            'email' => $request->email
        ], $data);
        $user->assignRole($request->role);

        return response()->json([
            'status' => 'ok',
            'data' => $user
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $delete_role_user = DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->update($data);
        $user->assignRole($request->role);

        return response()->json([
            'status' => 'ok',
            'data' => $user
        ], 200);

    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        $delete_role_user = DB::table('model_has_roles')->where('model_id',$id)->delete();

        return response()->json([
            'status' => 'ok',
            'response' => 'deleted-successfully'
        ], 200);

    }
}
