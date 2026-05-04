<?php

namespace App\Support;

use App\Models\User;

class PanelResolver
{
    /**
     * Map role → panel base path
     */
    protected static array $map = [
        'super_admin' => '/admin',
        'akademik'    => '/adm',
        'guru'        => '/guru',
        'siswa'       => '/siswa',
        'orang_tua'   => '/ortu',
    ];

    /**
     * Map role → Filament panel id (as registered in PanelProvider)
     */
    protected static array $panelIds = [
        'super_admin' => 'admin',
        'akademik'    => 'akademik',
        'guru'        => 'guru',
        'siswa'       => 'siswa',
        'orang_tua'   => 'orang-tua',
    ];

    /**
     * Get the primary role name of a user via Spatie HasRoles.
     */
    protected static function roleOf(User $user): string
    {
        return $user->getRoleNames()->first() ?? '';
    }

    /**
     * Resolve the Filament panel id for a given user's role.
     */
    public static function panelId(User $user): ?string
    {
        return static::$panelIds[static::roleOf($user)] ?? null;
    }

    /**
     * Check whether a user is allowed to access a given Filament panel.
     */
    public static function canAccess(User $user, string $panelId): bool
    {
        return (static::$panelIds[static::roleOf($user)] ?? null) === $panelId;
    }

    /**
     * Resolve redirect URL for a given user based on their role.
     */
    public static function redirectUrl(User $user): string
    {
        return static::$map[static::roleOf($user)] ?? '/';
    }

    /**
     * Resolve required role for a given URL path prefix.
     * Returns null if the path is not a known panel.
     */
    public static function roleForPath(string $path): ?string
    {
        $normalized = '/' . ltrim($path, '/');

        foreach (static::$map as $role => $panelPath) {
            if (str_starts_with($normalized, $panelPath)) {
                return $role;
            }
        }

        return null;
    }

    /**
     * All registered panel paths.
     */
    public static function panelPaths(): array
    {
        return array_values(static::$map);
    }

    /**
     * All allowed role names.
     */
    public static function allowedRoles(): array
    {
        return array_keys(static::$map);
    }
}