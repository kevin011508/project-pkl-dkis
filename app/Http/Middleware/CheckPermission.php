<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class CheckPermission
{
    public function handle(Request $request, Closure $next, string $module, string $action): Response
    {
        $user = auth()->user();

        // Superadmin bebas akses semua
        if ($user->role === 'superadmin') {
            return $next($request);
        }

        // ✅ Cek dari session dulu
        $permissions = session('permissions', []);
        if (isset($permissions[$module]) && in_array($action, $permissions[$module])) {
            return $next($request);
        }

        // ✅ Fallback: ambil dari DB kalau session kosong
        $userGroup = $this->getUserGroup($user);
        if ($userGroup) {
            $group = \App\Models\UserGroup::where('name', $userGroup)->first();
            if ($group && $group->permission) {
                $permissions = json_decode($group->permission, true);
                if (isset($permissions[$module]) && in_array($action, $permissions[$module])) {
                    return $next($request);
                }
            }
        }

        abort(403, 'Anda tidak memiliki izin untuk melakukan aksi ini.');
    }

    private function getUserGroup($user): ?string
    {
        $skpd = \App\Models\UserSkpd::where('username', $user->username)->first();
        if ($skpd && $skpd->user_group) {
            return $skpd->user_group;
        }

        $nonSkpd = \App\Models\UserNonSkpd::where('username', $user->username)->first();
        if ($nonSkpd && $nonSkpd->user_group) {
            return $nonSkpd->user_group;
        }

        return null;
    }
}