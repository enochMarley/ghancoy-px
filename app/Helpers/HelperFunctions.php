<?php

namespace App\Helpers;

use App\Models\UserActivityHistoryLog;
use Spatie\Browsershot\Browsershot;

class HelperFunctions
{
    // log user activity history
    public static function logUserHistory(string $details)
    {
        if (!auth()->user()) return;

        UserActivityHistoryLog::create([
            'user_id' => auth()->user()->id,
            'details' => $details,
        ]);
    }

    // Generate pdf from HTML
    public static function generatePDF($html, $fileName, $landscape = true)
    {
        $pdfBinary = Browsershot::html($html)
            ->waitUntilNetworkIdle()
            ->showBackground()
            ->landscape($landscape)
            ->timeout(600)
            ->format('A4')
            ->margins('1.5', '1.5', '3', '1.5', 'cm') // top, right, bottom, left (increase top/bottom)
            ->showBrowserHeaderAndFooter()
            ->headerHtml('
                <div style="font-size:10px; height:30px; text-align:center; width:100%;">
                    <p>ESSMGB RESTRICTED</p>
                </div>')
            ->footerHtml('
                <div style="width: 100%;">
                    <div style="font-size:10px; width:100%; text-align:center;">
                        <hr color="#c0c0c0" width="84%" />
                        <span class="pageNumber"></span><br/>
                        <span>ESSMGB RESTRICTED</span>
                    </div>

                    <div style="display: block; width: 100%; text-align:right; text-style:italic; font-size:10px;">
                        <p style="text-align: right; margin-right: 60px;">Printed on : <span class="date"></span></p>
                    </div>
                </div>
            ')
            ->pdf();

        return response($pdfBinary, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename=$fileName.pdf",
        ]);
    }
}
