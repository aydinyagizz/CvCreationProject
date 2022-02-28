<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationAddRequest;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{

    public function list()
    {
        //Education::all() hepsini listeler.
        $list = Education::all();
        return view('admin.education_list', compact('list'));
    }

    // status aktif-pasif değiştirme durumu
    public function changeStatus(Request $request)
    {
        $id = $request->educationID;
        $newStatus = null;

        // Education::find id parametresi versiğimiz için id'yi buluyor.
        $findEducation = Education::find($id);
        $status = $findEducation->status;
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
        $findEducation->status = $status;
        //güncellemeyi kaydetmek için
        $findEducation->save();
        return response()->json([
            'newStatus' => $newStatus,
            'educationID' => $id,
            'status' => $status
        ], 200);

    }

    public function addShow(Request $request)
    {
        $id = $request->educationID;
        $education = null;
        if (!is_null($id)) {
            $education = Education::find($id);
        }

        return view('admin.education_add', compact('education'));
    }

    public function add(EducationAddRequest $request)
    {
        $order = $request->order;
        $status = 0;
        if (isset($request->status)) {
            $status = 1;
        }

        if (isset($request->educationID)) {
            $id = $request->educationID;
            //güncelleme iişlemi
            Education::where('id', $id)->update([
                'education_date' => $request->education_date,
                'university_name' => $request->university_name,
                'university_branch' => $request->university_branch,
                'description' => $request->description,
                'status' => $status,
                'order' => $order ? $order : 999
            ]);
            //persistent ilk değeri tamam butonu olsun mu, ikinci değeri ise kapatmak için çarpı olsun mu parametreleri
            alert()->success('Başarılı', "$id  ID'sine Sahip eğitim bilgisi güncellendi.")->showConfirmButton('Tamam', '#3085d6')->persistent(true, false);

            // sweetalert'in kaç saniye sonra kapanmasınını söylüyoruz.
            //autoClose($milliseconds = 5000);

            //Route veriyoruz.
            return redirect()->route('admin.education.list');
        } else {

            //gelen verileri alıyoruz. yani data'yı.
            Education::create([
                'education_date' => $request->education_date,
                'university_name' => $request->university_name,
                'university_branch' => $request->university_branch,
                'description' => $request->description,
                'status' => $status,
                'order' => $order ? $order : 999
            ]);

            //persistent ilk değeri tamam butonu olsun mu, ikinci değeri ise kapatmak için çarpı olsun mu parametreleri
            alert()->success('Başarılı', 'Eğitim bilgisi eklendi.')->showConfirmButton('Tamam', '#3085d6')->persistent(true, false);

            // sweetalert'in kaç saniye sonra kapanmasınını söylüyoruz.
            //autoClose($milliseconds = 5000);

            //Route veriyoruz.
            return redirect()->route('admin.education.list');
        }

    }

    public function delete(Request $request)
    {
        $id = $request->educationID;
        // silme işlemi
        Education::where('id', $id)->delete();
        return response()->json([], 200);
    }

}
