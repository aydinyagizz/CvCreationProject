<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationAddRequest;
use App\Http\Requests\ExperienceRequest;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function list()
    {
        $list = Experience::all();
        return view('admin.experience_list', compact('list'));

    }

    public function addShow(Request $request)
    {
        $id = $request->experienceID;
        $experience = null;
        if (!is_null($id)) {
            $experience = Experience::find($id);
        }

        return view('admin.experience_add', compact('experience'));
    }

    public function add(ExperienceRequest $request)
    {

        $status = 0;
        $active = 0;
        $order = $request->order;

        if (isset($request->status)) {
            $status = 1;
        }
        if (isset($request->active)) {
            $active = 1;
        }

        if (isset($request->experienceID)) {
            $id = $request->experienceID;
            //güncelleme iişlemi
            Experience::where('id', $id)
                ->update([
                'task_name' => $request->task_name,
                'company_name' => $request->company_name,
                'date' => $request->date,
                'description' => $request->description,
                'status' => $status,
                'active' => $active,
                'order' => $order ? $order : 999,
            ]);
            //persistent ilk değeri tamam butonu olsun mu, ikinci değeri ise kapatmak için çarpı olsun mu parametreleri
            alert()->success('Başarılı', "$id  ID'sine sahip deneyim bilgisi güncellendi.")->showConfirmButton('Tamam', '#3085d6')->persistent(true, false);

            // sweetalert'in kaç saniye sonra kapanmasınını söylüyoruz.
            //autoClose($milliseconds = 5000);

            //Route veriyoruz.
            return redirect()->route('admin.experience.list');
        } else {

            //gelen verileri alıyoruz. yani data'yı.
            Experience::create([
                'task_name' => $request->task_name,
                'company_name' => $request->company_name,
                'date' => $request->date,
                'description' => $request->description,
                'status' => $status,
                'active' => $active,
                'order' => $order ? $order : 999,
            ]);

            //persistent ilk değeri tamam butonu olsun mu, ikinci değeri ise kapatmak için çarpı olsun mu parametreleri
            alert()->success('Başarılı', 'Deneyim bilgisi eklendi.')->showConfirmButton('Tamam', '#3085d6')->persistent(true, false);

            // sweetalert'in kaç saniye sonra kapanmasınını söylüyoruz.
            //autoClose($milliseconds = 5000);

            //Route veriyoruz.
            return redirect()->route('admin.experience.list');
        }

    }

    // status aktif-pasif değiştirme durumu
    public function changeStatus(Request $request)
    {
        $id = $request->experienceID;
        $newStatus = null;

        // Experience::find id parametresi versiğimiz için id'yi buluyor.
        $findExperience = Experience::find($id);
        $status = $findExperience->status;
        if ($status) {
            //status 1 ise 0 yap
            $status = 0;
            $newStatus = "Pasif";
        } else {
            //status 0 ise 1 yap
            $status = 1;
            $newStatus = "Aktif";
        }
        // son durumda da ilgili durumu butaya aktarıyoruz.
        $findExperience->status = $status;
        //güncellemeyi kaydetmek için
        $findExperience->save();

        return response()->json([
            'newStatus' => $newStatus,
            'experienceID' => $id,
            'status' => $status
        ], 200);

    }

    // active aktif-pasif değiştirme durumu
    public function changeActive(Request $request)
    {
        $id = $request->experienceID;

        $newActive = null;

        // Experience::find id parametresi versiğimiz için id'yi buluyor.
        $findExperience = Experience::find($id);
        $active = $findExperience->active;
        if ($active) {
            //status 1 ise 0 yap
            $active = 0;
            $newActive = "Pasif";
        } else {
            //status 0 ise 1 yap
            $active = 1;
            $newActive = "Aktif";
        }
        // son durumda da ilgili durumu butaya aktarıyoruz.
        $findExperience->active = $active;
        //güncellemeyi kaydetmek için
        $findExperience->save();

        return response()->json([
            'newActive' => $newActive,
            'experienceID' => $id,
            'active' => $active
        ], 200);

    }
}
