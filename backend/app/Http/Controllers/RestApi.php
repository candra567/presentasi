<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Exception;
use Illuminate\Http\Request;

class RestApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data_siswa = Siswa::orderBy('id','desc')->get();
            return response()->json([
                'message' => 'Request success',
                'data' => $data_siswa
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
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
        $request->validate([
            'name_siswa' => 'required',
            'no_siswa' => 'required',
            'kelas_siswa' => 'required'
        ]);
        try {
            Siswa::create([
                'name_siswa' => $request->name_siswa,
                'no_siswa' => (int) $request->no_siswa,
                'kelas_siswa' => $request->kelas_siswa
            ]);
            return response()->json([
                'message' => 'Data success ditambahkan'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
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
         try{
            $data_siswa=Siswa::where('id',$id)->first();
            if (empty($data_siswa)) {
                throw new Exception('Data tidak ditemukan');
            }
            else{
               return response()->json([
                  'message'=>'Request success',
                  'data'=>$data_siswa
               ]);
            }
         }
         catch(Exception $e){
           return response()->json([
             'message'=>$e
           ]);
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([
            'name_siswa' => 'required',
            'no_siswa' => 'required',
            'kelas_siswa' => 'required'
        ]);
        try {
            $data_siswa = Siswa::where('id', $id)->first();
            if (empty($data_siswa)) {
                throw new Exception('Siswa not found');
            } else {
                $data_siswa->name_siswa = $request->name_siswa;
                $data_siswa->no_siswa = $request->no_siswa;
                $data_siswa->kelas_siswa = $request->kelas_siswa;
                $data_siswa->save();
                return response()->json([
                    'message' => 'Data success diupdate'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
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
        try {
            $data_siswa = Siswa::where('id', $id)->first();
            if (empty($data_siswa)) {
                throw new Exception('Siswa not found');
            } else {
                $data_siswa->delete();
                return response()->json([
                   'message'=>'Data success dihapus'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
