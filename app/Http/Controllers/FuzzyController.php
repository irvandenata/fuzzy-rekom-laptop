<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FuzzyController extends Controller
{
    public static function fuzzyTahun($x, $tipe)
    {
        if ($tipe == 'terbaru') {
            if ($x <= 2012) {
                return 0;
            } else if ($x >= 2012 && $x <= 2022) {
                return ($x - 2012) / (2022 - 2012);
            } elseif ($x >= 2022) {
                return 1;
            }
        } else {
            if ($x <= 2006) {
                return 1;
            } else if ($x >= 2006 && $x <= 2014) {
                return (2014 - $x) / (2014 - 2006);
            } elseif ($x >= 2014) {
                return 0;
            }

        }
    }

    public static function fuzzyKecProcessor($x, $tipe)
    {
        if ($tipe == 'cepat') {
            if ($x <= 2.5) {
                return 0;
            } else if ($x >= 2.5 && $x <= 4) {
                return ($x - 2.5) / (4 - 2.5);
            } elseif ($x >= 4) {
                return 1;
            }
        } else if ($tipe == 'sedang') {
            if ($x >= 2 || $x <= 3) {
                return 0;
            } else if ($x >= 2 && $x <= 2.5) {
                return ($x - 2) / (2.5 - 2);
            } elseif ($x >= 2.5 && $x <= 3) {
                return (3 - $x) / (3 - 2.5);
            }
        } else if ($tipe == 'lambat') {
            if ($x <= 1) {
                return 1;
            } else if ($x >= 1 && $x <= 2.5) {
                return (2.5 - $x) / (2.5 - 1);
            } elseif ($x >= 2.5) {
                return 0;
            }
        }

    }

    public static function fuzzyRam($x, $tipe)
    {
        if ($tipe == 'besar') {
            if ($x <= 4) {
                return 0;
            } else if ($x >= 4 && $x <= 16) {
                return ($x - 4) / (16 - 4);
            } elseif ($x >= 16) {
                return 1;
            }
        } else {
            if ($x <= 0) {
                return 1;
            } else if ($x >= 0 && $x <= 8) {
                return (8 - $x) / (8);
            } elseif ($x >= 8) {
                return 0;
            }
        }
    }

    public static function fuzzyKecRam($x, $tipe)
    {
        if ($tipe == 'cepat') {
            if ($x <= 1200) {
                return 0;
            } else if ($x >= 1200 && $x <= 2200) {
                return ($x - 1200) / (2200 - 1200);
            } elseif ($x >= 2200) {
                return 1;
            }
        } else {
            if ($x <= 800) {
                return 1;
            } else if ($x >= 800 && $x <= 1800) {
                return (1800 - $x) / (1800 - 800);
            } elseif ($x >= 1800) {
                return 0;
            }
        }
    }

    public static function fuzzyStorage($x, $tipe)
    {
        if ($tipe == 'besar') {
            if ($x <= 300) {
                return 0;
            } else if ($x >= 300 && $x <= 500) {
                return ($x - 300) / (500 - 300);
            } elseif ($x >= 500) {
                return 1;
            }
        } else if ($tipe == 'sedang') {
            if ($x >= 150 || $x <= 350) {
                return 0;
            } else if ($x >= 150 && $x <= 250) {
                return ($x - 150) / (250 - 150);
            } elseif ($x >= 250 && $x <= 350) {
                return (350 - $x) / (350 - 250);
            }
        } else if ($tipe == 'kecil') {
            if ($x <= 100) {
                return 1;
            } else if ($x >= 100 && $x <= 200) {
                return (200 - $x) / (200 - 100);
            } elseif ($x >= 200) {
                return 0;
            }
        }
    }

    public static function fuzzyKecStorage($x, $tipe)
    {
        if ($tipe == 'cepat') {
            if ($x <= 1000) {
                return 0;
            } else if ($x >= 1000 && $x <= 2500) {
                return ($x - 1000) / (2500 - 1000);
            } elseif ($x >= 2500) {
                return 1;
            }
        } else if ($tipe == 'sedang') {
            if ($x >= 500 || $x <= 1500) {
                return 1;
            } else if ($x >= 500 && $x <= 1000) {
                return ($x - 500) / (1000 - 500);
            } elseif ($x >= 1000 && $x <= 1500) {
                return (1500 - $x) / (1500 - 1000);
            }
        } else if ($tipe == 'kecil') {
            if ($x <= 500) {
                return 1;
            } else if ($x >= 500 && $x <= 1000) {
                return (1000 - $x) / (1000 - 500);
            } elseif ($x >= 1000) {
                return 0;
            }
        }
    }

    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $kec_processor = $request->speed_processor;
        $ram = $request->ram;
        $kec_ram = $request->speed_ram;
        $storage = $request->storage;
        $kec_write = $request->speed_write;
        $kec_read = $request->speed_read;
        $tipe = $request->tipe;
        $biaya = $request->harga;

        $product = Product::all();
        foreach ($product as $key => $item) {
            $item->fuzzy_tahun = self::fuzzyTahun($item->tahun, $tahun);
            $item->fuzzy_processor = self::fuzzyKecProcessor($item->speed_processor, $kec_processor);
            $item->fuzzy_ram = self::fuzzyRam($item->ram, $ram);
            $item->fuzzy_kec_ram = self::fuzzyKecRam($item->speed_ram, $kec_ram);
            $item->fuzzy_storage = self::fuzzyStorage($item->storage, $storage);
            $item->fuzzy_storage_write = self::fuzzyKecStorage($item->speed_write, $kec_write);
            $item->fuzzy_storage_read = self::fuzzyKecStorage($item->speed_read, $kec_read);
            $item->derajat_keanggotaan = $item->fuzzy_tahun + $item->fuzzy_processor + $item->fuzzy_ram + $item->fuzzy_kec_ram + $item->fuzzy_storage + $item->fuzzy_storage_write + $item->fuzzy_storage_read;
            $item->rata_derajat_keanggotaan = ($item->fuzzy_tahun + $item->fuzzy_processor + $item->fuzzy_ram + $item->fuzzy_kec_ram + $item->fuzzy_storage + $item->fuzzy_storage_write + $item->fuzzy_storage_read) / 7;

        }

        $product = $product->where('tipe', $tipe);
        $data['product'] = $product->where('harga', '<=', $biaya)->sortByDesc('rata_derajat_keanggotaan');
        return view('fuzzy', $data);
    }

    public function form()
    {
        return view('form');
    }
}
