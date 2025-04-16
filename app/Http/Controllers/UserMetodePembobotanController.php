<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\AHP;
use App\Models\Bobot;
use App\Models\PerbandinganBerpasangan;
use App\Models\BobotLangsung;
use App\Models\Kriteria;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserMetodePembobotanController extends Controller
{

    // pembobotan AHP
    public function ahp_index()
    {
        $kriterias = Kriteria::all(); // Ambil semua kriteria dari database

        $this_user = User::where('id', Auth::id())->first();
        $ahplist = DB::table('ahp')
            ->select('*')
            ->where('ahp.is_created_by_admin', 1)
            ->orWhere('ahp.creator_id', $this_user->id)
            ->latest()->get();

        return view('user_bobot.ahp.index', compact('ahplist', 'this_user'));
        return view('ahp.index', compact('kriterias')); // Kirim ke view
    }

    public function ahp_create()
    {
        $kriterias = \App\Models\Kriteria::all();

        return view('user_bobot.ahp.create', compact('kriterias'));

    }

    public function ahp_store(Request $request)
    {
        // Ambil 5 kriteria pertama dari DB
        $kriterias = Kriteria::take(5)->get();

        // Ambil bobot asli dari database
        $bobotKriteria = $kriterias->pluck('bobot')->toArray();

        // Hitung total bobot dan normalisasi
        $total = array_sum($bobotKriteria);
        $bobotNormalisasi = $total > 0
            ? array_map(function ($b) use ($total) {
                return $b / $total;
            }, $bobotKriteria)
            : array_fill(0, count($bobotKriteria), 0);

        // Susun hasil per kriteria
        $detail = [];
        foreach ($kriterias as $index => $kriteria) {
            $detail[$kriteria->nama] = round($bobotNormalisasi[$index], 4);
        }

        // Simpan ke tabel ahp
        AHP::create([
            'nama_perhitungan' => 'Perhitungan AHP ' . now()->format('d-m-Y H:i:s'),
            'is_konsisten' => true,
            'is_created_by_admin' => auth()->user()->is_admin ?? false,
            'creator_id' => auth()->id(),
            'detail' => json_encode($detail),
        ]);

        return redirect()->route('ahp.index')->with('success', 'Perhitungan AHP berhasil disimpan.');
    }

    public function ahp_edit(AHP $ahp_obj, $id)
    {
        $kriterias = Kriteria::all(); // Ambil semua kriteria dari database
        $ahp = AHP::where('id_perhitungan', '=', $id)->first();
        $bobot = Bobot::where('id_perhitungan', '=', $id)->first();
        $PB_obj = PerbandinganBerpasangan::where('id_perhitungan', '=', $id)->get();

        // Include kriterias in the compact function
        return view('user_bobot.ahp.edit', compact('ahp', 'bobot', 'PB_obj', 'kriterias'));

        // Remove this line as it's unreachable
        // return view('ahp.index', compact('kriterias')); 
    }
    public function ahp_update(Request $request, $id)
    {
        $ahp = AHP::findOrFail($id);
        $updatedBobot = $request->input('bobot'); // inputan dari user, contoh: ['Pendidikan' => 0.3, ...]

        $total = array_sum($updatedBobot);
        $normalized = $total > 0
            ? array_map(function ($b) use ($total) {
                return $b / $total;
            }, $updatedBobot)
            : array_fill_keys(array_keys($updatedBobot), 0);

        $ahp->update([
            'detail' => json_encode($normalized),
        ]);

        return redirect()->route('ahp.index')->with('success', 'Perhitungan AHP berhasil diperbarui.');
    }

    public function ahp_show($id)
    {
        $ahp = AHP::where('id_perhitungan', '=', $id)->first();

        // Make sure AHP record exists
        if (!$ahp) {
            return redirect()->route('user.bobot.ahp.index')->with('error', 'Perhitungan AHP tidak ditemukan.');
        }

        $bobot = Bobot::where('id_perhitungan', '=', $id)->first();

        // Make sure Bobot record exists
        if (!$bobot) {
            return redirect()->route('user.bobot.ahp.index')->with('error', 'Data bobot tidak ditemukan untuk perhitungan ini.');
        }

        $PB_obj = PerbandinganBerpasangan::where('id_perhitungan', '=', $id)->get();

        // Get all criteria (you need to define the Kriteria model)
        $kriterias = Kriteria::all();

        return view('user_bobot.ahp.show', compact('ahp', 'bobot', 'PB_obj', 'kriterias'));
    }

    public function ahp_destroy($id_get_url)
    {

        AHP::where('id_perhitungan', $id_get_url)->delete();

        // tidak perlu delete ke table Bobot dan PerbandinganBerpasangan karena sudah forignKey onCascade->delete()
        // ketika membuat database tabelnya
        // Bobot::where('id_perhitungan', $id_get_url)->delete();
        // PerbandinganBerpasangan::where('id_perhitungan', $id_get_url)->delete();

        return redirect()->route('user.bobot.ahp.index')
            ->with('success', 'Perhitungan AHP berhasil dihapus');
    }

    public function ahp_toggle($id_get_url)
    {
        $this_user = User::where('id', Auth::id())->update(['id_perhitungan_aktif' => $id_get_url]);

        return redirect()->back()
            ->with('success', 'Bobot AHP yang digunakan untuk perhitungan rekomendasi berhasil diganti');
    }



    // ----------
    // pembobotan Langsung
    // ----------
    public function langsung_index()
    {
        $this_user_id = Auth::id(); // return this_user->id
        $bobot_langsung = BobotLangsung::where('id_user', $this_user_id)->first();
        // $data = 1;
        return view('user_bobot.langsung.index', compact('bobot_langsung'));
    }

    public function langsung_edit()
    {
        $this_user_id = Auth::id(); // return this_user->id
        $bobot_langsung = BobotLangsung::where('id_user', $this_user_id)->first();
        // $data = 1;
        return view('user_bobot.langsung.edit', compact('bobot_langsung'));
    }

    public function langsung_update(Request $req)
    {
        $this_user_id = Auth::id(); // return this_user->id
        $bobot_langsung = BobotLangsung::where('id_user', $this_user_id)->first();
        // $data = 1;
        $not_sum_zero_check = $req->harga + $req->prosesor + $req->kapasitas_ram + $req->kapasitas_hdd + $req->kapasitas_ssd +
            $req->kapasitas_vram + $req->kapasitas_maxram + $req->berat + $req->ukuran_layar +
            $req->jenis_layar + $req->refresh_rate + $req->resolusi_layar;

        if ($not_sum_zero_check > 0) {
            BobotLangsung::where('id_user', $this_user_id)->update([
                'id_user' => $this_user_id,
                'c1' => $req->harga,
                'c2' => $req->prosesor,
                'c3' => $req->kapasitas_ram,
                'c4' => $req->kapasitas_hdd,
                'c5' => $req->kapasitas_ssd,
                'c6' => $req->kapasitas_vram,
                'c7' => $req->kapasitas_maxram,
                'c8' => $req->berat,
                'c9' => $req->ukuran_layar,
                'c10' => $req->jenis_layar,
                'c11' => $req->refresh_rate,
                'c12' => $req->resolusi_layar,
            ]);
            return redirect()->route('user.bobot.langsung.index')
                ->with('success', 'Bobot updated successfully');
        } else {
            return redirect()->route('user.bobot.langsung.edit')
                ->with('error', 'Jumlah dari bobot tidak boleh 0');
        }



    }
}
