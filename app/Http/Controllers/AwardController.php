<?php

namespace App\Http\Controllers;

use App\Models\Award as AwardModel;
use App\Models\Employee;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function toggle(Request $request, Employee $employee)
    {
        $award = AwardModel::where('employee_id', '=', $employee->id)
            ->where('start_of_month', '=', now()->startOfMonth()->format('Y-m-d'))
            ->first();
        if ($award) {
            $award->delete();
        } else {
            AwardModel::create([
                'employee_id' => $employee->id,
                'start_of_month' => now()->startOfMonth()->format('Y-m-d')
            ]);
        }

        Notification::make()
            ->title($award ? 'Премия отменена' : 'Премия назначена')
            ->success()
            ->send();

        return redirect()->back();
    }
}
