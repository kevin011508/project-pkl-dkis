<?php

namespace App\Helpers;

use App\Models\UserGroup;
use App\Models\UserSkpd;
use App\Models\UserNonSkpd;

class PermissionHelper
{
    /**
     * Cek apakah user yang sedang login punya permission tertentu.
     *
     * Contoh penggunaan:
     *   PermissionHelper::can('agenda', 'lihat')
     *   PermissionHelper::can('agenda', 'tambah')
     */
    public static function can(string $module, string $action): bool
    {
        $user = auth()->user();

        if (!$user) return false;

        // Superadmin selalu bisa
        if ($user->role === 'superadmin') return true;

        // ✅ Cek dari session dulu (lebih cepat)
        $permissions = session('permissions', []);

        if (!empty($permissions)) {
            return isset($permissions[$module]) && in_array($action, $permissions[$module]);
        }

        // ✅ Fallback: ambil dari DB kalau session kosong
        $userGroupName = self::getUserGroupName($user);
        if (!$userGroupName) return false;

        $group = UserGroup::where('name', $userGroupName)->first();
        if (!$group || !$group->permission) return false;

        $permissions = json_decode($group->permission, true);

        return isset($permissions[$module]) && in_array($action, $permissions[$module]);
    }

    /**
     * Ambil semua permission user sebagai array.
     * Contoh hasil: ['agenda' => ['lihat', 'tambah'], 'galeri' => ['lihat']]
     */
    public static function all(): array
    {
        $user = auth()->user();
        if (!$user) return [];
        if ($user->role === 'superadmin') return ['*']; // superadmin semua akses

        // ✅ Cek dari session dulu
        $permissions = session('permissions', []);
        if (!empty($permissions)) return $permissions;

        // ✅ Fallback ke DB
        $userGroupName = self::getUserGroupName($user);
        if (!$userGroupName) return [];

        $group = UserGroup::where('name', $userGroupName)->first();
        if (!$group || !$group->permission) return [];

        return json_decode($group->permission, true) ?? [];
    }

    private static function getUserGroupName($user): ?string
    {
        $skpd = UserSkpd::where('username', $user->username)->first();
        if ($skpd && $skpd->user_group) return $skpd->user_group;

        $nonSkpd = UserNonSkpd::where('username', $user->username)->first();
        if ($nonSkpd && $nonSkpd->user_group) return $nonSkpd->user_group;

        return null;
    }
}