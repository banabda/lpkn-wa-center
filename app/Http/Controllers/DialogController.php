<?php

namespace App\Http\Controllers;

use App\Models\Dialog;
use App\Models\UserCred;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DialogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "hai";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dialog  $dialog
     * @return \Illuminate\Http\Response
     */
    public function show(Dialog $dialog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dialog  $dialog
     * @return \Illuminate\Http\Response
     */
    public function edit(Dialog $dialog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dialog  $dialog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dialog $dialog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dialog  $dialog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dialog $dialog)
    {
        //
    }

    public function dialogs()
    {
        $client = new Client();
        $result = $client->request('GET', env('WA_URL') . 'dialogs' . env('WA_TOKEN') . '&limit=200')->getBody()->getContents();
        return $result;
    }

    public function dialog($chatId)
    {
        $client = new Client();
        $result = $client->request('GET', env('WA_URL') . 'dialog' . env('WA_TOKEN') . '&chatId=' . $chatId)->getBody()->getContents();
        // dd($result);
        return $result;
    }

    public function selected($chatid)
    {
        $dialog = Dialog::with('messages')->where('id', $chatid)->first();
        $user = Auth::user()->id;
        $userCred = UserCred::where('user_id', $user)->first();
        // dd($userCred->credential);
        
        foreach ($dialog->messages as $value) {
            $value->update([
                'status' => 1
            ]);
        }

        $client = new Client();
        $urlClient = $userCred->credential->instance . 'readChat?token=' . $userCred->credential->token;
        $body = [
            "chatId" => $chatid
        ];

        $response = $client->request('POST', $urlClient , [
            'headers' => [
                'Accept'     => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($body)
        ]);
        
        $result = json_decode($response->getBody()->getContents());
        
        return $dialog->messages;

        // return $dialog->messages->groupBy(function ($item) {
        //     return $item->time->translatedFormat('Y-m-d');
        // });
    }

    public function contact()
    {
        return Dialog::has('messages')->with('latestMessage')->get();
    }

    public function contactWithCred($id)
    {
        return Dialog::has('messages')->with('latestMessage')->where('credential_id', $id)->get();
    }

    public function contactPerPage($page)
    {
        $page = $page * 20;
        return Dialog::has('messages')->with('latestMessage')->orderBy("last_time", "desc")->skip($page)->limit(20)->get();
    }

    public function contactPerPageWithCred($page, $cred)
    {
        $page = $page * 20;
        return Dialog::where('credential_id', $cred)->has('messages')->with('latestMessage')->orderBy("last_time", "desc")->skip($page)->limit(20)->get();
    }

    public function searchContact($name)
    {
        return Dialog::has('messages')->with('latestMessage')->orderBy("last_time", "desc")->where('name', 'LIKE', '%' . $name . '%')->get();
    }
}
