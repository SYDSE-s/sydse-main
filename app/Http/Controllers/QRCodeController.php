<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function generate($id)
    {
        // Find the member
        $member = Member::find($id);

        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Member not found'
            ], 404);
        }

        try {
            // Generate QR code content
            $url = "https://example.com/{$id}";

            // Define the file name
            $fileName = "qrcode-{$id}.svg";  // SVG format tidak memerlukan Imagick
            $filePath = "qrcodes/{$fileName}";
            $fullPath = public_path($filePath);

            // Make sure the directory exists
            if (!file_exists(public_path('qrcodes'))) {
                mkdir(public_path('qrcodes'), 0755, true);
            }

            // Generate QR code as SVG
            QrCode::format('svg')
                ->size(128)
                ->errorCorrection('H')
                ->generate($url, $fullPath);

            // Update the database
            $member->qrcode = $filePath;
            $member->save();

            return response()->json([
                'success' => true,
                'qr_url' => asset($filePath),
                'message' => 'QR code has been generated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate QR code: ' . $e->getMessage()
            ], 500);
        }
    }
}
