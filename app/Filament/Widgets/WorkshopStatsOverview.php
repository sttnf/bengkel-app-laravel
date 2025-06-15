<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\ServiceRequest;
use App\Models\Payment;
use App\Models\InventoryItem;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WorkshopStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Customers', User::where('user_type', 'customer')->count())
                ->description('Registered customers')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            
            Stat::make('Active Requests', ServiceRequest::whereIn('status', ['pending', 'confirmed', 'in_progress'])->count())
                ->description('Pending and ongoing services')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('warning'),
            
            Stat::make('Completed Services', ServiceRequest::where('status', 'completed')->count())
                ->description('Total completed services')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            
            Stat::make('Monthly Revenue', 'Rp ' . number_format(
                Payment::where('status', 'completed')
                    ->whereMonth('created_at', now()->month)
                    ->sum('amount'), 0, ',', '.'
            ))
                ->description('This month\'s earnings')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
                
            Stat::make('Low Stock Items', InventoryItem::whereColumn('current_stock', '<=', 'reorder_level')->count())
                ->description('Items need restocking')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
                
            Stat::make('Total Technicians', User::where('user_type', 'technician')->count())
                ->description('Available technicians')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('info'),
        ];
    }
}
