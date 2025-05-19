<?php

namespace App\Http\Controllers;
use App\Models\Workorder;
use App\Models\Pricelist;
use Illuminate\Http\Request;
use App\Models\User;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
{
    // Ambil semua service_items dari request
    $allServiceItems = $request->input('service_items', []);

    // FILTER hanya yang dipilih (selected = 1)
    $selectedItems = [];
    foreach ($allServiceItems as $id => $item) {
        if (isset($item['selected']) && $item['selected'] == 1) {
            $selectedItems[$id] = $item;
        }
    }

    // Cek jika tidak ada yang dipilih
    if (empty($selectedItems)) {
        return back()->withErrors(['service_items' => 'Pilih setidaknya satu layanan.']);
    }

    // Lanjut validasi untuk data umum
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'address' => 'required|string|max:255',
    ]);

    // Ambil semua service item dari database berdasarkan ID
    $serviceItemIds = array_keys($selectedItems);
    $serviceItems = Pricelist::whereIn('id', $serviceItemIds)->get();

    $serviceItemsData = [];
    foreach ($serviceItems as $item) {
        $qty = $selectedItems[$item->id]['qty'];

        $serviceItemsData[] = [
            'id' => $item->id,
            'deskripsi' => $item->deskripsi,
            'kapasitas' => $item->kapasitas,
            'harga' => $item->harga,
            'qty' => $qty,
        ];
    }

    // Buat WorkOrder
    // $workorder = Workorder::create([
    //     'name' => $validated['name'],
    //     'email' => $validated['email'],
    //     'phone' => $validated['phone'],
    //     'address' => $validated['address'],
    //     'service_items' => $serviceItemsData,
    // ]);

    $workorder = Workorder::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'address' => $validated['address'],
        'service_items' => $serviceItemsData,
        'status' => 'pending', // default
        'scheduled_at' => null, // nanti bisa diupdate
        'complaint' => $request['customer_note'], // nanti bisa diupdate
    ]);


    // Format pesan WhatsApp
    $message = "Order baru:\n";
    $message .= "Nama: {$validated['name']}\n";
    $message .= "Email: {$validated['email']}\n";
    $message .= "Telepon: {$validated['phone']}\n";
    $message .= "Address: {$validated['address']}\n";
    $message .= "Layanan:\n";

    $totalPayment = 0;

    foreach ($serviceItems as $item) {
        $qty = $selectedItems[$item->id]['qty'];
        $totalPrice = $item->harga * $qty;
        $totalPayment += $totalPrice;
        $message .= "# {$item->deskripsi}, {$item->kapasitas} (Rp. {$item->harga}) x {$qty} = Rp. {$totalPrice}\n";
        $message .= "- {$item->list_pekerjaan}\n";
    }

    $message .= "\nTotal Pembayaran: Rp. {$totalPayment}\n\n";
    $message .= "Transfer via bank:\n";
    $message .= "Mandiri: 1670001139079 Carda Ramdani\n";
    $message .= "BCA: 5680477754 Carda Ramdani\n";
    $message .= "Shopeepay: 082298520919 Sxxxxxxxxxxxxxxx\n";

    $message = urlencode($message);
    $adminPhone = '6281219925055';
    $whatsappUrl = "https://api.whatsapp.com/send?phone={$adminPhone}&text={$message}";

    return redirect($whatsappUrl);
}

}
