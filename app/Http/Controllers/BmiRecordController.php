<?php

namespace App\Http\Controllers;

use App\Models\BmiRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BmiRecordController extends Controller
{
    // Method untuk menghitung BMI
    public function calculate(Request $request)
    {
        // Validasi inputan user
        $request->validate([
            'weight' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
        ]);

        // Hitung BMI
        $heightInMeters = $request->height / 100;  // Convert cm ke meter
        $bmiScore = $request->weight / ($heightInMeters * $heightInMeters);

        // Tentukan kategori BMI berdasarkan skor
        $bmiCategory = $this->getBmiCategory($bmiScore);

        // Jika pengguna login dan ingin menyimpan hasilnya
        $message = '';
        if (Auth::check()) {
            // Ambil data user yang sedang login
            $user = Auth::user();

            // Simpan hasil BMI ke dalam database
            BmiRecord::create([
                'user_id' => $user->id,
                'bmi_score' => round($bmiScore, 2),
                'bmi_category' => $bmiCategory,
            ]);

            // Pesan berhasil simpan
            $message = 'Hasil BMI Anda telah berhasil disimpan!';
        }

        // Kembalikan hasil BMI dan kategori ke view dengan pesan jika disimpan
        return view('bmi', compact('bmiScore', 'bmiCategory', 'message'));
    }

    // Menentukan kategori BMI
    private function getBmiCategory($bmiScore)
    {
        if ($bmiScore < 18.5) {
            return 'Underweight';
        } elseif ($bmiScore >= 18.5 && $bmiScore < 24.9) {
            return 'Normal weight';
        } elseif ($bmiScore >= 25 && $bmiScore < 29.9) {
            return 'Overweight';
        } else {
            return 'Obese';
        }
    }
}
