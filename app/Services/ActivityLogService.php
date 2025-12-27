<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ActivityLogService
{
    /**
     * Log an activity
     *
     * @param string $action The action performed (create, update, delete, etc.)
     * @param string $modelType The model type (User, Activity, Post, etc.)
     * @param int|null $modelId The ID of the affected model
     * @param array $details Additional details about the action
     * @param int|null $userId The user who performed the action (defaults to current user)
     * @return bool
     */
    public static function log(
        string $action,
        string $modelType,
        ?int $modelId = null,
        array $details = [],
        ?int $userId = null
    ): bool {
        try {
            $userId = $userId ?? Auth::id();

            DB::table('activity_logs')->insert([
                'user_id' => $userId,
                'action' => $action,
                'model_type' => $modelType,
                'model_id' => $modelId,
                'details' => json_encode($details),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Activity log failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Log a create action
     *
     * @param string $modelType
     * @param int $modelId
     * @param array $details
     * @return bool
     */
    public static function created(string $modelType, int $modelId, array $details = []): bool
    {
        return self::log('create', $modelType, $modelId, $details);
    }

    /**
     * Log an update action
     *
     * @param string $modelType
     * @param int $modelId
     * @param array $details
     * @return bool
     */
    public static function updated(string $modelType, int $modelId, array $details = []): bool
    {
        return self::log('update', $modelType, $modelId, $details);
    }

    /**
     * Log a delete action
     *
     * @param string $modelType
     * @param int $modelId
     * @param array $details
     * @return bool
     */
    public static function deleted(string $modelType, int $modelId, array $details = []): bool
    {
        return self::log('delete', $modelType, $modelId, $details);
    }

    /**
     * Log a restore action
     *
     * @param string $modelType
     * @param int $modelId
     * @param array $details
     * @return bool
     */
    public static function restored(string $modelType, int $modelId, array $details = []): bool
    {
        return self::log('restore', $modelType, $modelId, $details);
    }

    /**
     * Log a view action
     *
     * @param string $modelType
     * @param int $modelId
     * @param array $details
     * @return bool
     */
    public static function viewed(string $modelType, int $modelId, array $details = []): bool
    {
        return self::log('view', $modelType, $modelId, $details);
    }

    /**
     * Log a login action
     *
     * @param int|null $userId
     * @param array $details
     * @return bool
     */
    public static function login(?int $userId = null, array $details = []): bool
    {
        return self::log('login', 'User', $userId, $details, $userId);
    }

    /**
     * Log a logout action
     *
     * @param int|null $userId
     * @param array $details
     * @return bool
     */
    public static function logout(?int $userId = null, array $details = []): bool
    {
        return self::log('logout', 'User', $userId, $details, $userId);
    }

    /**
     * Log a failed login attempt
     *
     * @param string $email
     * @param array $details
     * @return bool
     */
    public static function failedLogin(string $email, array $details = []): bool
    {
        $details['email'] = $email;
        return self::log('failed_login', 'User', null, $details, null);
    }

    /**
     * Log an export action
     *
     * @param string $exportType
     * @param array $details
     * @return bool
     */
    public static function exported(string $exportType, array $details = []): bool
    {
        return self::log('export', $exportType, null, $details);
    }

    /**
     * Log an import action
     *
     * @param string $importType
     * @param array $details
     * @return bool
     */
    public static function imported(string $importType, array $details = []): bool
    {
        return self::log('import', $importType, null, $details);
    }

    /**
     * Get recent activity logs
     *
     * @param int $limit
     * @param int|null $userId Filter by user ID
     * @param string|null $modelType Filter by model type
     * @return \Illuminate\Support\Collection
     */
    public static function getRecent(int $limit = 50, ?int $userId = null, ?string $modelType = null)
    {
        $query = DB::table('activity_logs')
            ->orderBy('created_at', 'desc')
            ->limit($limit);

        if ($userId) {
            $query->where('user_id', $userId);
        }

        if ($modelType) {
            $query->where('model_type', $modelType);
        }

        return $query->get();
    }

    /**
     * Get activity logs for a specific model
     *
     * @param string $modelType
     * @param int $modelId
     * @return \Illuminate\Support\Collection
     */
    public static function getForModel(string $modelType, int $modelId)
    {
        return DB::table('activity_logs')
            ->where('model_type', $modelType)
            ->where('model_id', $modelId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get activity logs for a specific user
     *
     * @param int $userId
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public static function getForUser(int $userId, int $limit = 100)
    {
        return DB::table('activity_logs')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get activity statistics
     *
     * @param string|null $startDate
     * @param string|null $endDate
     * @return array
     */
    public static function getStatistics(?string $startDate = null, ?string $endDate = null): array
    {
        $query = DB::table('activity_logs');

        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }

        $total = $query->count();
        $byAction = $query->select('action', DB::raw('count(*) as count'))
            ->groupBy('action')
            ->pluck('count', 'action')
            ->toArray();

        $byModelType = DB::table('activity_logs')
            ->when($startDate, fn($q) => $q->where('created_at', '>=', $startDate))
            ->when($endDate, fn($q) => $q->where('created_at', '<=', $endDate))
            ->select('model_type', DB::raw('count(*) as count'))
            ->groupBy('model_type')
            ->pluck('count', 'model_type')
            ->toArray();

        return [
            'total' => $total,
            'by_action' => $byAction,
            'by_model_type' => $byModelType,
        ];
    }

    /**
     * Clean old activity logs
     *
     * @param int $daysToKeep
     * @return int Number of deleted records
     */
    public static function cleanOldLogs(int $daysToKeep = 90): int
    {
        $date = now()->subDays($daysToKeep);

        return DB::table('activity_logs')
            ->where('created_at', '<', $date)
            ->delete();
    }
}
