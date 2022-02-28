<?php

namespace App\Http\Controllers;

use App\Models\PersonalInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Contracts\Validation\Validator;


class PersonalInformationController extends Controller
{
    public function index()
    {
        $information = PersonalInformation::find(1);
        return view('admin.personal_information', compact('information'));
    }

    public function update(Request $request)
    {
        //DOSYA UZANTI KONTROLLERİ
        $this->validate($request,
            [
                'cv' => 'mimes:pdf,doc,docx',
                'image' => 'mimes:jpeg,jpg,png',
                'title_left' => 'required',
                'title_right' => 'required'
            ],
            [
                'cv.mimes' => 'Seçilen CV yalnızca .pdf, .doc, .docx uzantılı olabilir.',
                'image.mimes' => 'Seçilen resim yalnızca .jpeg, .jpg, .png uzantılı olabilir.',
                'title_left.required' => 'Lütfen eğitim listesinin başlığını giriniz.',
                'title_right.required' => 'Lütfen deneyim listesinin başlığını giriniz.',
            ]);

        $information = PersonalInformation::find(1);

        // $request gelen file var mı? varsa if'e gir
        if ($request->file('cv')) {
            $file = $request->file('cv');
            // getClientOriginalExtension; dosya uzantısını alıyor.
            $extension = $file->getClientOriginalExtension();
            // getClientOriginalName; orjinal dosya adını alır.
            $fileOriginalName = $file->getClientOriginalName();
            //name'i parçalayıp adını ve uzantısını ayrı ayrı alıyoruz.
            $explode = explode('.', $fileOriginalName);
            //adına aklendiği tarih ve saati ekliyoruz.
            // Str::slug türkçe karakterleri ve isimde olan boşluk gibi karakterleri düzeltiyor. booşluk yerine '-' yap dedik.
            $fileOriginalName = Str::slug($explode[0], '-') . '_' . now()->format('d-m-Y_H-i-s') . '.' . $extension;
            //Storage::putFileAs ilgili dosyanın içerisine yazma işlemi
            Storage::putFileAs('public/cv', $file, $fileOriginalName);
            $information->cv =  $fileOriginalName;
        }

        if ($request->file('image')) {
            $file = $request->file('image');
            // getClientOriginalExtension; dosya uzantısını alıyor.
            $extension = $file->getClientOriginalExtension();
            // getClientOriginalName; orjinal dosya adını alır.
            $fileOriginalName = $file->getClientOriginalName();
            //name'i parçalayıp adını ve uzantısını ayrı ayrı alıyoruz.
            $explode = explode('.', $fileOriginalName);
            //adına aklendiği tarih ve saati ekliyoruz.
            $fileOriginalName = Str::slug($explode[0], '-') . '_' . now()->format('d-m-Y_H-i-s') . '.' . $extension;

            Storage::putFileAs('public/image', $file, $fileOriginalName);
            $information->image =  $fileOriginalName;
        }

        $information->main_title = $request->main_title;
        $information->about_text = $request->about_text;
        $information->btn_contact_text = $request->btn_contact_text;
        $information->btn_contact_link = $request->btn_contact_link;
        $information->small_title_left = $request->small_title_left;
        $information->title_left = $request->title_left;
        $information->small_title_right = $request->small_title_right;
        $information->title_right = $request->title_right;
        $information->full_name = $request->full_name;
        $information->task_name = $request->task_name;
        $information->birthday = $request->birthday;
        $information->website = $request->website;
        $information->phone = $request->phone;
        $information->mail = $request->mail;
        $information->address = $request->address;
        $information->lang = $request->lang;
        $information->interests = $request->interests;


        $information->save();

        alert()->success('Başarılı', 'Kişisel bilgileriniz güncellendi.')->showConfirmButton('Tamam', '#3085d6')->persistent(true, false);
        return redirect()->back();
    }
}
