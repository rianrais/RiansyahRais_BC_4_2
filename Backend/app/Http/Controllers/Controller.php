<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Student;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createOrUpdateStudentData(Request $request){
        DB::beginTransaction();

        try 
        {
            $this->validate($request, [
                'student_first_name' => 'required',
                'student_last_name' => 'required',
                'student_email' => 'required|email',
                'student_contact' => 'required',
                'student_address' => 'required',
            ]);
            
            $firstName = $request->input('student_first_name');
            $lastName = $request->input('student_last_name');
            $email = $request->input('student_email');
            $contact = $request->input('student_contact');
            $address = $request->input('student_address');

            $student = Student::updateOrCreate([
                'student_first_name' => $request->input('student_first_name'),
                'student_last_name' => $request->input('student_last_name'),
                'student_email' => $request->input('student_email')
                ],[
                'student_first_name' => $firstName,
                'student_last_name' => $lastName,
                'student_email' => $email,
                'student_contact' => $contact,
                'student_address' => $address
                ]);
            
            $newStudentData = Student::get();

            /*Message yang dikeluarkan setelah sukses memasukan data.
            Fungsi DB commit memasukan semua data yang sukses */
            DB::commit();
            return response()->json($newStudentData, 201);
        }

        catch(\Exception $e) 
        {
            DB::rollBack(); /* Fungsi ini merollback apabila terdapat 
                            data yang gagal/error masuk kedalam DB */
            return response()->json(["message" => $e->getMessage()], 500);
        }
    }
}
