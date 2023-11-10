<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\SmsLog;
use Illuminate\Http\Request;
use App\Libraries\SmsLib;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.adminview', ['page' => 'client.index', 'title' => 'Clients', 'clients'=> Client::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adminview', ['page' => 'client.create', 'title' => 'Client']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $client = new Client;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->email = $request->email;
        $client->mobile = $request->mobile;
        $client->birthday = sqldate($request->birthday);
        $client->status = $request->status;
        $client->createdBy = admin_id();

        $result = $client->save();

        if ($result) {
            return redirect('admin/clients')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/clients')->with('cmsStatus', 'fail');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('admin.adminview', ['page' => 'client.edit', 'client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        

        
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->email = $request->email;
        $client->mobile = $request->mobile;
        $client->birthday = sqldate($request->birthday);
        $client->status = $request->status;

        $result = $client->save();

        if ($result) {
            return redirect('admin/clients')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/clients')->with('cmsStatus', 'fail');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }

    public function delete($id)
    {
        Client::find($id)->delete();
        return redirect('admin/clients')->with('cmsStatus', 'success');
    }

    public function birthdays()
    {
        //$clients = Client::whereRaw("DATE_FORMAT(`birthday`, '".date('Y')."-%m-%d') >= ".date('Y-m-d')."")->whereRaw("DATE_FORMAT(`birthday`, '".date('Y')."-%m-%d') <= ".date("Y-m-d",strtotime("+7 days"))."")->get();
        $clients = Client::whereRaw("DATE_FORMAT(birthday, '%m-%d') BETWEEN DATE_FORMAT(CURDATE(), '%m-%d') AND DATE_FORMAT(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '%m-%d')")->get();
        return view('admin.adminview', ['page' => 'client.birthdays', 'title' => 'Client Birthdays in Next 7 Days', 'clients'=> $clients]);
    }

    public function send_sms_modal($id){
        $client = Client::find($id);
        return view('admin.client.modal_sms', ['client'=> $client,'default_text'=>get_settings('bday_sms_default_text')]);
    }

    public function send_sms(Request $request){
        $validated = $request->validate([
            'mobile' => 'required',
            'sms_text' => 'required'
        ]);

        $sms_text = $this->sms_text($request->client_id,$request->sms_text);

        $sms = new SmsLib;
        $resp = $sms->birthday_sms($request->mobile,$sms_text);

        if($resp == 200){
            $log = new SmsLog;
            $log->from = 'birthday';
            $log->to = $request->mobile;
            $log->client_id = $request->client_id;
            $log->body = $sms_text;
            $log->createdBy = admin_id();
            $log->save();

            return redirect('admin/clients/birthdays')->with('cmsStatus', 'success');
        }else{
            return redirect('admin/clients/birthdays')->with('cmsStatus', 'fail');
        }
    }

    private function sms_text($client_id,$text){
        $client = Client::find($client_id);
        $client_name = $client->first_name.' '.$client->last_name;
        return str_replace("{{client_name}}",$client_name,$text);
    }
}
