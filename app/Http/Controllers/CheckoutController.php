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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'service_items' => 'required|array',
            'service_items.*.id' => 'exists:pricelists,id',
            'service_items.*.qty' => 'required|integer|min:1',
        ]);
        $serviceItems = Pricelist::whereIn('id', array_column($validated['service_items'], 'id'))->get();

        $serviceItemsData = [];

        foreach ($serviceItems as $item) {
        $qty = $validated['service_items'][$item->id]['qty'];

        // foreach ($validated['service_items'] as $item) {
            $serviceItem = Pricelist::find($item['id']);
            $serviceItemsData[] = [
                'id' => $serviceItem->id,
                'deskripsi' => $serviceItem->deskripsi,
                'kapasitas' => $serviceItem->kapasitas,
                'harga' => $serviceItem->harga,
                'qty' => $qty,
            ];
        }

        $workorder = Workorder::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'service_items' => $serviceItemsData,
        ]);



        $message = "Order baru:\n";
        $message .= "Nama: {$validated['name']}\n";
        $message .= "Email: {$validated['email']}\n";
        $message .= "Telepon: {$validated['phone']}\n";
        $message .= "Address: {$validated['address']}\n";
        $message .= "Layanan:\n";

        $totalPayment = 0; // Inisialisasi total pembayaran

        foreach ($serviceItems as $item) {
            $qty = $validated['service_items'][$item->id]['qty'];

            // $qty = $request->input("qty_{$item->id}"); // Mengambil kuantitas dari input form
            $totalPrice = $item->harga * $qty; // Menghitung harga total per item
            $totalPayment += $totalPrice; // Menambahkan harga total per item ke total pembayaran
            $message .= "# {$item->deskripsi}, {$item->kapasitas} (Rp. {$item->harga}) x {$qty} = Rp. {$totalPrice}\n";
            $message .= "- {$item->list_pekerjaan}\n";
        }

        $message .= "\n";
        $message .= "Total Pembayaran: Rp. {$totalPayment}\n";
        $message .= "\n";
        $message .= "transfer via bank : \n";
        $message .= "Mandiri : 1670001139079 carda ramdani\n";
        $message .= "BCA : 5680477754 carda ramdani\n";
        $message .= "Shopeepay : 082298520919 Sxxxxxxxxxxxxxxx\n";


        $message = urlencode($message);
        $adminPhone = '6282298520919';
        $whatsappUrl = "https://api.whatsapp.com/send?phone={$adminPhone}&text={$message}";

        return redirect($whatsappUrl);
    }
}
