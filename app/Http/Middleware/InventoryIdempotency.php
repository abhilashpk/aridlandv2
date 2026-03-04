<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryIdempotency
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->isMethod('post')) {
            return $next($request);
        }

        $path = trim($request->path(), '/');
        if (!$this->isProtectedInventoryWritePath($path)) {
            return $next($request);
        }

        $token = trim((string) $request->input('submit_token', $request->header('X-Submit-Token', '')));
        if ($token === '') {
            return $this->reject($request, 'Submit token missing. Please refresh and submit again.');
        }

        try {
            DB::table('request_idempotency_keys')->insert([
                'module_code' => $this->resolveModuleCode($path),
                'token' => $token,
                'user_id' => Auth::id() ?? 0,
                'status' => 1,
                'created_at' => now(),
                'used_at' => now(),
                'expires_at' => now()->addDay(),
            ]);
        } catch (QueryException $e) {
            // Unique token collision means replay/retry of the same submit.
            if ((int) $e->getCode() === 23000 || stripos($e->getMessage(), 'Duplicate entry') !== false) {
                return $this->reject($request, 'Duplicate submit detected. Request already processed.');
            }

            throw $e;
        }

        return $next($request);
    }

    private function isProtectedInventoryWritePath(string $path): bool
    {
        $inventoryPrefixes = [
            'purchase_',
            'sales_',
            'stock_transfer',
            'goods_',
            'material_requisition',
            'manufacture',
            'location_transfer',
            'suppliers_do',
            'customers_do',
            'packing_list',
            'proforma_invoice',
            'quotation',
            'item_template',
        ];

        $isInventory = false;
        foreach ($inventoryPrefixes as $prefix) {
            if (stripos($path, $prefix) !== false) {
                $isInventory = true;
                break;
            }
        }

        if (!$isInventory) {
            return false;
        }

        return (bool) preg_match('#/(save|update)(/|$)#i', '/'.$path);
    }

    private function resolveModuleCode(string $path): string
    {
        $segment = explode('/', $path)[0] ?? 'INV';
        $code = strtoupper(substr($segment, 0, 30));

        return $code === '' ? 'INV' : $code;
    }

    private function reject(Request $request, string $message)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message], 409);
        }

        return back()->withInput()->with('error', $message);
    }
}

