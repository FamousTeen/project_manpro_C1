<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Account;
use App\Models\Training;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTrainingRequest;
use App\Models\Group;
use App\Models\TrainingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = null;
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            $trainings = Training::where('status', 1)->get()->sortBy('training_date');

            return view('admin.training.daftar_pelatihan', [
                'user' => $user,
                'trainings' => $trainings
            ]);
        } elseif (Auth::guard('account')->check()) {
            $user = Auth::guard('account')->user();

            // Fetch data for the dashboard
            $userData = Account::query()->where(
                'email',
                $user->email
            )->where('password', $user->password)->firstOrFail();

            $events = Training::query()->where('status', 1)->get();
            return view('anggota/alur_acara/acara', [
                'events' => $events,
                'user' => $userData
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Training $training)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($training, $g)
    {
        $trainings = Training::find($training);
        $groups = Group::find($g);
        $list_group = Group::get()->distinct()->sortBy('name');
        dd($list_group);

        return view('admin.training.edit_pelatihan')->with('training', $trainings)->with('group', $groups)->with('list_group', $list_group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $g, $training)
    {
        $data = $request->all();
        $formfield = Validator::make($data, [
            'group' => 'required',
            'place' => 'required',
            'date' => 'required',
            'time' => 'required',
            'contact_person' => 'required',
            'phone_number' => 'required',
            'description' => 'required',
        ]);

        if ($formfield->fails()) {
            return redirect()->back()->withErrors($formfield)->withInput();
        }

        $trainings = Training::find($training);
        $training_data = [
            'place' => $data['place'],
            'training_date' => Carbon::parse($data['date'] . ' ' . $data['time']),
            'contact_person' => $data['contact_person'],
            'phone_number' => $data['phone_number'],
            'description' => $data['description'],
        ];
        $trainings->update($training_data);

        $training_details = TrainingDetail::where('group_id', $g)->where('training_id', $training)->get()->first();
        dd($training_details);
        $training_details_data = [
            'group_id' => $data['group']
        ];
        $training_details->update($training_details_data);

        return redirect()->route('trainings.index')->with('success', 'Pelatihan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        $training->update([
            'status' => 0
        ]);

        return redirect()->route('trainings.index')->with('success', 'Pelatihan berhasil dihapus.');
    }

    public function search(Request $request)
    {
        Carbon::setLocale('id');
        $query = $request->input('query');
        $user = Auth::guard('account')->user();

        // Daftar translasi nama hari dari Indonesia ke Inggris
        $dayTranslations = [
            'minggu' => 'Sunday',
            'senin' => 'Monday',
            'selasa' => 'Tuesday',
            'rabu' => 'Wednesday',
            'kamis' => 'Thursday',
            'jumat' => 'Friday',
            'sabtu' => 'Saturday',
        ];

        $monthTranslations = [
            'januari' => 'January',
            'februari' => 'February',
            'maret' => 'March',
            'april' => 'April',
            'mei' => 'May',
            'juni' => 'June',
            'juli' => 'July',
            'agustus' => 'August',
            'september' => 'September',
            'oktober' => 'October',
            'november' => 'November',
            'desember' => 'December',
        ];

        // Cek apakah query adalah nama hari dalam bahasa Indonesia
        $translatedDay = $dayTranslations[$query] ?? null;
        $translatedMonth = $monthTranslations[$query] ?? null;

        $trainings = Training::select('id', 'training_date', 'contact_person', 'phone_number') // Kolom yang relevan
            ->whereHas('trainingDetails', function ($q) use ($user) {
                $q->where('account_id', $user->id);
            })
            ->where(function ($q) use ($query, $translatedDay, $translatedMonth) {
                $q->where('training_date', 'like', "%$query%"); // Pencarian umum untuk tanggal
    
                // Pencarian berdasarkan hari
                if ($translatedDay) {
                    $q->orWhereRaw("DAYNAME(training_date) = ?", [$translatedDay]);
                }

                // Pencarian berdasarkan bulan
                if ($translatedMonth) {
                    $q->orWhereRaw("MONTHNAME(training_date) = ?", [$translatedMonth]);
                }

                // Pencarian berdasarkan tahun
                if (is_numeric($query) && strlen($query) === 4) {
                    $q->orWhereRaw("YEAR(training_date) = ?", [$query]);
                }

                // Pencarian berdasarkan jam
                if (preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $query)) { // Format HH:mm atau HH:mm:ss
                    $q->orWhereRaw("TIME(training_date) = ?", [$query]);
                }

                // Pencarian berdasarkan contact person
                $q->orWhere('contact_person', 'like', "%$query%");

                // Pencarian berdasarkan nomor HP
                $q->orWhere('phone_number', 'like', "%$query%");
            })
            ->with(['trainingDetails.account:id,name'])
            ->distinct() // Memastikan data unik
            ->get();

        return response()->json($trainings);
    }
}
