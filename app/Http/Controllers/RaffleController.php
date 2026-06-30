<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Setting;
use App\Models\Pic;
use App\Models\Winner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RaffleController extends Controller
{
public function index()
{
    $coupons = Coupon::orderBy('coupon_number')->get();

    $availableCoupons = Coupon::where('payment_status', 'AVAILABLE')
        ->whereNotNull('owner_name')
        ->orderBy('coupon_number')
        ->get();

    $soldCoupons = Coupon::whereIn('payment_status', [
            'UNPAID',
            'PARTIAL',
            'PAID',
            'WINNER'
        ])
        ->orderByDesc('sold_at')
        ->get();

    $winners = Winner::with('coupon')
        ->orderByDesc('drawn_at')
        ->get();

    $pics = Pic::orderBy('name')->get();

    $activePics = Pic::where('is_active', true)
        ->orderBy('name')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Setting Pengundian
    |--------------------------------------------------------------------------
    */
    $setting = Setting::first();

    if (!$setting) {
        $setting = Setting::create([
            'raffle_enabled' => false
        ]);
    }

    $canDraw = $setting->raffle_enabled;

    /*
    |--------------------------------------------------------------------------
    | Statistik
    |--------------------------------------------------------------------------
    */
    $couponPrice = 100000;
    $totalCoupons = $coupons->where('coupon_type', 'SALE')->count();
    $targetAmount = $totalCoupons * $couponPrice;
    $paidAmountTotal = $coupons->sum('paid_amount');
    $remainingAmount = max($targetAmount - $paidAmountTotal, 0);

    $moneyProgress = $targetAmount > 0
        ? round(($paidAmountTotal / $targetAmount) * 100, 1)
        : 0;

    $hasSaleCoupons = Coupon::where('coupon_type', 'SALE')->exists();

    /*
    |--------------------------------------------------------------------------
    | Cek Reward Coupon
    |--------------------------------------------------------------------------
    */
    $canGenerateReward = false;

    foreach ($activePics as $pic) {

        $paidSaleCoupons = Coupon::where('coupon_type', 'SALE')
            ->where('owner_name', $pic->name)
            ->whereIn('payment_status', ['PAID', 'WINNER'])
            ->count();

        $rewardShouldGet = intdiv($paidSaleCoupons, 35);

        $rewardAlreadyCreated = Coupon::where('coupon_type', 'REWARD')
            ->where('reward_for_pic', $pic->name)
            ->count();

        if ($rewardShouldGet > $rewardAlreadyCreated) {
            $canGenerateReward = true;
            break;
        }
    }

    return view('admin-dashboard', compact(
        'coupons',
        'availableCoupons',
        'soldCoupons',
        'winners',
        'targetAmount',
        'paidAmountTotal',
        'remainingAmount',
        'moneyProgress',
        'pics',
        'activePics',
        'hasSaleCoupons',
        'canGenerateReward',
        'canDraw',
        'setting'
    ));
}

    public function publicWinners()
{
    $winners = Winner::with('coupon')
        ->latest('drawn_at')
        ->get();

    $soldCoupons = Coupon::whereIn('payment_status', [
            'UNPAID',
            'PARTIAL',
            'PAID',
            'WINNER'
        ])
        ->orderByDesc('sold_at')
        ->get();

    return view('public-winners', compact(
        'winners',
        'soldCoupons'
    ));
}

    public function storeCoupon(Request $request)
    {
        $request->validate([
            'coupon_number' => 'required|unique:coupons,coupon_number',
            'owner_name' => 'nullable|string',
        ]);

        Coupon::create([
            'coupon_number' => str_pad((int) $request->coupon_number, 4, '0', STR_PAD_LEFT),
            'coupon_type' => ((int) $request->coupon_number > 1500) ? 'REWARD' : 'SALE',
            'owner_name' => $request->owner_name ?: null,
            'reward_for_pic' => null,
            'price' => ((int) $request->coupon_number > 1500) ? 0 : 100000,
            'paid_amount' => 0,
            'payment_percent' => 0,
            'payment_status' => 'AVAILABLE',
            'input_by' => auth()->user()->name,
        ]);

        return back()->with('success', 'Kupon berhasil ditambahkan.')->with('active_page', 'coupons');
    }

    public function generateCoupons()
    {
        if (Coupon::where('coupon_type', 'SALE')->exists()) {
            return back()
                ->with('error', '1500 kupon penjualan sudah pernah digenerate.')
                ->with('active_page', 'coupons');
        }

        DB::transaction(function () {
            for ($i = 1; $i <= 1500; $i++) {
                Coupon::create([
                    'coupon_number' => str_pad($i, 4, '0', STR_PAD_LEFT),
                    'coupon_type' => 'SALE',
                    'owner_name' => null,
                    'reward_for_pic' => null,
                    'price' => 100000,
                    'paid_amount' => 0,
                    'payment_percent' => 0,
                    'payment_status' => 'AVAILABLE',
                    'input_by' => auth()->user()->name,
                ]);
            }
        });

        return back()->with('success', '1500 kupon jual berhasil digenerate.')->with('active_page', 'coupons');
    }

   public function generateRewardCoupons()
{
    $pics = Pic::where('is_active', true)->get();
    $created = 0;

    DB::transaction(function () use ($pics, &$created) {

        foreach ($pics as $pic) {

            $paidSaleCoupons = Coupon::where('coupon_type', 'SALE')
                ->where('owner_name', $pic->name)
                ->whereIn('payment_status', ['PAID', 'WINNER'])
                ->count();

            $rewardShouldGet = intdiv($paidSaleCoupons, 35);

            $rewardAlreadyCreated = Coupon::where('coupon_type', 'REWARD')
                ->where('reward_for_pic', $pic->name)
                ->count();

            $rewardToCreate = max($rewardShouldGet - $rewardAlreadyCreated, 0);

            for ($i = 0; $i < $rewardToCreate; $i++) {

                $lastNumber = (int) Coupon::max(DB::raw('CAST(coupon_number AS UNSIGNED)'));
                $nextNumber = max($lastNumber + 1, 1501);

                Coupon::create([
                    'coupon_number'     => str_pad($nextNumber, 4, '0', STR_PAD_LEFT),
                    'coupon_type'       => 'REWARD',
                    'owner_name'        => $pic->name,
                    'reward_for_pic'    => $pic->name,
                    'buyer_name'        => $pic->name,
                    'buyer_phone'       => $pic->phone,
                    'price'             => 0,
                    'paid_amount'       => 0,
                    'payment_percent'   => 100,
                    'payment_status'    => 'PAID',
                    'input_by'          => 'SYSTEM REWARD',
                    'sold_at'           => now(),
                    'note'              => 'Reward 1 kupon gratis karena berhasil menjual 35 kupon.',
                ]);

                $created++;
            }
        }

    });

    // Cek apakah masih ada reward yang bisa digenerate
    $canGenerateReward = false;

    foreach ($pics as $pic) {

        $paidSaleCoupons = Coupon::where('coupon_type', 'SALE')
            ->where('owner_name', $pic->name)
            ->whereIn('payment_status', ['PAID', 'WINNER'])
            ->count();

        $rewardShouldGet = intdiv($paidSaleCoupons, 35);

        $rewardAlreadyCreated = Coupon::where('coupon_type', 'REWARD')
            ->where('reward_for_pic', $pic->name)
            ->count();

        if ($rewardShouldGet > $rewardAlreadyCreated) {
            $canGenerateReward = true;
            break;
        }
    }

    return back()
        ->with('success', "{$created} kupon reward berhasil digenerate.")
        ->with('active_page', 'coupons')
        ->with('canGenerateReward', $canGenerateReward);
}

    public function sellCoupon(Request $request)
    {
        $request->validate([
            'coupon_id' => 'required|exists:coupons,id',
            'buyer_name' => 'required|string',
            'buyer_phone' => 'required|string',
            'paid_amount' => 'required|integer|min:0|max:100000',
            'note' => 'nullable|string',
        ]);

        $coupon = Coupon::findOrFail($request->coupon_id);

        if ($coupon->payment_status !== 'AVAILABLE') {
            return back()->with('error', 'Kupon tidak tersedia.')->with('active_page', 'sell');
        }

        $price = (int) ($coupon->price ?? 100000);
        $price = $price <= 0 ? 100000 : $price;
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
            'input_by' => auth()->user()->name,
            'sold_at' => now(),
            'note' => $request->note,
        ]);

        return back()->with('success', 'Data pembelian kupon berhasil disimpan.')->with('active_page', 'sell');
    }

   public function updateCoupon(Request $request, Coupon $coupon)
{
    // Tidak boleh edit jika belum ada PIC
    // atau status sudah final
    if (
        empty($coupon->owner_name) ||
        in_array($coupon->payment_status, ['PAID', 'WINNER', 'CANCELLED'])
    ) {
        return back()
            ->with('error', 'Kupon ini tidak dapat diedit.')
            ->with('active_page', 'coupons');
    }

    $request->validate([
        'coupon_number' => 'required|unique:coupons,coupon_number,' . $coupon->id,
        'owner_name'    => 'nullable|string',
        'buyer_name'    => 'nullable|string',
        'buyer_phone'   => 'nullable|string',
        'paid_amount'   => 'required|integer|min:0|max:100000',
        'note'          => 'nullable|string',
    ]);

    // Harga berdasarkan jenis kupon
    if ($coupon->coupon_type === 'SALE') {
        $price = 100000;
    } else {
        $price = 0;
    }

    $paidAmount = (int) $request->paid_amount;

    // Hitung persentase pembayaran
    if ($price > 0) {
        $percent = min(100, (int) round(($paidAmount / $price) * 100));
    } else {
        // Reward selalu dianggap lunas
        $percent = 100;
        $paidAmount = 0;
    }

    // Tentukan status pembayaran
    if (!$request->buyer_name) {

        $status = 'AVAILABLE';
        $paidAmount = 0;
        $percent = 0;

    } elseif ($price == 0) {

        // Kupon Reward
        $status = 'PAID';

    } elseif ($paidAmount <= 0) {

        $status = 'UNPAID';

    } elseif ($paidAmount < $price) {

        $status = 'PARTIAL';

    } else {

        $status = 'PAID';

    }

    $coupon->update([
        'coupon_number'   => str_pad((int)$request->coupon_number, 4, '0', STR_PAD_LEFT),
        'owner_name'      => $request->owner_name ?: null,
        'buyer_name'      => $request->buyer_name,
        'buyer_phone'     => $request->buyer_phone,
        'price'           => $price,
        'paid_amount'     => $paidAmount,
        'payment_percent' => $percent,
        'payment_status'  => $status,
        'input_by'        => auth()->user()->name,
        'note'            => $request->note,
        'sold_at'         => $request->buyer_name
                                ? ($coupon->sold_at ?? now())
                                : null,
    ]);

    return back()
        ->with('success', 'Kupon berhasil diupdate.')
        ->with('active_page', 'coupons');
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
                    return back()->with('error', 'Format nomor kupon tidak valid.')->with('active_page', 'coupons');
                }

                $start = (int) $start;
                $end = (int) $end;

                if ($start > $end) {
                    return back()->with('error', 'Range nomor tidak valid.')->with('active_page', 'coupons');
                }

                for ($i = $start; $i <= $end; $i++) {
                    $numbers[] = str_pad($i, 4, '0', STR_PAD_LEFT);
                }
            } else {
                if (!is_numeric($part)) {
                    return back()->with('error', 'Format nomor kupon tidak valid.')->with('active_page', 'coupons');
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
            return back()
                ->with('error', 'Nomor kupon tidak ditemukan: ' . implode(', ', $missingCoupons))
                ->with('active_page', 'coupons');
        }

        $updated = Coupon::whereIn('coupon_number', $numbers)
            ->update([
                'owner_name' => $request->owner_name,
            ]);

        return back()->with('success', "PIC Panitia berhasil diupdate untuk {$updated} kupon.")->with('active_page', 'coupons');
    }

    public function storePic(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:pics,name',
            'phone' => 'nullable|string',
        ]);

        Pic::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'is_active' => true,
        ]);

        return back()->with('success', 'PIC Panitia berhasil ditambahkan.')->with('active_page', 'pics');
    }

    public function updatePic(Request $request, Pic $pic)
    {
        $request->validate([
            'name' => 'required|string|unique:pics,name,' . $pic->id,
            'phone' => 'nullable|string',
        ]);

        $pic->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'PIC Panitia berhasil diupdate.')->with('active_page', 'pics');
    }

    public function togglePic(Pic $pic)
    {
        $pic->update([
            'is_active' => !$pic->is_active,
        ]);

        return back()->with('success', 'Status PIC Panitia berhasil diubah.')->with('active_page', 'pics');
    }

  public function draw(Request $request)
{
    $coupon = Coupon::whereIn('coupon_type', ['SALE', 'REWARD'])
        ->where('payment_status', 'PAID')
        ->whereDoesntHave('winner')
        ->inRandomOrder()
        ->first();

    if (!$coupon) {
        return response()->json([
            'success' => false,
            'message' => 'Tidak ada kupon yang dapat diundi.',
        ], 422);
    }

    DB::transaction(function () use ($coupon, $request) {

        Winner::create([
            'coupon_id' => $coupon->id,
            'prize_name' => $request->prize_name ?: 'Hadiah Undian',
            'drawn_at' => now(),
        ]);

        $coupon->update([
            'payment_status' => 'WINNER',
        ]);

    });

    return response()->json([
        'success' => true,
        'message' => 'Pemenang berhasil dipilih.',
        'winner' => [
            'coupon_number' => $coupon->coupon_number,
            'buyer_name'    => $coupon->buyer_name,
            'buyer_phone'   => $coupon->buyer_phone,
            'owner_name'    => $coupon->owner_name ?: 'Belum Ada PIC',
            'coupon_type'   => $coupon->coupon_type,
            'prize_name'    => $request->prize_name ?: 'Hadiah Undian',
        ],
    ]);
}
    public function cancelCoupon(Coupon $coupon)
    {
        $coupon->update([
            'payment_status' => 'CANCELLED',
        ]);

        return back()->with('success', 'Kupon berhasil dibatalkan.')->with('active_page', 'coupons');
    }

    public function reset()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Winner::truncate();
        Coupon::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return back()->with('success', 'Semua data berhasil direset.')->with('active_page', 'coupons');
    }


}
