<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pesan-pengunjung.index', [
            'title'     => 'Pesan Pengunjung | '. config('app.name'),
            'pesans'    => Pesan::latest()->get()
        ]);
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
        $validated = $request->validate([
            'nama'  => 'required',
            'email' => 'required|email:dns',
            'subject'   => 'required|max:100',
            'pesan'     => 'required',
        ]);

        Pesan::create($validated);
        return redirect('/kontak')->with('success', 'Pesan anda berhasil terkirim');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function show(Pesan $pesan)
    {
        return view('pesan-pengunjung.show', [
            'title'     => 'Pesan Pengunjung | '. config('app.name'),
            'pesan'     => $pesan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesan $pesan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesan $pesan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesan  $pesan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesan $pesan)
    {
        Pesan::destroy($pesan->id);
        return redirect('/dashboard/pesan')->with('success', 'Pesan berhasil dihapus!');
    }

    public function deleteAll(Request $request){
        if($request->sub_check != ''){
            $data = $request->sub_check;
            DB::table('pesans')->whereIn('id', $data)->delete();
            return redirect('/dashboard/pesan')->with('success', 'Data pesan berhasil dihapus semua!');
        }else{
            return redirect('/dashboard/pesan')->with('error', 'Tidak ada data yang dipilih!');
        }
    }

    public function TulisEmail($id){
        return view('pesan-pengunjung.tulis-email', [
            'title'     => 'Tulis Email | '. config('app.name'),
            'pesan'     => Pesan::find($id)
        ]);
    }

    public function KirimEmail(Request $request){
        $subject = $request->subject;
        $content = $request->content;

        Mail::to($request->email)->send(new SendEmail($subject, $content));
        return redirect('/dashboard/pesan')->with('success', 'Email berhasil terkirim!');
    }
}
