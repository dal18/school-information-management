<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;

class ReportService
{
    /**
     * Generate a PDF report
     *
     * @param string $viewName The blade view to use for the PDF
     * @param array $data Data to pass to the view
     * @param string $fileName The output filename
     * @param string $orientation Portrait or landscape
     * @param string $paperSize A4, letter, etc.
     * @return \Barryvdh\DomPDF\PDF
     */
    public static function generatePDF(
        string $viewName,
        array $data = [],
        string $fileName = 'report.pdf',
        string $orientation = 'portrait',
        string $paperSize = 'a4'
    ) {
        $pdf = Pdf::loadView($viewName, $data)
            ->setPaper($paperSize, $orientation);

        return $pdf;
    }

    /**
     * Generate and download a PDF report
     *
     * @param string $viewName
     * @param array $data
     * @param string $fileName
     * @param string $orientation
     * @param string $paperSize
     * @return \Illuminate\Http\Response
     */
    public static function downloadPDF(
        string $viewName,
        array $data = [],
        string $fileName = 'report.pdf',
        string $orientation = 'portrait',
        string $paperSize = 'a4'
    ) {
        $pdf = self::generatePDF($viewName, $data, $fileName, $orientation, $paperSize);
        return $pdf->download($fileName);
    }

    /**
     * Generate and stream a PDF report (display in browser)
     *
     * @param string $viewName
     * @param array $data
     * @param string $fileName
     * @param string $orientation
     * @param string $paperSize
     * @return \Illuminate\Http\Response
     */
    public static function streamPDF(
        string $viewName,
        array $data = [],
        string $fileName = 'report.pdf',
        string $orientation = 'portrait',
        string $paperSize = 'a4'
    ) {
        $pdf = self::generatePDF($viewName, $data, $fileName, $orientation, $paperSize);
        return $pdf->stream($fileName);
    }

    /**
     * Export data to CSV
     *
     * @param Collection|array $data
     * @param array $headers
     * @param string $fileName
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public static function exportToCSV($data, array $headers, string $fileName = 'export.csv')
    {
        $callback = function() use ($data, $headers) {
            $file = fopen('php://output', 'w');

            // Write headers
            fputcsv($file, $headers);

            // Write data
            foreach ($data as $row) {
                $row = is_array($row) ? $row : (array) $row;
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    /**
     * Export data to Excel (CSV format)
     *
     * @param Collection|array $data
     * @param array $headers
     * @param string $fileName
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public static function exportToExcel($data, array $headers, string $fileName = 'export.xlsx')
    {
        // If you have PhpSpreadsheet installed, you can implement proper Excel export here
        // For now, we'll use CSV which Excel can open
        return self::exportToCSV($data, $headers, str_replace('.xlsx', '.csv', $fileName));
    }

    /**
     * Generate user activity report
     *
     * @param int|null $userId
     * @param string|null $startDate
     * @param string|null $endDate
     * @return array
     */
    public static function getUserActivityReport(?int $userId = null, ?string $startDate = null, ?string $endDate = null): array
    {
        $query = DB::table('activity_logs')
            ->join('users', 'activity_logs.user_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.full_name',
                'users.email',
                DB::raw('COUNT(*) as total_activities'),
                DB::raw('COUNT(DISTINCT DATE(activity_logs.created_at)) as active_days')
            )
            ->groupBy('users.id', 'users.full_name', 'users.email');

        if ($userId) {
            $query->where('users.id', $userId);
        }

        if ($startDate) {
            $query->where('activity_logs.created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('activity_logs.created_at', '<=', $endDate);
        }

        $activities = $query->get();

        return [
            'data' => $activities,
            'total_users' => $activities->count(),
            'total_activities' => $activities->sum('total_activities'),
            'period' => [
                'start' => $startDate ?? 'All time',
                'end' => $endDate ?? 'Present',
            ],
        ];
    }

    /**
     * Generate admission report
     *
     * @param string|null $status
     * @param string|null $startDate
     * @param string|null $endDate
     * @return array
     */
    public static function getAdmissionReport(?string $status = null, ?string $startDate = null, ?string $endDate = null): array
    {
        $query = DB::table('admissions');

        if ($status) {
            $query->where('status', $status);
        }

        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }

        $admissions = $query->get();

        $statusCounts = DB::table('admissions')
            ->when($startDate, fn($q) => $q->where('created_at', '>=', $startDate))
            ->when($endDate, fn($q) => $q->where('created_at', '<=', $endDate))
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return [
            'data' => $admissions,
            'total' => $admissions->count(),
            'by_status' => $statusCounts,
            'period' => [
                'start' => $startDate ?? 'All time',
                'end' => $endDate ?? 'Present',
            ],
        ];
    }

