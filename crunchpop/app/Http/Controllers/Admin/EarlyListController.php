<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EarlyListSignup;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EarlyListController extends Controller
{
    public function index()
    {
        $signups = EarlyListSignup::latest()->paginate(20);

        return view('admin.early-list.index', [
            'signups'  => $signups,
            'options'  => EarlyListSignup::INTEREST_OPTIONS,
        ]);
    }

    public function export(): StreamedResponse
    {
        $filename = 'early-list-signups.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Name', 'Email', 'Phone', 'Interests', 'Source', 'Signed Up']);

            EarlyListSignup::orderBy('id')->chunk(200, function ($rows) use ($handle) {
                foreach ($rows as $s) {
                    fputcsv($handle, [
                        $s->name,
                        $s->email,
                        $s->phone,
                        collect($s->interests ?? [])
                            ->map(fn ($i) => EarlyListSignup::INTEREST_OPTIONS[$i] ?? $i)
                            ->implode(', '),
                        $s->source,
                        $s->created_at?->toDateTimeString(),
                    ]);
                }
            });

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    public function destroy(EarlyListSignup $earlyList)
    {
        $earlyList->delete();

        return back()->with('success', 'Signup removed.');
    }
}
