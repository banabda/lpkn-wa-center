<?php

namespace App\Http\Controllers;

use App\Models\Message;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function sendText(Request $request)
    {
        $client = new Client();
        $data = [
            "body" => "message testing",
            "chatId" => "6289653468001@c.us",
            // "phone" => "6289653468001"
        ];
        $result = $client->request('POST', env('WA_URL') . 'status' . env('WA_TOKEN'), ['form_params' => $data])->getBody()->getContents();
        return $result;
    }

    public function sendFile(Request $request)
    {
        $client = new Client();
        $data = [
            "body" => "https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.w3schools.com%2Fw3css%2Fw3css_images.asp&psig=AOvVaw0_HT2EOH3eICNfu6k0I6jg&ust=1617871710978000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCJikzfbf6-8CFQAAAAAdAAAAABAD",
            "filename" => "image test",
            "chatId" => "6289653468001@c.us",
            // "phone" => "6289653468001"
        ];
        $result = $client->request('POST', env('WA_URL') . 'status' . env('WA_TOKEN'), ['form_params' => $data])->getBody()->getContents();
        return $result;
    }

    public function messages()
    {
        $client = new Client();
        $result = $client->request('GET', env('WA_URL') . 'messages' . env('WA_TOKEN'))->getBody()->getContents();
        return $result;
    }

    public function latest()
    {
        $client = new Client();
        $result = $client->request('GET', env('WA_URL') . 'messagesHistory' . env('WA_TOKEN'))->getBody()->getContents();
        return $result;
    }

    public function delete()
    {
        $client = new Client();
        $data = [
            "messageId" => "aa"
        ];
        $result = $client->request('POST', env('WA_URL') . 'deleteMessage' . env('WA_TOKEN'), ['form_params' => $data])->getBody()->getContents();
        return $result;
    }
}
