<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function sms_settings(){
        return view('admin.adminview', ['page' => 'settings.sms_settings', 'title' => 'SMS Settings','bday_sms_default_text'=>get_settings('bday_sms_default_text')]);
    }

    public function sms_settings_save(Request $request){
        $validated = $request->validate([
            'bday_sms_default_text' => 'required'
        ]);

        $settings = Settings::firstOrNew(['name'=>'bday_sms_default_text']);
        $settings->name = 'bday_sms_default_text';
        $settings->value = $request->bday_sms_default_text;
        $settings->save();

        return redirect('admin/settings/sms_settings')->with('cmsStatus', 'success');
    }
}
