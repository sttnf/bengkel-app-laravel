<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\Payment;
use App\Models\InventoryItem;
use App\Models\Service;
use App\Models\User;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the main dashboard.
     */
    public function index(): View
    {
        $user = Auth::user();

        // Check if user is customer or admin/staff
        if ($user->user_type === 'customer') {
            return $this->customerDashboard();
        }

        // Admin/Staff dashboard
        $stats = $this->getDashboardStats();
        $recentServiceRequests = $this->getRecentServiceRequests();
        $lowStockItems = $this->getLowStockItems();
        $monthlyRevenue = $this->getMonthlyRevenue();
        $todaysStats = $this->getTodaysStats();

        return view('dashboard', compact('stats', 'recentServiceRequests', 'lowStockItems', 'monthlyRevenue', 'todaysStats'));
    }

    /**
     * Display customer dashboard.
     */
    private function customerDashboard(): View
    {
        $user = Auth::user();

        $customerStats = $this->getCustomerStats($user);
        $userVehicles = $this->getUserVehicles($user);
        $userServiceRequests = $this->getUserServiceRequests($user);
        $userPayments = $this->getUserPayments($user);
        $availableServices = $this->getAvailableServices();

        return view('dashboard.customer', compact(
            'customerStats',
            'userVehicles',
            'userServiceRequests',
            'userPayments',
            'availableServices'
        ));
    }

    /**
     * Get dashboard statistics.
     */
    private function getDashboardStats(): array
    {
        // Calculate previous month's revenue for growth comparison
        $previousMonthRevenue = Payment::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('amount');

        $currentMonthRevenue = Payment::where('status', 'completed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        // Calculate revenue growth percentage
        $revenueGrowth = 0;
        if ($previousMonthRevenue > 0) {
            $revenueGrowth = (($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100;
        }

        return [
            'total_service_requests' => ServiceRequest::count(),
            'pending_requests' => ServiceRequest::where('status', 'pending')->count(),
            'in_progress_requests' => ServiceRequest::where('status', 'in_progress')->count(),
            'completed_requests' => ServiceRequest::where('status', 'completed')->count(),
            'total_customers' => User::where('user_type', 'customer')->count(),
            'new_customers_this_month' => User::where('user_type', 'customer')
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'total_technicians' => Technician::count(),
            'total_services' => Service::count(),
            'total_inventory_items' => InventoryItem::count(),
            'low_stock_items' => InventoryItem::where('current_stock', '<=', DB::raw('reorder_level'))->count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
            'monthly_revenue' => $currentMonthRevenue,
            'revenue_growth' => $revenueGrowth,
            'pending_payments' => Payment::where('status', 'pending')->sum('amount'),
        ];
    }

    /**
     * Get recent service requests.
     */
    private function getRecentServiceRequests()
    {
        return ServiceRequest::with(['customer', 'service', 'technician'])
            ->latest()
            ->take(5)
            ->get();
    }

    /**
     * Get low stock inventory items.
     */
    private function getLowStockItems()
    {
        return InventoryItem::where('current_stock', '<=', DB::raw('reorder_level'))
            ->orderBy('current_stock', 'asc')
            ->take(5)
            ->get();
    }

    /**
     * Get monthly revenue data for charts.
     */
    private function getMonthlyRevenue(): array
    {
        $monthlyData = Payment::where('status', 'completed')
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();

        return $monthlyData->reverse()->map(function ($item) {
            return [
                'month' => Carbon::createFromDate($item->year, $item->month, 1)->format('M Y'),
                'revenue' => $item->total
            ];
        })->toArray();
    }

    /**
     * Get analytics data.
     */
    public function analytics(): View
    {
        $serviceStats = $this->getServiceStats();
        $technicianStats = $this->getTechnicianStats();
        $revenueByService = $this->getRevenueByService();

        return view('dashboard.analytics', compact('serviceStats', 'technicianStats', 'revenueByService'));
    }

    /**
     * Get service statistics.
     */
    private function getServiceStats(): array
    {
        return Service::withCount('serviceRequests')
            ->orderBy('service_requests_count', 'desc')
            ->get()
            ->toArray();
    }

    /**
     * Get technician statistics.
     */
    private function getTechnicianStats(): array
    {
        return Technician::withCount('serviceRequests')
            ->orderBy('service_requests_count', 'desc')
            ->get()
            ->toArray();
    }

    /**
     * Get revenue by service type.
     */
    private function getRevenueByService(): array
    {
        return Service::join('service_requests', 'services.id', '=', 'service_requests.service_id')
            ->join('payments', 'service_requests.id', '=', 'payments.request_id')
            ->where('payments.status', 'completed')
            ->selectRaw('services.name, SUM(payments.amount) as total_revenue')
            ->groupBy('services.id', 'services.name')
            ->orderBy('total_revenue', 'desc')
            ->get()
            ->toArray();
    }

    /**
     * Get today's statistics.
     */
    private function getTodaysStats(): array
    {
        $today = Carbon::today();

        return [
            'appointments_today' => ServiceRequest::whereDate('created_at', $today)->count(),
            'completed_today' => ServiceRequest::where('status', 'completed')
                ->whereDate('updated_at', $today)
                ->count(),
            'revenue_today' => Payment::where('status', 'completed')
                ->whereDate('created_at', $today)
                ->sum('amount'),
            'pending_today' => ServiceRequest::where('status', 'pending')
                ->whereDate('created_at', $today)
                ->count(),
        ];
    }

    /**
     * Get customer-specific statistics.
     */
    private function getCustomerStats($user): array
    {
        return [
            'total_vehicles' => $user->customerVehicles()->count(),
            'total_service_requests' => $user->serviceRequests()->count(),
            'pending_requests' => $user->serviceRequests()->where('status', 'pending')->count(),
            'in_progress_requests' => $user->serviceRequests()->where('status', 'in_progress')->count(),
            'completed_requests' => $user->serviceRequests()->where('status', 'completed')->count(),
            'total_spent' => Payment::whereHas('serviceRequest', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('status', 'completed')->sum('amount'),
            'pending_payments' => Payment::whereHas('serviceRequest', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('status', 'pending')->sum('amount'),
        ];
    }

    /**
     * Get user's vehicles.
     */
    private function getUserVehicles($user)
    {
        return $user->customerVehicles()->with('vehicle')->latest()->get();
    }

    /**
     * Get user's service requests.
     */
    private function getUserServiceRequests($user)
    {
        return $user->serviceRequests()
            ->with(['service', 'technician', 'payments', 'customerVehicle.vehicle'])
            ->latest()
            ->take(10)
            ->get();
    }

    /**
     * Get user's payments.
     */
    private function getUserPayments($user)
    {
        return Payment::whereHas('serviceRequest', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('serviceRequest.service')->latest()->take(10)->get();
    }

    /**
     * Get available services.
     */
    private function getAvailableServices()
    {
        return Service::where('is_active', true)->orderBy('name')->get();
    }
}
