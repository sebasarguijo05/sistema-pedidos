<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('productos')->where('nombre', 'Laptop HP Pavilion')->update(['imagen' => 'productos/laptop-hp.png']);
        DB::table('productos')->where('nombre', 'Mouse Logitech MX Master 3')->update(['imagen' => 'productos/mouse-master3.png']);
        DB::table('productos')->where('nombre', 'Teclado Mecánico RGB')->update(['imagen' => 'productos/teclado-mecanico.png']);
        DB::table('productos')->where('nombre', 'Monitor LG 27 pulgadas 4K')->update(['imagen' => 'productos/monitor-lg.png']);
        DB::table('productos')->where('nombre', 'Auriculares Sony WH-1000XM4')->update(['imagen' => 'productos/auriculares-sony.png']);
        DB::table('productos')->where('nombre', 'Webcam Logitech C920')->update(['imagen' => 'productos/webcam-logitech.png']);
        DB::table('productos')->where('nombre', 'Disco Duro Externo 2TB')->update(['imagen' => 'productos/discoduro-2tb.png']);
        DB::table('productos')->where('nombre', 'Router WiFi 6 TP-Link')->update(['imagen' => 'productos/router-wifi6.png']);
        DB::table('productos')->where('nombre', 'Tablet Samsung Galaxy Tab S7')->update(['imagen' => 'productos/tablet-tabs7.png']);
        DB::table('productos')->where('nombre', 'Impresora HP LaserJet')->update(['imagen' => 'productos/impresora-hp.png']);
    }

    public function down(): void
    {
        DB::table('productos')->where('nombre', 'Laptop HP Pavilion')->update(['imagen' => null]);
        DB::table('productos')->where('nombre', 'Mouse Logitech MX Master 3')->update(['imagen' => null]);
        DB::table('productos')->where('nombre', 'Teclado Mecánico RGB')->update(['imagen' => null]);
        DB::table('productos')->where('nombre', 'Monitor LG 27 pulgadas 4K')->update(['imagen' => null]);
        DB::table('productos')->where('nombre', 'Auriculares Sony WH-1000XM4')->update(['imagen' => null]);
        DB::table('productos')->where('nombre', 'Webcam Logitech C920')->update(['imagen' => null]);
        DB::table('productos')->where('nombre', 'Disco Duro Externo 2TB')->update(['imagen' => null]);
        DB::table('productos')->where('nombre', 'Router WiFi 6 TP-Link')->update(['imagen' => null]);
        DB::table('productos')->where('nombre', 'Tablet Samsung Galaxy Tab S7')->update(['imagen' => null]);
        DB::table('productos')->where('nombre', 'Impresora HP LaserJet')->update(['imagen' => null]);
    }
};
