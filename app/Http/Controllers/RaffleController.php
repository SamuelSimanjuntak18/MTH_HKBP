<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Winner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RaffleController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('coupon_number')->get();

        $availableCoupons = Coupon::where('payment_status', 'AVAILABLE')
            ->orderBy('coupon_number')
            ->get();

        $soldCoupons = Coupon::whereIn('payment_status', ['UNPAID', 'PARTIAL', 'PAID', 'WINNER'])
            ->orderByDesc('sold_at')
            ->get();

        $winners = Winner::with('coupon')
            ->orderByDesc('drawn_at')
            ->get();

        return view('dashboard', compact(
            'coupons',
            'availableCoupons',
            'soldCoupons',
            'winners'
        ));
    }

    public function storeCoupon(Request $request)
    {
        $request->validate([
            'coupon_number' => 'required|unique:coupons,coupon_number',
            'owner_name' => 'required',
        ]);

        Coupon::create([
            'coupon_number' => $request->coupon_number,
            'owner_name' => $request->owner_name,
            'price' => 100000,
            'paid_amount' => 0,
            'payment_percent' => 0,
            'payment_status' => 'AVAILABLE',
        ]);

        return back()->with('success', 'Kupon berhasil ditambahkan.');
    }

    public function generateCoupons()
    {
        for ($i = 1; $i <= 1000; $i++) {
            Coupon::firstOrCreate(
                ['coupon_number' => str_pad($i, 4, '0', STR_PAD_LEFT)],
                [
                    'owner_name' => 'Pemilik ' . $i,
                    'price' => 100000,
                    'paid_amount' => 0,
                    'payment_percent' => 0,
                    'payment_status' => 'AVAILABLE',
                ]
            );
        }

        return back()->with('success', '1000 kupon berhasil digenerate.');
    }

    public function sellCoupon(Request $request)
    {
        $request->validate([
            'coupon_id' => 'required|exists:coupons,id',
            'buyer_name' => 'required',
            'buyer_phone' => 'required',
            'paid_amount' => 'required|integer|min:0|max:100000',
            'input_by' => 'required',
        ]);

        $coupon = Coupon::findOrFail($request->coupon_id);

        if ($coupon->payment_status !== 'AVAILABLE') {
            return back()->with('error', 'Kupon tidak tersedia.');
        }

        $price = 100000;
        $paidAmount = (int) $request->paid_amount;
        $percent = (int) round(($paidAmount / $price) * 100);

        if ($paidAmount <= 0) {
            $status = 'UNPAID';
        } elseif ($paidAmount < $price) {
            $status = 'PARTIAL';
        } else {
            $status = 'PAID';
        }

        $coupon->update([
            'buyer_name' => $request->buyer_name,
            'buyer_phone' => $request->buyer_phone,
            'price' => $price,
            'paid_amount' => $paidAmount,
            'payment_percent' => $percent,
            'payment_status' => $status,
            'input_by' => $request->input_by,
            'sold_at' => now(),
            'note' => $request->note,
        ]);

        return back()->with('success', 'Data pembelian kupon berhasil disimpan.');
    }

    public function draw(Request $request)
    {
        $coupon = Coupon::where('payment_status', 'PAID')
            ->inRandomOrder()
            ->first();

        if (!$coupon) {
            return back()->with('error', 'Belum ada kupon lunas untuk diundi.');
        }

        DB::transaction(function () use ($coupon, $request) {
            Winner::create([
                'coupon_id' => $coupon->id,
                'prize_name' => $request->prize_name ?? 'Hadiah Undian',
                'drawn_at' => now(),
            ]);

            $coupon->update([
                'payment_status' => 'WINNER',
            ]);
        });

        return back()->with('winner_id', $coupon->id);
    }

    public function cancelCoupon(Coupon $coupon)
    {
        $coupon->update([
            'payment_status' => 'CANCELLED',
        ]);

        return back()->with('success', 'Kupon berhasil dibatalkan.');
    }

    public function reset()
    {
        Winner::query()->delete();
        Coupon::query()->delete();

        return back()->with('success', 'Semua data berhasil direset.');
    }


    public function updateCoupon(Request $request, Coupon $coupon)
{
    $request->validate([
        'coupon_number' => 'required|unique:coupons,coupon_number,' . $coupon->id,
        'owner_name' => 'required',
        'buyer_name' => 'nullable',
        'buyer_phone' => 'nullable',
        'paid_amount' => 'required|integer|min:0|max:100000',
        'input_by' => 'nullable',
        'note' => 'nullable',
    ]);

    $price = 100000;
    $paidAmount = (int) $request->paid_amount;
    $percent = (int) round(($paidAmount / $price) * 100);

    if ($coupon->payment_status === 'WINNER') {
        $status = 'WINNER';
    } elseif ($coupon->payment_status === 'CANCELLED') {
        $status = 'CANCELLED';
    } elseif (!$request->buyer_name) {
        $status = 'AVAILABLE';
        $paidAmount = 0;
        $percent = 0;
    } elseif ($paidAmount <= 0) {
        $status = 'UNPAID';
    } elseif ($paidAmount < $price) {
        $status = 'PARTIAL';
    } else {
        $status = 'PAID';
    }

    $coupon->update([
        'coupon_number' => $request->coupon_number,
        'owner_name' => $request->owner_name,
        'buyer_name' => $request->buyer_name,
        'buyer_phone' => $request->buyer_phone,
        'price' => $price,
        'paid_amount' => $paidAmount,
        'payment_percent' => $percent,
        'payment_status' => $status,
        'input_by' => $request->input_by,
        'note' => $request->note,
        'sold_at' => $request->buyer_name ? ($coupon->sold_at ?? now()) : null,
    ]);

    return back()->with('success', 'Kupon berhasil diupdate.');
}

public function updatePicRange(Request $request)
{
    $request->validate([
        'coupon_numbers' => 'required|string',
        'owner_name' => 'required|string',
    ]);

    $input = str_replace(' ', '', $request->coupon_numbers);
    $parts = explode(',', $input);

    $numbers = [];

    foreach ($parts as $part) {
        if (str_contains($part, '-')) {
            [$start, $end] = explode('-', $part);

            if (!is_numeric($start) || !is_numeric($end)) {
                return back()->with('error', 'Format nomor kupon tidak valid.');
            }

            $start = (int) $start;
            $end = (int) $end;

            if ($start > $end) {
                return back()->with('error', 'Range nomor tidak valid.');
            }

            for ($i = $start; $i <= $end; $i++) {
                $numbers[] = str_pad($i, 4, '0', STR_PAD_LEFT);
            }
        } else {
            if (!is_numeric($part)) {
                return back()->with('error', 'Format nomor kupon tidak valid.');
            }

            $numbers[] = str_pad((int) $part, 4, '0', STR_PAD_LEFT);
        }
    }

    $numbers = array_values(array_unique($numbers));

    $existingCoupons = Coupon::whereIn('coupon_number', $numbers)
        ->pluck('coupon_number')
        ->toArray();

    $missingCoupons = array_diff($numbers, $existingCoupons);

    if (count($missingCoupons) > 0) {
        return back()->with(
            'error',
            'Nomor kupon tidak ditemukan: ' . implode(', ', $missingCoupons)
        );
    }

    $updated = Coupon::whereIn('coupon_number', $numbers)
        ->update([
            'owner_name' => $request->owner_name,
        ]);

    return back()->with('success', "PIC Panitia berhasil diupdate untuk {$updated} kupon.");
}
}