    /**
     * Generate enrollment report
     *
     * @param string|null $startDate
     * @param string|null $endDate
     * @return array
     */
    public static function getEnrollmentReport(?string $startDate = null, ?string $endDate = null): array
    {
        $query = DB::table('users')
            ->where('access_rights', 'Student')
            ->whereNull('deleted_date');

        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }

        $students = $query->get();

        $byCourse = DB::table('users')
            ->where('access_rights', 'Student')
            ->whereNull('deleted_date')
            ->when($startDate, fn($q) => $q->where('created_at', '>=', $startDate))
            ->when($endDate, fn($q) => $q->where('created_at', '<=', $endDate))
            ->select('course', DB::raw('COUNT(*) as count'))
            ->groupBy('course')
            ->pluck('count', 'course')
            ->toArray();

        return [
            'data' => $students,
            'total_students' => $students->count(),
            'by_course' => $byCourse,
            'period' => [
                'start' => $startDate ?? 'All time',
                'end' => $endDate ?? 'Present',
            ],
        ];
    }

    /**
     * Generate feedback report
     *
     * @param string|null $status
     * @param string|null $startDate
     * @param string|null $endDate
     * @return array
     */
    public static function getFeedbackReport(?string $status = null, ?string $startDate = null, ?string $endDate = null): array
    {
        $query = DB::table('feedback');

        if ($status) {
            $query->where('status', $status);
        }

        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->where('created_at', '<=', $endDate);
        }

        $feedbacks = $query->get();

        $statusCounts = DB::table('feedback')
            ->when($startDate, fn($q) => $q->where('created_at', '>=', $startDate))
            ->when($endDate, fn($q) => $q->where('created_at', '<=', $endDate))
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return [
            'data' => $feedbacks,
            'total' => $feedbacks->count(),
            'by_status' => $statusCounts,
            'period' => [
                'start' => $startDate ?? 'All time',
                'end' => $endDate ?? 'Present',
            ],
        ];
    }

    /**
     * Generate summary statistics for dashboard
     *
     * @return array
     */
    public static function getDashboardSummary(): array
    {
        return [
            'total_students' => DB::table('users')->where('access_rights', 'Student')->whereNull('deleted_date')->count(),
            'total_teachers' => DB::table('users')->where('access_rights', 'Teacher')->whereNull('deleted_date')->count(),
            'total_admins' => DB::table('users')->where('access_rights', 'Admin')->whereNull('deleted_date')->count(),
            'total_admissions' => DB::table('admissions')->count(),
            'pending_admissions' => DB::table('admissions')->where('status', 'Pending')->count(),
            'total_courses' => DB::table('courses')->whereNull('deleted_date')->count(),
            'total_activities' => DB::table('activities')->whereNull('deleted_date')->count(),
            'total_posts' => DB::table('posts')->whereNull('deleted_date')->count(),
            'total_feedback' => DB::table('feedback')->count(),
            'unread_feedback' => DB::table('feedback')->where('status', 'Unread')->count(),
        ];
    }

    /**
     * Generate trend data for charts
     *
     * @param string $modelTable The table to analyze
     * @param int $days Number of days to include
     * @param string $dateColumn The date column to use
     * @return array
     */
    public static function getTrendData(string $modelTable, int $days = 30, string $dateColumn = 'created_at'): array
    {
        $startDate = now()->subDays($days)->startOfDay();

        $data = DB::table($modelTable)
            ->select(
                DB::raw('DATE(' . $dateColumn . ') as date'),
                DB::raw('COUNT(*) as count')
            )
            ->where($dateColumn, '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'labels' => $data->pluck('date')->toArray(),
            'values' => $data->pluck('count')->toArray(),
            'total' => $data->sum('count'),
            'period_days' => $days,
        ];
    }
}
