<?php

namespace App\Helpers;

use App\Models\UserGroup;
use App\Models\UserSkpd;
use App\Models\UserNonSkpd;

class PermissionHelper
{
    public static function can(string $module, string $action): bool
    {
        $user = auth()->user();

        if (!$user) return false;

        // Superadmin selalu bisa
        if ($user->role === 'superadmin') return true;

        // Admin selalu bisa
        if ($user->role === 'admin') return true;

        // Cek dari session dulu (lebih cepat)
        $permissions = session('permissions', []);

        if (!empty($permissions)) {
            return isset($permissions[$module]) && in_array($action, $permissions[$module]);
        }

        // Fallback: ambil dari DB kalau session kosong
        $userGroupName = self::getUserGroupName($user);
        if (!$userGroupName) return false;

        $group = UserGroup::where('name', $userGroupName)->first();
        if (!$group || !$group->permission) return false;

        $permissions = json_decode($group->permission, true);

        return isset($permissions[$module]) && in_array($action, $permissions[$module]);
    }

    public static function all(): array
    {
        $user = auth()->user();
        if (!$user) return [];

        // Superadmin semua akses
        if ($user->role === 'superadmin') return ['*'];

        // Admin semua akses
        if ($user->role === 'admin') return ['*'];

        // Cek dari session dulu
        $permissions = session('permissions', []);
        if (!empty($permissions)) return $permissions;

        // Fallback ke DB
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