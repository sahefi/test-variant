<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function generateVariants()
    {
        $data1 = [
            [
                "image" => "",
                "varian1" => "Merah Muda",
                "varian1_type" => "warna",
                "varian2" => "10",
                "varian2_type" => "ukuran",
                "harga" => 0,
                "stok" => "",
                "berat" => 0,
                "status" => 1,
                "main" => 0
            ],
            [
                "image" => "",
                "varian1" => "Merah",
                "varian1_type" => "warna",
                "varian2" => "10",
                "varian2_type" => "ukuran",
                "harga" => 0,
                "stok" => "",
                "berat" => 0,
                "status" => 1,
                "main" => 0
            ]
        ];

        $data2 = ["2", "10", "4"];

        $hasil = [];

        foreach ($data1 as $item) {
            $hasil[] = $item;
            foreach ($data2 as $variant) {
                if ($item['varian2'] != $variant) {
                    $newItem = $item;
                    $newItem['varian2'] = $variant;
                    $hasil[] = $newItem;
                }
            }
        }

        return $hasil;
    }

    public function groupByVarian()
    {
        $data = [
            [
                "id" => "12e5a405-ae6c-4f3d-ae75-eaaff75e0b56",
                "m_produk_id" => "5516d87b-2cd5-460c-a1da-b937751b99f7",
                "sku" => "JC123145",
                "image" => "http://localhost:8000/storage/images/produk-variant/p7j6Ip9tUv.jpg",
                "varian1_type" => "warna",
                "varian1" => "Biru Muda",
                "varian2_type" => "ukuran",
                "varian2" => "0",
                "harga" => 600000,
                "stok" => 50,
                "berat" => 6000,
                "main" => 0,
                "status" => 1
            ],
            [
                "id" => "cc73dfe9-11b1-4134-8d0e-324f49ff49dd",
                "m_produk_id" => "5516d87b-2cd5-460c-a1da-b937751b99f7",
                "sku" => "JC2518289",
                "image" => "http://localhost:8000/storage/images/produk-variant/TCQcBoopJD.jpg",
                "varian1_type" => "warna",
                "varian1" => "Biru Muda",
                "varian2_type" => "ukuran",
                "varian2" => "4",
                "harga" => 80000,
                "stok" => 5,
                "berat" => 4213,
                "main" => 0,
                "status" => 1
            ],
            [
                "id" => "95cb3a1b-01bc-4dc0-84c9-9780f20fe243",
                "m_produk_id" => "5516d87b-2cd5-460c-a1da-b937751b99f7",
                "sku" => "JSC910238",
                "image" => "http://localhost:8000/storage/images/produk-variant/JTC47vnjCx.jpg",
                "varian1_type" => "warna",
                "varian1" => "Merah Muda",
                "varian2_type" => "ukuran",
                "varian2" => "4",
                "harga" => 40000,
                "stok" => 32,
                "berat" => 5000,
                "main" => 0,
                "status" => 1
            ],
            [
                "id" => "d68dbcfa-9542-4dc5-b143-4049e0bf429e",
                "m_produk_id" => "5516d87b-2cd5-460c-a1da-b937751b99f7",
                "sku" => "JCSA192837",
                "image" => "http://localhost:8000/storage/images/produk-variant/UQudczsCNp.jpg",
                "varian1_type" => "warna",
                "varian1" => "Merah Muda",
                "varian2_type" => "ukuran",
                "varian2" => "0",
                "harga" => 200000,
                "stok" => 80,
                "berat" => 3000,
                "main" => 0,
                "status" => 1
            ]
        ];

        $groupedData = collect($data)->groupBy('varian1');

        return response()->json($groupedData);
    }
}
