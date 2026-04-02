<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('productos')->where('nombre', 'Laptop HP Pavilion')->update(['precio' => 15999.00]);
        DB::table('productos')->where('nombre', 'Mouse Logitech MX Master 3')->update(['precio' => 2399.00]);
        DB::table('productos')->where('nombre', 'Teclado Mecánico RGB')->update(['precio' => 3499.00]);
        DB::table('productos')->where('nombre', 'Monitor LG 27 pulgadas 4K')->update(['precio' => 10699.00]);
        DB::table('productos')->where('nombre', 'Auriculares Sony WH-1000XM4')->update(['precio' => 9299.00]);
        DB::table('productos')->where('nombre', 'Webcam Logitech C920')->update(['precio' => 1899.00]);
        DB::table('productos')->where('nombre', 'Disco Duro Externo 2TB')->update(['precio' => 2199.00]);
        DB::table('productos')->where('nombre', 'Router WiFi 6 TP-Link')->update(['precio' => 3999.00]);
        DB::table('productos')->where('nombre', 'Tablet Samsung Galaxy Tab S7')->update(['precio' => 17299.00]);
        DB::table('productos')->where('nombre', 'Impresora HP LaserJet')->update(['precio' => 5299.00]);
    }

    public function down(): void
    {
        DB::table('productos')->where('nombre', 'Laptop HP Pavilion')->update(['precio' => 599.99]);
        DB::table('productos')->where('nombre', 'Mouse Logitech MX Master 3')->update(['precio' => 89.99]);
        DB::table('productos')->where('nombre', 'Teclado Mecánico RGB')->update(['precio' => 129.99]);
        DB::table('productos')->where('nombre', 'Monitor LG 27 pulgadas 4K')->update(['precio' => 399.99]);
        DB::table('productos')->where('nombre', 'Auriculares Sony WH-1000XM4')->update(['precio' => 349.99]);
        DB::table('productos')->where('nombre', 'Webcam Logitech C920')->update(['precio' => 69.99]);
        DB::table('productos')->where('nombre', 'Disco Duro Externo 2TB')->update(['precio' => 79.99]);
        DB::table('productos')->where('nombre', 'Router WiFi 6 TP-Link')->update(['precio' => 149.99]);
        DB::table('productos')->where('nombre', 'Tablet Samsung Galaxy Tab S7')->update(['precio' => 649.99]);
        DB::table('productos')->where('nombre', 'Impresora HP LaserJet')->update(['precio' => 199.99]);
    }
};
