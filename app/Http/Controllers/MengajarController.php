<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Mengajar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $years = Mengajar::select('tahun_ajaran')->orderBy('tahun_ajaran')->get()->groupBy('tahun_ajaran');

        $mengajarGroup = [];

        if(request('filter_tahun') && request('filter_semester')){
            $mengajarGroup = Guru::whereHas('mengajars', fn($q) =>
                    $q->where('tahun_ajaran', request('filter_tahun'))
                    ->where('semester', request('filter_semester'))
                    // ->where('guru_id', request('filter_guru'))
                )
                ->with(['mengajars' => fn($q) =>
                    $q->where('tahun_ajaran', request('filter_tahun'))
                    ->where('semester', request('filter_semester'))
                    // ->where('guru_id', request('filter_guru'))
                ])
                ->get();
        }

        // dd($mengajarGroup);


        return view('mengajar.index', [
            'title'     => 'Mengajar '. config('app.name'),
            'gurus'     => Guru::select('id', 'nama')->get(),
            'mengajarsGroup'    => $mengajarGroup,
            'years'     => $years,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  return view('mengajar.create', [
        //     'title'     => 'Tambah Mengajar '. config('app.name'),
        //     'gurus'     => Guru::select('id', 'nama')->get(),
        //     'mapels'    => Mapel::select('id', 'kode', 'nama')->get(),
        //     'kelas'     => Kelas::all()
        // ]);
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
            'mapel_id'      => 'required',
            'kelas_id'      => 'required',
            'guru_id'       => 'required',
            'jam'           => 'nullable|min:0',
            'tahun_ajaran'  => 'required',
            'semester'      => 'required',
        ]);

        Mengajar::create($validated);

        return back()->with('success', 'Jam Mengajar Berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mengajar  $mengajar
     * @return \Illuminate\Http\Response
     */
    public function show(Mengajar $mengajar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mengajar  $mengajar
     * @return \Illuminate\Http\Response
     */
    public function edit(Mengajar $mengajar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mengajar  $mengajar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mengajar $mengajar)
    {

        $validated = $request->validate([
            'jam'           => 'required|min:0',
        ]);

        Mengajar::where('id', $mengajar->id)
            ->update($validated);
        return redirect('/dashboard/mengajar')->with('success', 'Jam Mengajar Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mengajar  $mengajar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mengajar $mengajar)
    {
        //
    }

    public function delete(Mengajar $mengajar)
    {
        Mengajar::destroy($mengajar->id);
        return redirect('/dashboard/mengajar')->with('success', 'Jam Mengajar Berhasil dihapus!');
    }

     public function PembagianMapel()
    {
        $gurus = Guru::select('id', 'nama')->get();

        return view('mengajar.pembagian-mapel', [
            'title'     => 'Atur Pembagian Mapel '. config('app.name'),
            'gurus'    => $gurus,
        ]);
    }

    public function AturPembagianMapel(Guru $guru)
    {
        $data = $guru->load('mengajars');
        $mengajar = $data->mengajars->groupBy('tahun_ajaran')->sortBy('created_at');
        return view('mengajar.atur-pembagian-mapel', [
            'title'     => 'Atur Pembagian Mapel '. config('app.name'),
            'guru'      => $data,
            'mengajar'  => $mengajar,
            'kelas'     => Kelas::all()
        ]);
    }

    public function getKelas(Request  $request){
        $kelas = Kelas::select('id', 'jurusan_id', 'nama')
            ->whereDoesntHave('mengajars', function(Builder $query) use ($request){
                $query->where('tahun_ajaran', '=', $request->tahun)
                ->where('semester', '=', $request->semester)
                ->where('mapel_id', '=', $request->mapel_id)
                ->where('guru_id', '=', $request->guru_id);
            })->get();

        return response()->json($kelas);
    }
    public function getMapel(){

        $mapel = Mapel::select('id', 'kode', 'nama')->get();

        return response()->json($mapel);
    }

}
