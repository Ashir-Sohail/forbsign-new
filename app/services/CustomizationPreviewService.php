<?php

namespace App\Services;
/** @var \Intervention\Image\Facades\Image $img */
use Intervention\Image\Facades\Image;

class CustomizationPreviewService
{
    public static function generatePreview($order)
    {
        $firstItemWithCustomization = $order->orderItems->firstWhere(function ($item) {
            return !empty($item->customization);
        });

        if (!$firstItemWithCustomization) {
            return null;
        }

        $custom = is_string($firstItemWithCustomization->customization)
            ? json_decode($firstItemWithCustomization->customization, true)
            : $firstItemWithCustomization->customization;

        $text = $custom['text_input'] ?? 'Preview';
        $fontColor = $custom['text_color'] ?? '#000000';
        $fontStyle = $custom['font_style'] ?? 'Arial';

        $previewFileName = 'custom_previews/order_' . $order->id . '.png';
        $previewPath = public_path('storage/' . $previewFileName);

        $img = Image::canvas(600, 200, '#ffffff');

        $img->text($text, 300, 100, function ($font) use ($fontStyle, $fontColor) {
            $fontPath = public_path('fonts/' . $fontStyle . '.ttf');
            if (file_exists($fontPath)) {
                $font->file($fontPath);
            }
            $font->size(30);
            $font->color($fontColor);
            $font->align('center');
            $font->valign('middle');
        });

        $img->save($previewPath);

        return $previewPath;
    }
}
