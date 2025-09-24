<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Carbon\CarbonPeriod;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Models\LeaveApproval;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class LeaveRequestController extends Controller
{
    function index()
    {
        $menu_name = 'Cuti';
        if(Auth::user()->role_id === 1){
            $leave_request = LeaveRequest::with('type_leave', 'leave_approval', 'users.employee')->orderBy('id', 'desc')->get();
        }else{
            $leave_request = LeaveRequest::with('type_leave', 'leave_approval')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        }

        // return $leave_request;
        return view('admin_dashboard.leave.leave_request', ['menu_name' => $menu_name, 'leave_request' => $leave_request]);
    }

    function add()
    {
        $menu_name = 'Cuti';
        $type_leaves = DB::table('type_leaves')->get();
        $userlists = User::with('employee')->whereNot('role_id', 1)->get()->sortBy(fn($user) => $user->employee->nip);

        // return Auth::user()->employee->parent_id;
        return view('admin_dashboard.leave.add_leave_request', ['menu_name' => $menu_name, 'userlists' => $userlists, 'type_leaves' => $type_leaves]);
    }

    function create(Request $request)
    {
        // return User::with('employee')->find($request->user_id)->employee->parent_id;

        $request->validate([
            'type_leave_id' => 'required',
            'reason' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'address' => 'required|string'
        ]);

        $overlap = LeaveRequest::where('user_id', $request->user_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    });
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['start_date' => 'Tanggal Cuti bentrok dengan pengajuan Cuti yang lain.']);
        }

        if ($request->type_leave_id == '1') {

            DB::transaction(function () use ($request) {
                $start = Carbon::parse($request->start_date);
                $end   = Carbon::parse($request->end_date);
                $amount_days = $this->workingDays($start, $end);

                if ($amount_days <= LeaveBalance::where('user_id', $request->user_id)->sum('remaining_leave')) {
                    $leave_request = LeaveRequest::create([
                        'user_id' => $request->user_id,
                        'type_leave_id' => $request->type_leave_id,
                        'reason' => $request->reason,
                        'start_date' => $request->start_date,
                        'end_date' => $request->end_date,
                        'amount_days' => $amount_days,
                        'address' => $request->address,
                    ]);

                    LeaveApproval::create([
                        'leave_request_id' => $leave_request->id,
                        'supervisor_id' => User::with('employee')->find($request->user_id)->employee->parent_id,
                    ]);
                } else {
                    return back()->withErrors(['amount_days' => 'Jumlah Cuti Anda tidak mencukupi']);
                }

                // $this->deductLeave(Auth::user()->id ,$this->workingDays($start, $end));
            });
        } else {
            DB::transaction(function () use ($request) {
                $start = Carbon::parse($request->start_date);
                $end   = Carbon::parse($request->end_date);

                $leave_request = LeaveRequest::create([
                    'user_id' => $request->user_id,
                    'type_leave_id' => $request->type_leave_id,
                    'reason' => $request->reason,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'amount_days' => ($start->diffInDays($end) + 1),
                    'address' => $request->address,
                ]);

                LeaveApproval::create([
                    'leave_request_id' => $leave_request->id,
                    'leave_request_id' => User::with('employee')->find($request->user_id)->employee->parent_id,
                ]);
            });
        }

        Session::flash('message', 'Leave Request Successfully Added');

        return redirect()->route('leave_request');
    }

    function edit($id)
    {
        $menu_name = 'Cuti';
        $edit = LeaveRequest::with('leave_approval')->findOrFail($id);
        $type_leaves = DB::table('type_leaves')->get();
        // return $edit;
        return view('admin_dashboard.leave.edit_leave_request', ['edit' => $edit, 'type_leaves' => $type_leaves, 'menu_name' => $menu_name]);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'type_leave_id' => 'required',
            'reason' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'address' => 'required|string'
        ]);

        $overlap = LeaveRequest::where(['user_id' => $request->user_id, 'id' => !$id])
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    });
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['start_date' => 'Tanggal Cuti bentrok dengan pengajuan Cuti yang lain.']);
        }

        if ($request->type_leave_id == '1') {
            $start = Carbon::parse($request->start_date);
            $end   = Carbon::parse($request->end_date);
            $amount_days = $this->workingDays($start, $end);

            if ($amount_days <= LeaveBalance::where('user_id', $request->user_id)->sum('remaining_leave')) {
                LeaveRequest::where('id', $id)->update([
                    'user_id' => $request->user_id,
                    'type_leave_id' => $request->type_leave_id,
                    'reason' => $request->reason,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'amount_days' => $amount_days,
                    'address' => $request->address,
                    'status' => 'pending'
                ]);
            }
        } else {
            $start = Carbon::parse($request->start_date);
            $end   = Carbon::parse($request->end_date);

            LeaveRequest::where('id', $id)->update([
                'user_id' => $request->user_id,
                'type_leave_id' => $request->type_leave_id,
                'reason' => $request->reason,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'amount_days' => ($start->diffInDays($end) + 1),
                'address' => $request->address,
                'status' => 'pending'
            ]);
        }

        LeaveApproval::where('leave_request_id', $id)->update([
            'supervisor_status' => 'pending',
            'supervisor_note' => null,
            'leader_id' => null,
            'leader_status' => 'pending',
            'leader_note' => null
        ]);

        Session::flash('message', 'Leave Request Successfully Update');

        return redirect()->route('leave_request');
    }

    function delete($id)
    {
        LeaveRequest::with('leave_approval')->findOrFail($id)->delete();

        Session::flash('message', 'Cuti Successfully Deleted');

        return redirect()->route('leave_request');
    }

    function save($id)
    {
        $leave_request = LeaveRequest::with(
            'type_leave',
            'users.employee.rank',
            'users.employee.position',
            'users.employee.parent.employee.position',
        )->findOrFail($id);
        
        // return $leave_request;

        if ($leave_request->type_leave_id == '1') {
            $format = 'cuti_tahunan.docx';
        } else if ($leave_request->type_leave_id == '2') {
            $format = 'cuti_besar.docx';
        } else if ($leave_request->type_leave_id == '3') {
            $format = 'cuti_sakit.docx';
        } else if ($leave_request->type_leave_id == '4') {
            $format = 'cuti_melahirkan.docx';
        } else if ($leave_request->type_leave_id == '5') {
            $format = 'cuti_karena_alasan_penting.docx';
        } else {
            $format = 'cuti_diluar_tanggungan_negara.docx';
        }

        $templatePath = public_path('/format_cuti/' . $format);
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);

        $phpWord->setValues([
            'date' => date('d M Y', strtotime($leave_request->updated_at)),
            'type_leave' => strtoupper($leave_request->type_leave->type_leave),
            'reason' => $leave_request->reason,
            'name' => $leave_request->users->name,
            'nip' => $leave_request->users->employee->nip,
            'year' => $leave_request->users->employee->working_time_year,
            'month' => $leave_request->users->employee->working_time_month,
            'rank' => $leave_request->users->employee->rank->rank_name . ' Gol. ' . $leave_request->users->employee->rank->rank_group . '/' . $leave_request->users->employee->rank->rank_room,
            'position' => $leave_request->users->employee->position->position_name,
            'parent_name' => $leave_request->users->employee->parent->name,
            'parent_nip' => $leave_request->users->employee->parent->employee->nip,
            'parent_position' => strtoupper($leave_request->users->employee->parent->employee->position->position_name) ,
            'amount_days' => $leave_request->amount_days,
            'start_date' => date('d M Y', strtotime($leave_request->start_date)),
            'end_date' => date('d M Y', strtotime($leave_request->end_date)),
            'address' => $leave_request->address,
        ]);

        // Save the filled template to a temporary DOCX file
        // $tempDocx = tempnam(sys_get_temp_dir(), 'word');
        // $phpWord->saveAs($tempDocx);

        // Configure PDF renderer (DomPDF must be installed via Composer)
        // Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
        // Settings::setPdfRendererPath(base_path('vendor/dompdf/dompdf'));
        // Settings::setPdfRendererName('DomPDF');

        // Load the DOCX and convert to PDF
        // $phpWordLoaded = IOFactory::load($tempDocx);
        // $pdfWriter = IOFactory::createWriter($phpWordLoaded, 'PDF');

        $fileName = $leave_request->type_leave->type_leave . '-' .
            $leave_request->users->name .
            ' (' . date('d-m-Y', strtotime($leave_request->start_date)) .
            '-' . date('d-m-Y', strtotime($leave_request->end_date)) . ')' . '.docx';


        // $pdfPath = tempnam(sys_get_temp_dir(), 'pdf');
        // $pdfWriter->save($pdfPath);

        // return response()->download($pdfPath, 'Surat Cuti.pdf')->deleteFileAfterSend(true);

        // $pdfWriter->save($fileName);
        // return response()->download($fileName)->deleteFileAfterSend(true);

        // $phpWord->saveAs();

        // return Response::streamDownload(function () use ($pdfWriter) {
        //     $tempPdf = tempnam(sys_get_temp_dir(), 'pdf');
        //     $pdfWriter->save($tempPdf);
        //     readfile($tempPdf);
        //     unlink($tempPdf);
        // }, $fileName . '.pdf', [
        //     'Content-Type' => 'application/pdf',
        //     'Cache-Control' => 'no-store, no-cache',
        //     'Pragma' => 'no-cache',
        // ]);


        // Download Word 
        return Response::streamDownload(function () use ($phpWord) {
            $tempFile = tempnam(sys_get_temp_dir(), 'word');
            $phpWord->saveAs($tempFile);
            readfile($tempFile);
            unlink($tempFile); // Clean up
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Cache-Control' => 'no-store, no-cache',
            'Pragma' => 'no-cache',
        ]);
    }

    function workingDays($start, $end)
    {
        // List of public holidays in Indonesia (example for 2025)
        $holidays = [
            '2025-01-01',
            '2025-01-27',
            '2025-01-29',
            '2025-03-29',
            '2025-03-31',
            '2025-04-01',
            '2025-04-18',
            '2025-04-20',
            '2025-05-01',
            '2025-05-12',
            '2025-05-29',
            '2025-06-01',
            '2025-06-06',
            '2025-06-27',
            '2025-08-17',
            '2025-09-05',
            '2025-12-25'
        ];

        $period = CarbonPeriod::create($start, $end);
        $workingDays = 0;

        foreach ($period as $date) {
            // Skip weekends
            if ($date->isWeekend()) continue;

            // Skip holidays
            if (in_array($date->format('Y-m-d'), $holidays)) continue;

            $workingDays++;
        }

        return $workingDays;
    }
}
