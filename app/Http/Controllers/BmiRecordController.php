<?php

namespace App\Http\Controllers;

use App\Models\BmiRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BmiRecordController extends Controller
{
    // Method to display the BMI form
    // public function showForm()
    // {
    //     $user = Auth::user(); // Get the currently logged-in user
    //     $userData = null;

    //     // If the user is logged in, fetch data from the database
    //     if ($user) {
    //         $userData = [
    //             'gender' => $user->gender,
    //             'age' => $user->age,
    //             'height' => $user->height,
    //             'weight' => $user->weight,
    //         ];
    //     }

    //     // Send user data to the view for auto-filling the form to home section #bmi section
    //     return redirect()->route('home')
    //     ->with([
    //         'prefill_height' => Auth::user()->height,
    //         'prefill_weight' => Auth::user()->weight,
    //         'prefill_age' => Auth::user()->age
    //     ])
    //     ->fragment('bmi-section');

    // }

    // Method to calculate BMI
    public function calculate(Request $request)
    {
        // Validate user input
        $request->validate([
            'weight' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
            'age' => 'required|numeric|min:1',
            'gender' => 'required|string',
            'activity_level' => 'required|string',
        ]);

        // Calculate BMI
        $heightInMeters = $request->height / 100;
        $bmiScore = round($request->weight / ($heightInMeters * $heightInMeters), 2);
        $bmiCategory = $this->getBmiCategory($bmiScore);

        // Store the BMI score and category in the session
        session(['bmiScore' => $bmiScore, 'bmiCategory' => $bmiCategory]);

        // Prepare recommendation
        $recommendation = $this->getRecommendation(
            $request->age,
            $request->gender,
            $request->activity_level,
            $bmiCategory
        );

        // Return the view with the calculated results
        return view('result', compact('bmiScore', 'bmiCategory', 'recommendation'))->with([
            'bmi_score' => $bmiScore,
            'bmi_category' => $bmiCategory,
        ]);
    }

    // Method to show the result
    public function showResult()
    {
        $message = session('message');
        $bmiScore = session('bmiScore');
        $bmiCategory = session('bmiCategory');

        return view('bmi', compact('bmiScore', 'bmiCategory', 'message'));
    }

    // Method to get BMI category
    private function getBmiCategory($bmiScore)
    {
        if ($bmiScore < 18.5) {
            return 'Underweight';
        } elseif ($bmiScore >= 18.5 && $bmiScore < 24.9) {
            return 'Normal weight';
        } elseif ($bmiScore >= 25 && $bmiScore < 29.9) {
            return 'Overweight';
        } elseif ($bmiScore >= 30 && $bmiScore < 34.9) {
            return 'Obese 1';
        } elseif ($bmiScore >= 35 && $bmiScore < 39.9) {
            return 'Obese 2';
        } else {
            return 'Obese 3';
        }
    }

    private function getRecommendation(
        $age,
        $gender,
        $activityLevel,
        $bmiCategory
    ) {
        $recommendations = [];

        // Recommendations based on BMI category
        switch ($bmiCategory) {
            case 'Underweight':
                $recommendations[] = "1. Tingkatkan asupan kalori dengan makanan bernutrisi";
                break;
            case 'Normal weight':
                $recommendations[] = "1. Pertahankan pola makan sehat dan olahraga rutin";
                break;
            case 'Overweight':
                $recommendations[] = "1. Cobalah menyeimbangkan pola makan dan aktivitas fisik";
                break;
            case 'Obese':
                $recommendations[] = "1. Konsultasikan dengan ahli gizi untuk manajemen berat badan";
                break;
        }

        // Additional advice based on age
        if ($age > 50) {
            $recommendations[] = "2. Perhatikan kesehatan tulang dengan kalsium dan olahraga ringan";
        }

        // Additional advice based on gender
        if ($gender === 'female' && $bmiCategory !== 'Normal weight') {
            $recommendations[] = "3. Pertimbangkan konsultasi terkait risiko kesehatan perempuan";
        }

        // Additional advice based on activity level
        switch ($activityLevel) {
            case 'low':
                $recommendations[] = "4. Tingkatkan aktivitas seperti berjalan kaki setiap hari";
                break;
            case 'medium':
                $recommendations[] = "4. Pertahankan gaya hidup aktif Anda";
                break;
            case 'high':
                $recommendations[] = "4. Luar biasa! Pastikan asupan kalori cukup untuk aktivitas Anda";
                break;
        }

        return implode("\n\n", $recommendations);
    }




    // Method to save BMI record
    public function saveBmiRecord(Request $request)
    {
        $bmiScore = $request->input('bmi_score') ?? session('bmiScore');
        $bmiCategory = $request->input('bmi_category') ?? session('bmiCategory');

        // Check if bmiScore or bmiCategory is missing
        // if (! $bmiScore || ! $bmiCategory) {
        //     return redirect()->route('result')->with('error', 'BMI score or category is missing.');
        // }

        // Ensure the user is logged in before saving the record
        if (Auth::check()) {
            $user = Auth::user();

            try {
                // Save the BMI record to the database
                BmiRecord::create([
                    'user_id' => $user->id,
                    'bmi_score' => $bmiScore,
                    'bmi_category' => $bmiCategory,
                ]);

                // Redirect with success message
                return redirect()->route('result')->with('successSaved', 'Hasil BMI Anda telah berhasil disimpan!');
            } catch (\Exception $e) {
                // Redirect with error message in case of failure
                return redirect()->route('result')->with(
                    'error',
                    'Gagal menyimpan hasil BMI: '
                    // . $e->getMessage()
                );
            }
        }

        // Redirect to login page if user is not authenticated
        return redirect()->route('home')->with('error', 'Silakan login terlebih dahulu.');
    }

    // Method to show progress (BMI history)
    public function showProgress()
    {
        $user = Auth::user();

        // Get BMI records for the user
        $bmiRecords = BmiRecord::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate calorie data (average BMI score per day)
        $calorieData = BmiRecord::where('user_id', $user->id)
            ->select(DB::raw('DATE(created_at) as date'), 'bmi_score')
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy('date')
            ->map(function ($records) {
                return $records->avg('bmi_score');
            });

        return view('progress', [
            'bmiRecords' => $bmiRecords,
            'calorieData' => $calorieData,
        ]);
    }

    public function filterBmi($period)
    {
        $user = Auth::user();
        $query = BmiRecord::where('user_id', $user->id);

        switch ($period) {
            case 'daily':
                $query->whereDate('created_at', today());
                break;
            case 'weekly':
            case 'monthly':
            case 'yearly':
                // Get the latest record for each day
                $query = BmiRecord::select('*')
                    ->where('user_id', $user->id)
                    ->whereIn('created_at', function ($q) {
                        $q->selectRaw('MAX(created_at)')
                            ->from('bmi_records')
                            ->groupBy(DB::raw('DATE(created_at)'));
                    });

                // Apply period filter
                switch ($period) {
                    case 'weekly':
                        $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                        break;
                    case 'monthly':
                        $query->whereMonth('created_at', now()->month);
                        break;
                    case 'yearly':
                        $query->whereYear('created_at', now()->year);
                        break;
                }
                break;
        }

        $bmiRecords = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'records' => $bmiRecords->map(function ($record) {
                return [
                    'bmi_score' => $record->bmi_score,
                    'bmi_category' => $record->bmi_category,
                    'created_at' => $record->created_at,
                ];
            })
        ]);
    }
    public function getLatestBmiRecords()
    {
        $user = Auth::user();

        $bmiRecords = BmiRecord::where('user_id', $user->id)
            ->select('*')
            ->whereIn('created_at', function ($query) use ($user) {
                $query->select(DB::raw('MAX(created_at)'))
                    ->from('bmi_records')
                    ->where('user_id', $user->id)
                    ->groupBy(DB::raw('DATE(created_at)'));
            })
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('account', [
            'bmiRecords' => $bmiRecords
        ]);
    }
}
