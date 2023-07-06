<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use Illuminate\Support\Facades\Crypt;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Student::all();
        return view('Student.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //request validate
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'file' => 'required',
            'address' => 'required',
        ]);

        if ($request->file) {

            $files = $request->file('file');
            $fileAry = array();

            foreach ($files as $file) {

                $filename = uniqid() . '_' . $file->getClientOriginalName();
                array_push($fileAry, $filename);
                $file->move(public_path() . '/uploads/', $filename);
            }

            Student::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'img' => serialize($fileAry),
                'address' => $request->get('address'),
                'remark' => $request->get('remark'),
            ]);
            return redirect('/student/create')->with('status', 'Success!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $student = Student::find($id);
        return view('Student.student_edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //request validate
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $id = Crypt::decrypt($id);
 
        if ($request->file) {
 
            $files = $request->file('file');
            $fileAry = array();

            foreach ($files as $file) {

                $filename = uniqid() . '_' . $file->getClientOriginalName();
                array_push($fileAry, $filename);
                $file->move(public_path() . '/uploads/', $filename);
            }

            $student = Student::find($id);
            $student->name = $request->get('name');
            $student->email = $request->get('email');
            $student->phone = $request->get('phone');
            $student->address = $request->get('address');
            $student->remark = $request->get('remark');
            $student->img = serialize($fileAry);
            $student->update();
            return redirect('/student')->with('status', 'Successfully Updated Student!');
        }else{
            $student = Student::find($id);
            $student->name = $request->get('name');
            $student->email = $request->get('email');
            $student->phone = $request->get('phone');
            $student->address = $request->get('address');
            $student->remark = $request->get('remark');
            $student->update();
            return redirect('/student')->with('status', 'Successfully Updated Student!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        Student::findOrFail($id)->delete();
        return redirect('/student')->with('status', 'Successfully Deleted Student!');;
    }
}
