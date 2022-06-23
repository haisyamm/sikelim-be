<?php
namespace App\Http\Controllers;
use App\Models\Siswa;
use Illuminate\Http\Request;
class SiswaController extends Controller
{ 
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    function __construct()
    {
        $this->middleware('permission:siswa-list|siswa-create|siswa-edit|siswa-delete', ['only' => ['index','show']]);
        $this->middleware('permission:siswa-create', ['only' => ['create','store']]);
        $this->middleware('permission:siswa-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:siswa-delete', ['only' => ['destroy']]);
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $siswas = Siswa::latest()->paginate(5);
        return view('siswas.index',compact('siswas'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('siswas.create');
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        request()->validate([
        'nisn' => 'required',
        'name' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'sekolah_id' => 'required',
        'no_hp' => 'required',
        'no_wa' => 'required',
        ]);
        Siswa::create($request->all());
        return redirect()->route('siswas.index')
        ->with('success','Siswa created successfully.');
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\Siswa  $siswa
    * @return \Illuminate\Http\Response
    */
    public function show(Siswa $siswa)
    {
        return view('siswas.show',compact('siswa'));
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Siswa  $siswa
    * @return \Illuminate\Http\Response
    */
    public function edit(Siswa $siswa)
    {
        return view('siswas.edit',compact('siswa'));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Siswa  $siswa
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Siswa $siswa)
    {
        request()->validate([
            'nisn' => 'required',
            'name' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'sekolah_id' => 'required',
            'no_hp' => 'required',
            'no_wa' => 'required',
        ]);
        $siswa->update($request->all());
        return redirect()->route('siswa.index')
        ->with('success','Product updated successfully');
        }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Siswa  $siswa
    * @return \Illuminate\Http\Response
    */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswas.index')
        ->with('success','Siswa deleted successfully');
    }
}